<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper as Helper;

use App\Tool;
use App\Processing;
use App\Requestwf;
use App\Request_history;
use App\User;
use App\Process_achievement;
use App\validation_request;
use Illuminate\Support\Facades\DB;
use Session;

class ProcessAchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // /*DropzoneJS
    public function postDataProcess() {
        $user_id = Auth::id();
        $target_dir = public_path()."/target-files-process/".$user_id."/";
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
    public function finalizerequest(Request $request)
    {
        $user_id = Auth::id();
        //$id = $_POST['param_request'];
        $param_process = $_POST['param_process'];//idprocess+idrequest
        $tzParam_process = explode('_',$param_process);
        $idprocess = $tzParam_process[0];
        $idrequest = $tzParam_process[1];
        $process_status = $_POST['process_status'];
        $process_date = $_POST['process_date'];
        $comment_process = $_POST['comment_process'];
        //si status traitement == 1
        if($process_status == 1){//traitement fini immediat

            DB::table('processings')
            ->where('requestwf_id', $idrequest)
            ->update(['is_finished' => 1]);

               
            DB::table('requestwfs')
            ->where('id', $idrequest)
            ->update(['status_id' => 3]);
        }
    }
    public function store(Request $request)
    {
        $user_id = Auth::id();
        //$id = $_POST['param_request'];
        $param_process = $_POST['param_process'];//idprocess+idrequest
        $tzParam_process = explode('_',$param_process);
        $idprocess = $tzParam_process[0];
        $idrequest = $tzParam_process[1];
        $process_status = $_POST['process_status'];
        $process_date = $_POST['process_date'];
        $comment_process = $_POST['comment_process'];
        //si status traitement == 1
        if($process_status == 1){//traitement fini immediat

            DB::table('processings')
            ->where('requestwf_id', $idrequest)
            ->update(['is_finished' => 1]);

               
            DB::table('requestwfs')
            ->where('id', $idrequest)
            ->update(['status_id' => 3]);

        }else{

            DB::table('requestwfs')
            ->where('id',$idrequest)
            ->update(['status_id' => 5]);

            DB::table('processings')
            ->where('requestwf_id', $idrequest)
            ->update(['is_finished' => 2]);

            
        }
        //insert into process
            $idprocessachievement = DB::table('process_achievements')->insertGetId(
                ['process_id' => $idprocess,
                'user_id' => $user_id,
                'process_achievement_comment' => $comment_process,
                'process_achievement_date' => $process_date
                ]
            );
        //Création fichier
        //$delete[] = "";
        if(file_exists(public_path()."/target-files-process/".$user_id."/")){
                $target_dir_user = public_path()."/target-files-process/".$user_id."/";
                $target_process = public_path()."/docrequest/".$idrequest."/dossier_traitement/".$idprocessachievement."/";
                if (!file_exists($target_process)) mkdir($target_process, 0777, true);
                $files = scandir($target_dir_user);
                foreach($files as $file) {
                
                    if (in_array($file, array(".",".."))) continue;
                    // If we copied this successfully, mark it for deletion
                    if (copy($target_dir_user.$file, $target_process.$file)) {
                        $delete[] = $target_dir_user.$file;
                    }
                }
                Helper::delTree($target_dir_user);
                //traitement suppression dossier
                //if(sizeof($delete) > 0){
                /*foreach ($delete as $file) {
                    unlink($file);
                }
                //}*/

                //fin création fichier
        }
        echo "1";

        //===========================================================================================//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
