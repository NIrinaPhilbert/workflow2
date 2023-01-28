<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Requestwf;
use App\Request_history;
use App\User;
use App\Process_User;
use App\validation_request;
use App\Requestwf_email_address;
use Illuminate\Support\Facades\DB;
use Session;
use Helper; // Important
//====================================//
//use App\Http\Controllers\RequestController;
//====================//
use App\Mail\RequestMail;
use App\Process_achievement;
use Auth;


class SuiviDemandeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id){

        $RequestDetail = DB::table('requestwfs')
        ->join('users','users.id', '=', 'requestwfs.user_id')
        ->join('tools','tools.id', '=', 'requestwfs.tool_id')
        ->join('statuses','statuses.id', '=', 'requestwfs.status_id')
        ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
        ->join('entities','entities.id','=','users.entity_id')
        ->select('requestwfs.id as ID','requestwfs.subject as Objet','requestwfs.content as Content','users.name as username','entities.name as entityuser','tools.name as toolname','type_requests.name as type_requestname','statuses.id as statusid','statuses.name as status','requestwfs.created_at as created_at')
        ->where('requestwfs.id',$id)
        ->orderBy('requestwfs.id','DESC')
        ->get();   
        

        //A ne pas oublier les informations concernant la demande (titre, objet, initiée par, date de création)


        // TABLEAU

        $toRequestHistory = array() ;

        $toRequestHistoryLigne = array() ;
        $toRequestHistoryLigne['etat_id']       = 'Etat ID' ;
        $toRequestHistoryLigne['etat']          = 'Etat' ;
        $toRequestHistoryLigne['acteur']        = 'Acteur' ;
        $toRequestHistoryLigne['dateaction']    = 'Date' ;
        $toRequestHistoryLigne['commentaire']   = 'Commentaire' ;
        $toRequestHistoryLigne['entite']        = 'Entité' ;

        array_push($toRequestHistory, $toRequestHistoryLigne) ;

        $bDemandeValideATraite  = false ; //Voir au fil de l'hitorique si etat_id = 3
        $iProcessId             = 0 ;

        $toTableRequestHistory = DB::table('request_histories')
        ->where('request_histories.requestwf_id','=',$id)
        ->where('request_histories.etat_id','<>','1')
        ->orderBy('request_histories.id','ASC')
        ->get() ;
        foreach($toTableRequestHistory as $oTableRequestHistory)
        {
            $toRequestHistoryLigne  = array() ;

            $iRequestHistoryId          = $oTableRequestHistory->id ;
            $iRequestHistoryIdSuivante  = $iRequestHistoryId + 1 ;
            $toTableEntite = DB::table('entities')
                ->where('entities.id','=',$oTableRequestHistory->destination_entity_id)
                ->get() ;

            $toTableEtats = DB::table('etats')
            ->where('etats.id','=',$oTableRequestHistory->etat_id)
            ->get() ;
            $toRequestHistoryLigne['etat_id']       = $oTableRequestHistory->etat_id . ' depuis table etats' ;
            $toRequestHistoryLigne['etat']          = $toTableEtats[0]->name ;
            $toRequestHistoryLigne['dateaction']    = $oTableRequestHistory->created_at ;
            $toRequestHistoryLigne['commentaire']   = $oTableRequestHistory->history_comment ;
            $toRequestHistoryLigne['entite']        = $toTableEntite[0]->name ;

            switch($oTableRequestHistory->etat_id)
            {
                case 3 ://table 'etats' interpretée
                    $bDemandeValideATraite = true ;

                    $toTableProcessing = DB::table('processings')
                    ->where('processings.requestwf_id','=',$id)
                    ->get() ;
                    $iActeurId  = $toTableProcessing[0]->sender_request_user_id ;
                    $iProcessId = $toTableProcessing[0]->id ;
                break ;
                case 5 :
                    $iActeurId  = $oTableRequestHistory->sender_request_user_id ;
                break ;
                default:
                    $toTableRequestHistoryNext = DB::table('request_histories')
                    ->where('request_histories.id','=',$iRequestHistoryIdSuivante)
                    ->get() ;
                    $iActeurId = $toTableRequestHistoryNext[0]->sender_request_user_id ;
            }

          
            $toTableUsers = DB::table('users')
                ->where('users.id','=',$iActeurId)
                ->get() ;
            $toRequestHistoryLigne['acteur']        = $toTableUsers[0]->name ;
            array_push($toRequestHistory, $toRequestHistoryLigne) ;
        }

        if($bDemandeValideATraite)//Nitohy tao amin'ny processing_achievements
        {
            $toTableProcessingAchievements = DB::table('process_achievements')
            ->select('process_achievements.process_achievement_comment as comment',
            'process_achievements.created_at as created_at', 'process_achievements.user_id as user_id')
            ->where('process_achievements.process_id','=',$iProcessId)
            ->orderBy('process_achievements.id','ASC')
            ->get() ;

            $iStatusesId = 5 ; //Initialisation en cours de traitement

            $iNombreProcessAchievement  = $toTableProcessingAchievements->count() ;
            $iCountForeach              = 0 ;

            foreach($toTableProcessingAchievements as $oTableProcessingAchievements)
            {
                $iCountForeach ++ ;
                if($iCountForeach == $iNombreProcessAchievement) //dernière enregistrement de process_achievements
                {
                    $toTableRequest = DB::table('requestwfs')
                    ->where('requestwfs.id','=',$id)
                    ->get() ;
                    $iStatusesId = $toTableRequest[0]->status_id ;
                }
                
                $toTableStatues = DB::table('statuses')
                ->where('statuses.id','=',$iStatusesId)
                ->get() ;

                $toTableUsers = DB::table('users')
                ->where('users.id','=',$oTableProcessingAchievements->user_id)
                ->get() ;
                $toTableEntite = DB::table('entities')
                ->where('entities.id','=',$toTableUsers[0]->entity_id)
                ->get() ;

                $toRequestHistoryLigne['etat_id']       = $iStatusesId . ' => depuis table statuses' ;
                $toRequestHistoryLigne['etat']          = $toTableStatues[0]->name ;
                $toRequestHistoryLigne['dateaction']    = $oTableProcessingAchievements->created_at ;
                $toRequestHistoryLigne['commentaire']   = $oTableProcessingAchievements->comment ;
                $toRequestHistoryLigne['entite']        = $toTableEntite[0]->name ;
                $toRequestHistoryLigne['acteur']        = $toTableUsers[0]->name ;

                array_push($toRequestHistory, $toRequestHistoryLigne) ;
            }

        }
        $iNombreEnreg = sizeof($toRequestHistory);
        
        
        return view('request.showrequesthistory', compact('toRequestHistory','iNombreEnreg','RequestDetail'));

        /*echo '<pre>' ;
        print_r($toRequestHistory) ;
        echo '</pre>' ;
        echo "next format";
        echo $toRequestHistory[0]['entite'];*/



    }
}
