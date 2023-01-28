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


class RequestwfController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($entityid)
    {
        $lrequests = Requestwf::getListRequestByEntity($entityid);
        
        
        return view('request.index', compact('lrequests'));
    }
    public function view($id){
        $requestwf = Requestwf::getRequestById($id);
        $ListProcessAchievementByRequestID = Process_achievement::getListProcessAchievementByRequesId($id);
        $iNombreTraitement = $ListProcessAchievementByRequestID->count();
        return view('request.view',compact('requestwf','ListProcessAchievementByRequestID','iNombreTraitement'));
    }

    public function show_pending($entityid)
    {
        $data = DB::table('entities')->orderBy('name','asc')->get();
       
        $ListRequestPendingbyentity = DB::table('request_histories')
        ->join('requestwfs','requestwfs.id','=','request_histories.requestwf_id')
        ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
        ->join('tools','tools.id', '=', 'requestwfs.tool_id')
        ->select('requestwfs.id as idrequest','request_histories.id as idrequesthistories','requestwfs.subject as Objetwf',
        'requestwfs.user_id as usersourceid','tools.name as toolname','tools.id as idtool','type_requests.id as idtyperequest',
        'type_requests.name as type_requestname','request_histories.etat_id as etat',
        'requestwfs.created_at as created_at')
        ->where('request_histories.is_finished','=',0)
        ->where('request_histories.destination_entity_id','=',$entityid)
        ->orderBy('request_histories.id','DESC')
        ->get();       
 
        return view('request.pendingrequest', compact('ListRequestPendingbyentity','data'));

    }
    public function viewpendingrequest($id)
    {
        $user_id = Auth::id();
        $entity_id_user = User::getEntityIdByUserId($user_id);
        $data = DB::table('entities')
        ->orderBy('name','asc')
        ->where('entities.entity_id','=',$entity_id_user)
        ->orwhere('entities.id','=',$entity_id_user)
        ->get();
        //Liste service par entite
        $de = array();
        foreach($data as $ent){
            $de[] = $ent->id;
        }
        $json_de = json_encode($de);
        $RequestPendingbyid = DB::table('request_histories')
        ->join('requestwfs','requestwfs.id','=','request_histories.requestwf_id')
        ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
        ->join('tools','tools.id', '=', 'requestwfs.tool_id')
        ->select('requestwfs.id as idrequest','request_histories.id as idrequesthistories','request_histories.owner_request_user_id as owner_user_id',
        'requestwfs.subject as Objetwf','requestwfs.content as content',
        'requestwfs.user_id as usersourceid','tools.name as toolname','tools.id as idtool','type_requests.id as idtyperequest',
        'type_requests.name as type_requestname','request_histories.etat_id as etat',
        'requestwfs.created_at as created_at')
        ->where('request_histories.is_finished','=',0)
        ->where('request_histories.id','=',$id)
        ->get();
        
        //========Taches lies aux utilisateurs==============//
        $iSizeOfQueryEntityChild = $data->count();
        $EntityChild = array();
        if ($iSizeOfQueryEntityChild > 0)
        {
        // output data of each row
            
            foreach($data as $oEntityChild){
                $EntityChild[] = array(
                    'id' => $oEntityChild->id,
                    'text' => $oEntityChild->name
                );
            }
        }
                
        $json_EntityChild = json_encode($EntityChild);
       
        
        $entity_id_user1 = User::getEntityIdByUserId($user_id);

        $dataUsers = DB::table('users')
            ->select('*')
            ->whereIn('entity_id',$de)
            ->orderBy('users.entity_id','DESC')
            ->get();

       

        $toTableauResult = array() ;
        $iEntiteIdPrec = 0 ;

        foreach($dataUsers as $oUser){
            $iEntiteIdUser = $oUser->entity_id ;
            if($iEntiteIdPrec != $iEntiteIdUser)
            {
                $iEntiteIdPrec = $iEntiteIdUser ;
            }
            $oObjectUser = new \stdClass() ;
            $oObjectUser->id = $oUser->id ;
            $oObjectUser->text = $oUser->name ;
            $toTableauResult[$iEntiteIdPrec][] = $oObjectUser ;
        } 

        

        //=====================================//
        $iSizeOfdataUser = $dataUsers->count();
        $zUsersEntity = '';
        $zUsers = '[';
        if($iSizeOfdataUser > 0)
        {   
                
                foreach($de as $e ){

                    
                    
                    foreach($dataUsers as $oUsers){
                        if($oUsers->entity_id == $e){
                            $zUsers = $zUsers."{
                                id:".$oUsers->id.",
                                text:'".$oUsers->name."'},";
                            
                            
                        }
                    }
                    $json_User = $zUsers.']';
                    
                }
           
        }
        $json_User2 = "";
        $zResultProvisoir = json_encode($toTableauResult);
        $zResultProvisoir = str_replace('"id"', 'id', $zResultProvisoir) ;
        $zResultProvisoir = str_replace('"text"', 'text', $zResultProvisoir) ;
        $zResultProvisoir = str_replace('"', '\'', $zResultProvisoir) ;
        //Etape suiv
        $zResultProvisoir = str_replace('"{', '{', $zResultProvisoir) ;
        $zResultProvisoir = str_replace('}"', '}', $zResultProvisoir) ;
        //$json_User3 = json_encode($toTableauResult);
        $json_User3 = json_encode($zResultProvisoir);
        
       

               

        //========Fin taches lies aux utilisateurs==========//
 
        return view('request.viewpendingrequest', compact('RequestPendingbyid','data','json_EntityChild','json_User','json_de','json_User2','json_User3'));

    }
    public function viewprocessingrequest($id)
    {
        
        $tzId = explode("_",$id);
        $idprocess  = $tzId[0];
        $idrequest = $tzId[1];
        $data = DB::table('entities')->orderBy('name','asc')->get();
        
            $RequestProcessingbyid = DB::table('processings')
            ->join('requestwfs','requestwfs.id','=','processings.requestwf_id')
            ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
            ->join('tools','tools.id', '=', 'requestwfs.tool_id')
            ->select('requestwfs.id as idrequest','processings.id as idprocessings','requestwfs.subject as Objetwf','requestwfs.content as content',
            'requestwfs.user_id as usersourceid','tools.name as toolname','tools.id as idtool','type_requests.id as idtyperequest',
            'type_requests.name as type_requestname','processings.process_comment as processcomment','processings.is_finished as etat',
            'requestwfs.created_at as created_at')
            ->where('processings.id','=',$idprocess)
            ->orderBy('processings.id','DESC')
            ->get();
            
            $RequestProcessAchievements = DB::table('process_achievements')
            ->join('processings','processings.id','=','process_achievements.process_id') 
            ->select('process_achievements.id as idprocessachievements','process_achievements.process_id as achievementprocessid','process_achievements.process_achievement_date as achievementdate','process_achievements.process_achievement_comment as achievementcomment')
            ->where('processings.requestwf_id','=',$idrequest)
            ->orderBy('process_achievements.id','DESC')
            ->get();

            $sizeRequestProcessAchevements = $RequestProcessAchievements->count();
            
            
        
            return view('request.viewprocessingrequest', compact('RequestProcessingbyid','data','RequestProcessAchievements','sizeRequestProcessAchevements'));

            
            
    }
     // /*DropzoneJS
     public function postData() {
        $user_id = Auth::id();
        $target_dir = public_path()."/target-files/".$user_id."/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        if (isset($_FILES['file']) && !empty($_FILES['file'])) {

            //$file = $request->file('file');
            //$filename = time().'.'.$file->getClientOriginalExtension();

            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $return = (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) ? array("success"=>true) : array("success"=>false);
            echo json_encode($return);
            exit();
        }
        if (isset($_POST) && count($_POST)) {
            $post = $_POST;
            if (isset($post['ext_action']) && $post['ext_action'] == "delete_files") {
                if (!empty($post['filenames'])) {
                    foreach ($post['filenames'] as $key => $file) {
                        $target_file = $target_dir . $file;
                        if (file_exists($target_file)) @unlink($target_file);
                    }
                }
                echo json_encode(array("success"=>true));
                exit();
            }
        }
    }
    // DropzoneJS*/
    public function create()

    {
       // $id = Auth::id();
       
       $tools = DB::table('tools')->orderBy('name','asc')->get();
        //print_r($tools);
        //exit();
        return view('request.create',['tools' => $tools]);

    }
    
    public function store()
    {
        
        
        $user_id = Auth::id();
        $entity_id_user = User::getEntityIdByUserId($user_id);
        $testvar =  "entity_user_id:".$entity_id_user;
        $subject = request('subject');
        $tool_id = request('tool_id');
        $type_request_id = request('type_request_id');
        $tzIdMailReply = request('emailaddressereply');
        $content = request('content');
        $status_id = 1;
        ///echo "user_id=".$user_id;
        //exit();
       
        $requestwf = new Requestwf();
        $requestwf->subject = $subject;
        $requestwf->user_id = $user_id;
        $requestwf->tool_id = $tool_id;
        $requestwf->type_request_id = $type_request_id;
        $requestwf->content = $content;
        $requestwf->status_id = $status_id;
        $requestwf->save();
        $idreq = $requestwf->id;
        //insert adresse email destination response request
       
        $tzIdMailReplydecode = json_decode(stripslashes($tzIdMailReply));
        foreach($tzIdMailReplydecode as $idmailreply){
            $reqemailaddress = new Requestwf_email_address();
            $reqemailaddress->requestwf_id =  $idreq;
            $reqemailaddress->reply_email_address_id = $idmailreply;
            $reqemailaddress->save();
        }

        //================================================
        $target_dir_user = public_path()."/target-files/".$user_id."/";
        $target_request = public_path()."/docrequest/".$idreq."/dossier_demande/";
        if (!file_exists($target_request)) mkdir($target_request, 0777, true);
        $files = scandir($target_dir_user);
        foreach($files as $file) {
           
            if (in_array($file, array(".",".."))) continue;
            // If we copied this successfully, mark it for deletion
            if (copy($target_dir_user.$file, $target_request.$file)) {
                $delete[] = $target_dir_user.$file;
            }
        }
        //Helper::delTree($target_dir_user);
        foreach ($delete as $file) {
            unlink($file);
        }

       

        $request_history = new Request_history();
        $request_history->requestwf_id  = $requestwf->id;
        $request_history->etat_id = 1;
        $request_history->owner_request_user_id = Auth::id();
        $request_history->sender_request_user_id = Auth::id();
        $request_history->destination_entity_id = request('entity_id');
        $request_history->history_comment = request('content');
        $request_history->save();
         //========================================================//

        //========================================================//
        //===================send mail for administrator per next entity===============//
        $ListEmailAdminPerEntity = User::getListEmailAdressAdministratorByEntityId(request('entity_id'));
        $header = "Notification demande en attente de votre validation dans le système workflow";
        $subjectm = "Notification demande en attente de votre validation dans le système workflow";
        $zMessageNotification = "La demande ID ".$requestwf->id.", objet ".$subject." est actuellement en attente de votre validation dans le systeme workflow";
        foreach($ListEmailAdminPerEntity as $omailaddress){
            echo "adresse_mail=".$omailaddress->email_admin;
            
            Helper::sendnotification($omailaddress->email_admin,$subjectm,$header,$zMessageNotification);

        } 


        //==============================================================================//
      
        $entityid = Session::get('s_entityid_user');
        $lrequests = Requestwf::getListRequestByEntity($entityid);
        //return view('request.index', compact('lrequests'));$subject = request('subject');
        

        //========================================================//
        
       
    }
    public function approuvrequest($id)
    {
    
        //echo 'param='.$id;

        $zMessageNotification = "";
        $entityid_userconnected = Session::get('s_entityid_user');
        $zLibelleEntityValidator = Session::get('s_entityname_user');
        $zNameUserValidator = Auth::user()->name;
        $user_id = Auth::id();
        $tzParam = explode("_",$id);
        $request_history_id = $tzParam[0];
        $request_id = $tzParam[1];
        $toRequestwf = Requestwf::getRequestById($request_id) ;
        $zRequestNom = $toRequestwf[0]->Objet ;
        $tool_id = $tzParam[2];
        $type_request_id = $tzParam[3];
        //Get mail user sender
        $oUserSender = User::find($user_id);
        $zMailUserSender = $oUserSender->email;
        // end get mail user sender
        $currentrank = validation_request::getCurrentRank($entityid_userconnected,$tool_id,$type_request_id);
        //echo "rang=".$currentrank."------";
        
        $maxrank = validation_request::getMaxRank($tool_id,$type_request_id);
        //echo "maxrang=".$maxrank;
        $req_histories = DB::table('request_histories')->where('id',$request_history_id)->first();
        if($currentrank <> $maxrank){
            $nextentityapprouv = validation_request::getNextEntityApprouv($tool_id,$type_request_id,$currentrank);
           // echo "nextentityapprouv=".$nextentityapprouv;
           // echo "existance d'entite superieur"; 	
            
            $id = DB::table('request_histories')->insertGetId(
                ['requestwf_id' => $req_histories->requestwf_id,
                'etat_id' => 2,
                'owner_request_user_id' => $req_histories->owner_request_user_id,
                'sender_request_user_id' => $req_histories->sender_request_user_id,
                'destination_entity_id' => $req_histories->destination_entity_id,
                'history_comment' => $req_histories->history_comment, 
                'is_finished' => 1]
            );
            DB::table('request_histories')
            ->where('requestwf_id', $request_id)
            ->where('destination_entity_id', $entityid_userconnected)
            ->update(['is_finished' => 1]);
            //echo "valhistories=".$req_histories->owner_request_user_id;

            $id = DB::table('request_histories')->insertGetId(
                ['requestwf_id' => $req_histories->requestwf_id,
                'etat_id' => 1,
                'owner_request_user_id' => $req_histories->owner_request_user_id,
                'sender_request_user_id' => $user_id,
                'destination_entity_id' => $nextentityapprouv,
                'history_comment' => $req_histories->history_comment, 
                'is_finished' => 0]
            );
            //=================Get enity remaining===================================================//
            $zentiterestant = validation_request::getRemainingEntityList($tool_id,$type_request_id,$currentrank,$maxrank);
            //echo $zentiterestant;
            //exit();
            //==================Notification mail destinataire=======================================//
            $header = "Notification validation demande dans le système workflow";
            $subject = "Notification validation demande système workflow";
            $zMessageNotification = "Votre demande est actuellement approuvée au niveau de ".$zLibelleEntityValidator." par l'utilisateur ".$zNameUserValidator."<br> On attend encore la validation des entites: <b>".$zentiterestant."</b> avant le traitement";

            $QueryListeMailDestinationNotification = DB::table('requestwf_email_addresses')
            ->join('reply_email_addresses','reply_email_addresses.id','=','requestwf_email_addresses.reply_email_address_id')
            ->select('reply_email_addresses.rea_email as mailaddress')
            ->where('requestwf_email_addresses.requestwf_id','=',$request_id)
            ->get();
            
            $zUtilisateurDemandeurEntite = User::getEntityNameByUserId($user_id);
            $zUtilisateurDemandeurNom = User::getNameUserbyId($user_id) ;
            $zMessageNotificationOtherDestination = "La demande <b>" . $zRequestNom . "</b> de l'utilisateur <b> " . $zUtilisateurDemandeurNom . " </b> de l'entité <b>" . $zUtilisateurDemandeurEntite  . "</b> est actuellement approuvée au niveau de ".$zLibelleEntityValidator." par l'utilisateur ".$zNameUserValidator."<br> On attend encore la validation des entites: <b>".$zentiterestant."</b> avant le traitement";
            // Send mail notification for other destination
            foreach($QueryListeMailDestinationNotification as $omailaddress){
                //echo "adresse_mail=".$mailaddress;
                
                

                 Helper::sendnotification($omailaddress->mailaddress,$subject,$header,$zMessageNotificationOtherDestination);
                 sleep(2) ;

            } 
            //Send mail user sender
            Helper::sendnotification($zMailUserSender,$subject,$header,$zMessageNotification);


            
        }

    }
    public function checkmaxrank($id)
    {
        $entityid_userconnected = Session::get('s_entityid_user');
        $user_id = Auth::id();
        $tzParam = explode("_",$id);
        $request_history_id = $tzParam[0];
        $request_id = $tzParam[1];
        $tool_id = $tzParam[2];
        $type_request_id = $tzParam[3];
        $currentrank = validation_request::getCurrentRank($entityid_userconnected,$tool_id,$type_request_id);
        $maxrank = validation_request::getMaxRank($tool_id,$type_request_id);
        if($currentrank <> $maxrank){
            echo "0";
        }
        else{
            echo "1";
        }


    }
    public function rejectrequest()
    {
      
        $id = request('param_request');
        $reason_reject = request('reason_reject');
        $entityid_userconnected = Session::get('s_entityid_user');
        $user_id = Auth::id();
        $tzParam = explode("_",$id);
        $request_history_id = $tzParam[0];
        $request_id = $tzParam[1];
        $tool_id = $tzParam[2];
        $type_request_id = $tzParam[3];
        $req_histories = DB::table('request_histories')->where('id',$request_history_id)->first();
       
        

        $id = DB::table('request_histories')->insertGetId(
            ['requestwf_id' => $req_histories->requestwf_id,
            'etat_id' => 5,
            'owner_request_user_id' => $req_histories->owner_request_user_id,
            'sender_request_user_id' => $user_id,
            'destination_entity_id' => $entityid_userconnected,
            'history_comment' => $reason_reject, 
            'is_finished' => $req_histories->is_finished]
        );

        DB::table('requestwfs')
            ->where('id', $request_id)
            ->update(['status_id' => 4]);
        
        DB::table('request_histories')
        ->where('requestwf_id', $request_id)
        ->where('destination_entity_id', $entityid_userconnected)
        ->update(['is_finished' => -1]);
	
    
    }
    /*
    public function validforprocessing()
    {
        for($iCompteur = 0; $iCompteur < 5; $iCompteur++)
        {
            Helper::sendnotification('test@test.com','test','test','test') ;
            sleep(2) ;
        }
    }
    */
    public function validforprocessing(){
		$id = request('param_request');
        $reason_reject = request('reason_reject');
        $entityid_userconnected = Session::get('s_entityid_user');
        $user_id = Auth::id();
        $tzParam = explode("_",$id);
        $request_history_id = $tzParam[0];
        $request_id = $tzParam[1];
        $tool_id = $tzParam[2];
        $type_request_id = $tzParam[3];
        $entity_traitement_id = request('entity_id_resp');
        $entityidwithuserid = request('entityidwithuserid');
        $oEntityidwithuserid = json_decode($entityidwithuserid);
        
       
        $req_histories = DB::table('request_histories')->where('id',$request_history_id)->first();
        

         $id = DB::table('request_histories')->insertGetId(
            ['requestwf_id' => $req_histories->requestwf_id,
            'etat_id' => 3,
            'owner_request_user_id' => $req_histories->owner_request_user_id,
            'sender_request_user_id' => $req_histories->sender_request_user_id,
            'destination_entity_id' => $req_histories->destination_entity_id,
            'history_comment' => $req_histories->history_comment ,
            'is_finished' => $req_histories->is_finished
            ]
        );
       
        DB::table('requestwfs')
            ->where('id', $request_id)
            ->update(['status_id' => 2]);
        
        DB::table('request_histories')
        ->where('requestwf_id', $request_id)
        ->where('destination_entity_id', $entityid_userconnected)
        ->update(['is_finished' => 1]);

        $idprocess = DB::table('processings')->insertGetId(
            ['requestwf_id' => $req_histories->requestwf_id,
            //'etat_id' => 3,
            'owner_request_user_id' => $req_histories->owner_request_user_id,
            'sender_request_user_id' => $user_id,
            'process_comment' => request('approv_comment'), 
            'is_finished' => 0]
        );

        $toRequestwf = Requestwf::getRequestById($req_histories->requestwf_id) ;
        $zRequestNom = $toRequestwf[0]->Objet ;
        $zDemandeurNom = User::getNameUserbyId($req_histories->owner_request_user_id) ;
        $zDemandeurEntite = User::getEntityNameByUserId($req_histories->owner_request_user_id) ;

        foreach($oEntityidwithuserid as $oEntUser){
            $idEnt = $oEntUser->ent;
            $idEmp = $oEntUser->emp;
            $oprocessuser = new Process_user();
            $oprocessuser->process_id = $idprocess;
            $oprocessuser->entity_id = $idEnt;
            $oprocessuser->user_id = $idEmp;
            $oprocessuser->save();

            $zDestinataireEmail = User::getEmailUserbyId($idEmp) ;

           
            $zMailTitre = "Notification demande en attente de traitement" ;
            $zMailContenu = "La demande <b>" . $zRequestNom . "</b> de l'utilisateur <b>" . $zDemandeurNom . "</b> de l'entité <b>" . $zDemandeurEntite . "</b> est en attente de votre traitement." ;
            
            //echo $zDestinataireEmail . '<br/>' ;
            //echo $zMailTitre . '<br/>' ;
            //echo $zMailContenu ;
            //echo '<hr/>' ;
            
            Helper::sendnotification($zDestinataireEmail,$zMailTitre,$zMailTitre,$zMailContenu) ;
            sleep(2) ;



        }
        


       
    }
    
    

    public function processrequest($id){
		$id = request('param_request');
        $reason_reject = request('reason_reject');
        $entityid_userconnected = Session::get('s_entityid_user');
        $user_id = Auth::id();
        $tzParam = explode("_",$id);
        $request_history_id = $tzParam[0];
        $request_id = $tzParam[1];
        $tool_id = $tzParam[2];
        $type_request_id = $tzParam[3];
        $entity_traitement_id = request('entity_id_resp');
        $req_histories = DB::table('request_histories')->where('id',$request_history_id)->first();
        

         $id = DB::table('request_histories')->insertGetId(
            ['requestwf_id' => $req_histories->requestwf_id,
            'etat_id' => 3,
            'owner_request_user_id' => $req_histories->owner_request_user_id,
            'sender_request_user_id' => $req_histories->sender_request_user_id,
            'destination_entity_id' => $req_histories->destination_entity_id,
            'history_comment' => $req_histories->history_comment ,
            'is_finished' => $req_histories->is_finished
            ]
        );
       
        DB::table('requestwfs')
            ->where('id', $request_id)
            ->update(['status_id' => 2]);
        
        DB::table('request_histories')
        ->where('requestwf_id', $request_id)
        ->where('destination_entity_id', $entityid_userconnected)
        ->update(['is_finished' => 1]);

        $id = DB::table('processings')->insertGetId(
            ['requestwf_id' => $req_histories->requestwf_id,
            'etat_id' => 3,
            'owner_request_user_id' => $req_histories->owner_request_user_id,
            'sender_request_user_id' => $user_id,
            'entity_id' => $entity_traitement_id ,
            'process_comment' => request('approv_comment'), 
            'is_finished' => 0]
        );
       
    }
    public function searchrequest(){
        return view('request.searchrequest');
    }

    public function searchstatusrequestbyentity(){
        echo 'ici';
        $lrequests = Requestwf::getListAllRequestInProcess();
        $ListTypeRequest = DB::Table('type_requests')
        ->orderBy('name','ASC')
        ->get();
        $NumberRecordInit1 = $lrequests->count();
        //echo $NumberRecordInit1;
        //exit();
        return view('request.searchstatusrequestbyentity', compact('lrequests','ListTypeRequest','NumberRecordInit1'));
        
    }
    public function test(){
        $ListTypeRequest = DB::Table('type_requests')
        ->orderBy('name','ASC')
        ->get();
        return view('request.searchprocessrequestbyentityoremploye',compact('ListTypeRequest'));
    }
    public function showprocessrequestbyentityoremp(){
        $lrequests = Requestwf::getListAllRequestInProcess();
        $ListTypeRequest = DB::Table('type_requests')
        ->orderBy('name','ASC')
        ->get();
        $NumberRecordInit1 = $lrequests->count();
        //echo $NumberRecordInit1;
        //exit();
        return view('request.searchprocessrequestbyentityoremploye', compact('lrequests','ListTypeRequest','NumberRecordInit1'));
    }
    public function showListRequestByStatusProcess(){
        $istatusID = request('istatusID');
        $iuserID = request('iuserID');
        $ientityID = request('iEntityID');
        $zSQLWhereEntity = " and process_users.entity_id =".$ientityID;
        switch($istatusID)
            {
                case 1 ://Demande en attente traitement
                    $zSQLWhere = " and processings.is_finished = 0 "; // En attente traitement
                break ;
                case 2 : // Demande en cours traitement
                    $zSQLWhere = " and processings.is_finished = 2 ";// Traitement en cours
                break ;
                case 3 : // Demande traite partiellement
                    $zSQLWhere = " and processings.is_finished = 3 ";// Traitement terminé partiellement
                break ;
                default: // Demande traité
                $zSQLWhere = " and processings.is_finished = 1 ";// Traitement terminé
                    
            }

        $zRowListRequest = Requestwf::getListRequestByStatusProcess();
        
        $zListrequest = "select requestwfs.id as idrequest, requestwfs.status_id as status, requestwfs.subject as objectreq, requestwfs.user_id as sender, 
                        requestwfs.created_at as datecreation, process_users.user_id as urserresptrait, 
                        type_requests.name as nametyperequest, tools.name as nametool 
                        from process_users inner join processings 
                        on process_users.process_id = processings.id inner join requestwfs 
                        on processings.requestwf_id = requestwfs.id inner join type_requests 
                        on requestwfs.type_request_id = type_requests.id inner join tools 
                        on requestwfs.tool_id = tools.id  where process_users.user_id = ".$iuserID.$zSQLWhereEntity.$zSQLWhere.
                        "group by processings.requestwf_id";
        
        $zquery = DB::connection('mysql')->select($zListrequest);
        $iNbreEnreg = sizeof($zquery);
        $zRowListRequest = "";
        foreach($zquery as $requestwf){
            $zRowListRequest .= '<tr class="item-tr">
            <td><a href="">'.$requestwf->idrequest.'</td>
              <td>'.$requestwf->objectreq.'</td>
              <td>'.$requestwf->nametool.'</td>
              <td>'.$requestwf->nametyperequest.'</td>
              <td>'.$requestwf->status.'</td>
              <td>'.$requestwf->datecreation.'</td>
              <td><a href="'.url("viewdetailrequest/{$requestwf->idrequest}").'>"><i class="fas fa-eye text-primary"></i></a>                      
              </td>
            </tr>';
        }
        
        echo $iNbreEnreg.'_'.$zRowListRequest;
    }

    public function showListRequestByStatus(){

        
        $istatusID = request('istatusID');
        $iuserID = request('iuserID');
        $ientityID = request('iEntityID');
        $zSQLWhereEntity = " and request_histories.destination_entity_id =".$ientityID;
        switch($istatusID)
            {
                case 1 ://Demande en attente validation
                    $zSQLWhere = " and request_histories.is_finished = 0 "; 
                break ;
                case 2 : // Demande validé par notre entité
                    $zSQLWhere = " and request_histories.is_finished = 1 ";
                break ;
                case 3 : // Demande rejeté par notre entité
                    $zSQLWhere = " and request_histories.is_finished = -1 ";
                break ;
                default: // Demande traité
                $zSQLWhere = " and request_histories.is_finished > 0 ";// Traitement terminé
                    
            }

        $zRowListRequest = Requestwf::getListRequestByStatusProcess();
        
        $zListrequest = "select requestwfs.id as idrequest, requestwfs.status_id as statusid, requestwfs.subject as objectreq, requestwfs.user_id as sender, 
                        requestwfs.created_at as datecreation, request_histories.etat_id as idvalidation,statuses.name as status, request_histories.sender_request_user_id as idusersenderrequest,
                        request_histories.history_comment as comment, 
                        type_requests.name as nametyperequest, tools.name as nametool 
                        from request_histories inner join requestwfs 
                        on request_histories.requestwf_id = requestwfs.id inner join type_requests  
                        on requestwfs.type_request_id = type_requests.id inner join tools 
                        on requestwfs.tool_id = tools.id  
                        inner join statuses on requestwfs.status_id = statuses.id where request_histories.destination_entity_id = ".$ientityID.$zSQLWhereEntity.$zSQLWhere.
                        "group by request_histories.requestwf_id";
        
        $zquery = DB::connection('mysql')->select($zListrequest);
        $iNbreEnreg = sizeof($zquery);
        $zRowListRequest = "";
        foreach($zquery as $requestwf){
            $zurl = url('suividemande/'.$requestwf->idrequest);
            $zRowListRequest .= '<tr class="item-tr">
            <td><a href="">'.$requestwf->idrequest.'</td>
              <td>'.$requestwf->objectreq.'</td>
              <td>'.$requestwf->nametool.'</td>
              <td>'.$requestwf->nametyperequest.'</td>
              <td>'.$requestwf->status.'</td>
              <td>'.$requestwf->datecreation.'</td>
              <td><a href="'.url("viewdetailrequest/{$requestwf->idrequest}").'"><i class="fas fa-eye text-primary"></i></a> 
              <a href="'.$zurl.'" class="btn btn-info">voir historique demande</a>  
                               
              </td>
            </tr>';
        }
        
        echo $iNbreEnreg.'_'.$zRowListRequest;
    }
    public function viewdetailrequest($id){
        //$queryDetailRequest = DB::table('');
        $Detailrequestwf = Requestwf::getRequestById($id);
        $ListProcessAchievementByRequestID = Process_achievement::getListProcessAchievementByRequesId($id);
        $iNombreTraitement = $ListProcessAchievementByRequestID->count();
        return view('request.viewdetailrequest',compact('Detailrequestwf','ListProcessAchievementByRequestID','iNombreTraitement'));
    }
    
    
}
