<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Helper;
use App\User;
use App\Requestwf;

class CronController extends Controller
{

public function index(){
        /*exit();
        $phpurlpage = "http://127.0.0.1:8000/actioncron";
        while(true){

        sleep(10); // sleep for 60 sec = 1 minute
        echo "debut 10 s";
        $s = curl_init();
        curl_setopt($s,CURLOPT_URL, $phpurlpage); 
        curl_exec($s); 
        curl_getinfo($s,CURLINFO_HTTP_CODE); 
        curl_close($s);
        echo "fin 10s";*/
        //}


        $iNombreJoursMaxValidation = config('constants.NOMBRE_JOUR_MAX_VALIDATION') ;
        //echo $iNombreJoursMaxValidation ;
        //exit() ;
        
        $zQueryRequestNonValides = "SELECT * FROM requestwfs WHERE requestwfs.status_id <> 3 AND NOW() > DATE_ADD(created_at, INTERVAL " . $iNombreJoursMaxValidation . " DAY)" ;
        $toRequestNonValides = DB::select($zQueryRequestNonValides) ;
       //echo $zQueryRequestNonValides . '<br/>';
        
        foreach($toRequestNonValides as $oRequestNonValide){
            $iRequestId = $oRequestNonValide->id ;
            $zQueryRequestHistory = "SELECT * FROM request_histories WHERE requestwf_id =  " . $iRequestId ." ORDER BY id DESC LIMIT 1" ;
            $toRequestHistory = DB::select($zQueryRequestHistory) ;
            $iEntiteId = $toRequestHistory[0]->destination_entity_id ;
            $zQueryUtilisateursEntite = "SELECT * FROM users WHERE entity_id =  " . $iEntiteId ." AND validator = 1 AND activated = 1" ;
            //echo $zQueryUtilisateursEntite . '<br/>' ;
            $toRequestUtilisateursEntite = DB::select($zQueryUtilisateursEntite) ;
            foreach($toRequestUtilisateursEntite as $oUtilisateur)
            {
                /*
                echo '<pre>' ;
                print_r($oUtilisateur) ;
                echo '</pre>' ;
                */
                $iUtilisateurDemandeurId = $oRequestNonValide->user_id ;
                $zUtilisateurDemandeurEntite = User::getEntityNameByUserId($iUtilisateurDemandeurId);
                $zUtilisateurDemandeurNom = User::getNameUserbyId($iUtilisateurDemandeurId) ;
                $zMailDestinataire = $oUtilisateur->email ;
                $zMailTitre = "[Rappel pour validation demande] " . $oRequestNonValide->subject ;
                $zMailContenu = "La demande <b>" . $oRequestNonValide->subject . "</b> de l'utilisateur <b>" . $zUtilisateurDemandeurNom . "</b> de l'entité <b>" . $zUtilisateurDemandeurEntite . "</b> est en attente de votre validation." ;
                echo $zMailDestinataire . '<br/>' ;
                echo $zMailTitre . '<br/>' ;
                echo $zMailContenu ;
                echo '<hr/>' ;
                Helper::sendnotification($zMailDestinataire,$zMailTitre,$zMailTitre,$zMailContenu) ;
                sleep(2) ;
            }            
            
        }

    }
    public function sendmailrappel(){
        $email_admin = 'randriamiaranirina@gmail.com';
        $subjectm = 'Test mail pour cron';
        $header = 'header mail pour cron';
        $zMessageNotification = 'Mail de rappel pour vous';
        Helper::sendnotification($email_admin,$subjectm,$header,$zMessageNotification);
        echo "Mail envoyé";
    }
    public function crontraitement(){
        $iNombreJoursMaxTraitement = config('constants.NOMBRE_JOUR_MAX_TRAITEMENT') ;
        //echo $iNombreJoursMaxValidation ;
        //exit() ;
        
        $zQueryRequestNonTraites = "SELECT * FROM processings WHERE is_finished <> 1 AND NOW() > DATE_ADD(created_at, INTERVAL " . $iNombreJoursMaxTraitement . " DAY)" ;
        $toRequestNonTraites = DB::select($zQueryRequestNonTraites) ;
       //echo $zQueryRequestNonValides . '<br/>';
        
        foreach($toRequestNonTraites as $oRequestNonTraite){
            $iProcessId = $oRequestNonTraite->id ;
            $iRequestId = $oRequestNonTraite->requestwf_id ;
            $toRequestwf = Requestwf::getRequestById($iRequestId) ;

            $zRequestNom = $toRequestwf[0]->Objet ;
            $zUtilisateurDemandeurEntite = User::getEntityNameByUserId($toRequestwf[0]->userid);
            $zUtilisateurDemandeurNom = User::getNameUserbyId($toRequestwf[0]->userid) ;

            $zQueryProcessUsers = "SELECT * FROM process_users WHERE process_id = " . $iProcessId ;
            $toProcessUsers = DB::select($zQueryProcessUsers) ;

            $zQueryTraiteur = "SELECT * FROM users WHERE id =  " . $toProcessUsers[0]->user_id ." AND activated = 1" ;
            //echo $zQueryUtilisateursEntite . '<br/>' ;
            $toRequestTraiteur = DB::select($zQueryTraiteur) ;
            $zDestinataireEmailTraiteur = $toRequestTraiteur[0]->email ;

            $zMailTitre = "[Rappel pour traitement demande] " . $zRequestNom ;
            $zMailContenu = "La demande <b>" . $zRequestNom . "</b> de l'utilisateur <b>" . $zUtilisateurDemandeurNom . "</b> de l'entité <b>" . $zUtilisateurDemandeurEntite . "</b> est en attente de traitement." ;
            echo $zDestinataireEmailTraiteur . '<br/>' ;
            echo $zMailTitre . '<br/>' ;
            echo $zMailContenu ;
            echo '<hr/>' ;
            Helper::sendnotification($zDestinataireEmailTraiteur,$zMailTitre,$zMailTitre,$zMailContenu) ;
            sleep(2) ;


                   
            
        }
    }
    public function cronactivation(){
        $iNombreJoursMaxActivation = config('constants.NOMBRE_JOUR_MAX_ACTIVATION_USER') ;
        $zQueryUtilisateursNonActives = "SELECT * FROM users WHERE activated <> 1 AND NOW() > DATE_ADD(created_at, INTERVAL " . $iNombreJoursMaxActivation . " DAY)" ;
        $toRequestUtilisateursNonActives = DB::select($zQueryUtilisateursNonActives) ;
        foreach($toRequestUtilisateursNonActives as $oUtilisateursNonActives){
            $zUtilisateurNonActiveEntite = User::getEntityNameByUserId($oUtilisateursNonActives->id);
            $zUtilisateurNonActiveNom = $oUtilisateursNonActives->name ;
            $zQueryAdminitrateurs = "SELECT * FROM users WHERE activated = 1 AND administrator = 1" ;
            $toAdministrateurs = DB::select($zQueryAdminitrateurs) ;
            foreach($toAdministrateurs as $oAdministrateur)
            {
                $zDestinataireEmail = $oAdministrateur->email ;
                $zMailTitre = "[Rappel pour activation compte d'utilisateur Workflow] " . $zUtilisateurNonActiveNom ;
                $zMailContenu = "L'utilisateur <b>" . $zUtilisateurNonActiveNom . "</b> de l'entité <b>" . $zUtilisateurNonActiveEntite . "</b> est en attente d'activation." ;
                echo $zDestinataireEmail . '<br/>' ;
                echo $zMailTitre . '<br/>' ;
                echo $zMailContenu ;
                echo '<hr/>' ;
                Helper::sendnotification($zDestinataireEmail,$zMailTitre,$zMailTitre,$zMailContenu) ;
                sleep(2) ;
            }
        }
    }
    
}
