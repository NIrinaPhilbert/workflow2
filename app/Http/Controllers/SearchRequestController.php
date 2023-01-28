<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function afficher(){
        $data = 8;
        return view ('entity.entitylist',compact('data'));
      
    }
    public function showrequestaccordionformat()
    {

        if (isset($_GET['got']) && !empty($_GET['got']))
	    {
            if ($_GET['got'] == "list")
            {
                $limit = 20;
                if (!isset($_GET['page'])) {
                    $_GET['page'] = 1;
                }
                $per_page = $_GET['page'];
                if(!isset($_POST['search']) || empty($_POST['search'])) {
                   
                    //$sql = "SELECT * FROM lte_accordion LIMIT ".$limit." OFFSET " . (($per_page-1)*$limit);
                    //echo "start";
                    $DataRequest = DB::table('requestwfs')
                                    ->take($limit)
                                    ->skip((($per_page-1)*$limit))
                                    ->get();
                    /*echo '<pre>';
                    print_r($DataRequest);
                    echo '</pre>';
                    echo "end";*/


                } else {
                    //$sql = "SELECT * FROM lte_accordion WHERE accordion_name LIKE '%".$_POST['search']."%' LIMIT ".$limit." OFFSET " . (($per_page-1)*$limit);
                    $search = $_POST['search'];
                    $DataRequest = $DataRequest = DB::table('requestwfs')
                                    ->where('requestwfs.subject','LIKE',"%$search%")
                                    ->take($limit)
                                    ->skip((($per_page-1)*$limit))
                                    ->get();
                
                }
                //$result = $db_connect->query($sql);
                $data['data'] = array();
                if ($DataRequest->count() > 0)
                {
                // output data of each row
                    //while($row = $result->fetch_assoc())
                    foreach($DataRequest as $orequest)
                    {
                        $data['data'][] = array(
                            'id' => $orequest->id,
                            'name' => $orequest->subject,
                            'date' => date('d/m/Y h:i:s A', strtotime($orequest->created_at))
                        );
                    }
                }
                if(!isset($_POST['search']) || empty($_POST['search'])) {
                    //$query = "SELECT * FROM lte_accordion";
                    $query = DB::table('requestwfs')
                            ->get();
                } else {
                    //$query = "SELECT * FROM lte_accordion WHERE accordion_name LIKE '%".$_POST['search']."%'";
                    $search = $_POST['search'];
                    $query = DB::table('requestwfs')
                            ->where('requestwfs.subject','LIKE',"%$search%")
                            ->get();
                }
                //$numRows = $db_connect->query($query)->num_rows;
                $numRows = $query->count();
                //$db_connect->close();
                if ($numRows<$limit) {
                    $nbpage = 1;
                }else{
                    if (fmod($numRows,$limit)>0) {
                        $nbpage = $numRows%$limit;
                        $nbpage++;
                    }else $nbpage = $numRows%$limit;
                }
                $data['pagination'] = array();
                $data['pagination']['nbpage'] = $nbpage;
                $data['pagination']['nbtotal'] = $numRows;
                echo json_encode($data);
                exit();
            }
            else if ($_GET['got'] == "sublist")
            {
                //$sql = "SELECT * FROM lte_accordion WHERE accordion_id = '".$_POST['id']."' LIMIT 1";
                $id = $_POST['id'];
                $datasql = DB::table('requestwfs')
                            ->where('requestwfs.id','=',$id)
                            ->take(1)
                            ->get();
                //$result = $db_connect->query($sql);
                $num_rows = $datasql->count();
                $data = array('tpl'=>'');
                if ($num_rows > 0)
                {
                // output data of each row
                    //while($row = $result->fetch_assoc())
                    foreach($datasql as $oreq)
                    {
                        $name = $oreq->subject;
                        $date = date('d/m/Y h:i:s A', strtotime($oreq->created_at));
                        $data['tpl'] = '<div class="mailbox-read-info pt-0 pl-3 pr-3">
                                <h5 class="info-sender">
                                <span class="info-name">SDSP Manjakandriana</span>
                                <span class="text-muted info-mail">&lt;sdspmanjakandriana@gmail.com&gt;</span>
                                </h5> 
                                <h6>
                                <span class="text-muted info-receiver">To</span>
                                <span class="info-receiver">Philibert</span><a class="text-muted info-toggler dropdown-toggle" data-toggle="dropdown"></a>
                                <div class="dropdown-menu pt-3 pr-2 pb-3 pl-2">
                                    <table class="table-mail-info">
                                    <tr>
                                        <td><span class="text-muted">From :</span></td>
                                        <td><strong>SDSP Manjakandriana</strong><br/><span class="text-muted">&lt;sdspmanjakandriana@gmail.com&gt;</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">To :</span></td>
                                        <td><span>Philibert Randriamiaranirina</span><br/><span>&lt;randriamiaranirina@gmail.com&gt;</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Date :</span></td>
                                        <td><span>'.$date.'</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Object :</span></td>
                                        <td><span>'.$name.'</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Sent by :</span></td>
                                        <td><span>workflownv</span></td>
                                    </tr>
                                    </table>
                                </div>
                                </h6>
                            </div>
                            <div class="mailbox-read-message pt-2 pr-4 pb-2 pl-4">
                                <p>
                                <label class="mt-1">Entité source</label><br/>
                                <span>SDSP Manjakandriana</span>
                                </p>
                                <p>
                                <label class="mt-1">Utilisateur source</label><br/>
                                <span>SDSP Manjakandriana</span>
                                </p>
                                <p>
                                <label class="mt-1">Outil</label><br/>
                                <span>DHIS2 COVAX</span>
                                </p>
                                <p>
                                <label class="mt-1">Type de la demande</label><br/>
                                <span>Demande compte d\'accès</span>
                                </p>
                                <p>
                                <label class="mt-1">Corps de la demande</label><br/>
                                <span>
                                    Bonjour à tous,<br/>
                                    En tant que AT auprès du SDSP Manjakandriana, j\'ai besoin du compte d\'accès en DHIS2.<br/>
                                    En attaché ci-dessous les demandes relatifs.<br/>
                                    Cordialement
                                </span>
                                </p>
                                <p>
                                <label class="mt-1">Status de la demande</label><br/>
                                <span>En cours de traitement</span>
                                </p>
                            </div>
                            <div class="bg-white pt-3 pl-4 pr-4">
                            <label class="mb-3">Lettre de demande ou pièces jointes</label>
                            <ul class="mailbox-attachments align-items-stretch clearfix">
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-pdf.png" alt="PDF"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">Lettre_3.pdf</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>187 KB</span>
                                        <a href="assets_template/dist/pj/Lettre_3.pdf" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-pdf.png" alt="PDF"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">fr-troublesbipolaires.pdf</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>142 KB</span>
                                        <a href="assets/dist/pj/fr-troublesbipolaires.pdf" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-xlsx.png" alt="XLSX"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">Template_Guest_Invitations_V4.xlsx</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>33 KB</span>
                                        <a href="assets/dist/pj/Template_Guest_Invitations_V4.xlsx" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-doc.png" alt="DOC"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">Lettre_3.doc</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>291 KB</span>
                                        <a href="assets/dist/pj/Lettre_3.doc" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/pj/This-image.jpg" alt="JPG"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">This-image.jpg</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>96 KB</span>
                                        <a href="assets/dist/pj/This-image.jpg" class="btn btn-default btn-sm float-right link-view ml-1" title="Voir" data-toggle="lightbox" data-title="This-image.jpg" data-gallery="gallery"><i class="fas fa-eye"></i></a>
                                        <a href="assets/dist/pj/This-image.jpg" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-xlsx.png" alt="XLSX"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">Template_Guest_Invitations_V4.xlsx</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>33 KB</span>
                                        <a href="assets_template/dist/pj/Template_Guest_Invitations_V4.xlsx" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                            </ul>
                            </div>
                            <div class="bg-white pt-2 pb-3 pl-4 pr-4">
                            <label class="mb-3">Liste traitement de la demande</label>
                            <table class="table table-bordered mx-auto w-100">
                                <thead>
                                <tr>
                                    <th>Déscription</th>
                                    <th>Date</th>
                                    <th>Pièces jointes</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Il y a encore quelques tâches à faire</td>
                                    <td>14/06/2022</td>
                                    <td>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/img/icons/icon-pdf.png" alt="PDF">
                                        <span class="pj-name ml-1">Lettre_3.pdf</span>
                                        </label>
                                        <a href="assets_template/dist/pj/Lettre_3.pdf" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/img/icons/icon-xlsx.png" alt="XLSX">
                                        <span class="pj-name ml-1">Template_Guest_Invitations_V4.xlsx</span>
                                        </label>
                                        <a href="assets_template/dist/pj/Template_Guest_Invitations_V4.xlsx" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Suite traitement</td>
                                    <td>14/06/2022</td>
                                    <td>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/img/icons/icon-doc.png" alt="DOC">
                                        <span class="pj-name ml-1">Lettre_3.doc</span>
                                        </label>
                                        <a href="assets_template/dist/pj/Lettre_3.doc" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    </td>
                                </tr><tr>
                                    <td>Votre traitement est terminé</td>
                                    <td>15/06/2022</td>
                                    <td>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/img/icons/icon-pdf.png" alt="PDF">
                                        <span class="pj-name ml-1">fr-troublesbipolaires.pdf</span>
                                        </label>
                                        <a href="assets_template/dist/pj/fr-troublesbipolaires.pdf" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/pj/This-image.jpg" alt="JPG">
                                        <span class="pj-name ml-1">This-image.jpg</span>
                                        </label>
                                        <a href="assets_template/dist/pj/This-image.jpg" class="btn btn-default btn-xs float-right link-view ml-1" title="Voir" data-toggle="lightbox" data-title="This-image.jpg" data-gallery="gallery"><i class="fas fa-eye"></i></a>
                                        <a href="assets_template/dist/pj/This-image.jpg" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>';
                    }
                }
                
                echo json_encode($data);
                exit();
            }
        }
    }//===================end showrequest format accordeon========================//
    public function showrequestaccordionformatmulticritere()
    {

        if (isset($_GET['got']) && !empty($_GET['got']))
	    {
            if ($_GET['got'] == "list")
            {
                $limit = 20;
                if (!isset($_GET['page'])) {
                    $_GET['page'] = 1;
                }
                $per_page = $_GET['page'];
                if(!isset($_POST['typerequestID']) || empty($_POST['typerequestID'])) {
                   
                    //$sql = "SELECT * FROM lte_accordion LIMIT ".$limit." OFFSET " . (($per_page-1)*$limit);
                    //echo "start";
                    $DataRequest = DB::table('requestwfs')
                                    ->take($limit)
                                    ->skip((($per_page-1)*$limit))
                                    ->get();
                    /*echo '<pre>';
                    print_r($DataRequest);
                    echo '</pre>';
                    echo "end";*/


                } else {
                    //$sql = "SELECT * FROM lte_accordion WHERE accordion_name LIKE '%".$_POST['search']."%' LIMIT ".$limit." OFFSET " . (($per_page-1)*$limit);
                    $typerequestid = $_POST['typerequestID'];
                    $entityid = $_POST['entityID'];
                   

                    //=================================================//
                    $DataRequest = DB::table('request_histories')
                                                ->join('requestwfs','requestwfs.id','=','request_histories.requestwf_id')
                                                ->join('type_requests','type_requests.id', '=', 'requestwfs.type_request_id')
                                                ->join('tools','tools.id', '=', 'requestwfs.tool_id')
                                                ->select('requestwfs.id as idrequest','requestwfs.subject as Objetwf','requestwfs.created_at as created_at')
                                                ->where('requestwfs.type_request_id','=',$typerequestid)
                                                ->where('request_histories.is_finished','=',0)
                                                ->where('request_histories.destination_entity_id','=',$entityid)
                                                ->orderBy('requestwfs.id','DESC')
                                                ->take($limit)
                                                ->skip((($per_page-1)*$limit))
                                                ->get();      



                    //=================================================//

                    
                
                }
                //$result = $db_connect->query($sql);
                $data['data'] = array();
                if ($DataRequest->count() > 0)
                {
                // output data of each row
                    //while($row = $result->fetch_assoc())
                    foreach($DataRequest as $orequest)
                    {
                        $data['data'][] = array(
                            'id' => $orequest->idrequest,
                            'name' => $orequest->Objetwf,
                            'date' => date('d/m/Y h:i:s A', strtotime($orequest->created_at))
                        );
                    }
                }
                if(!isset($_POST['search']) || empty($_POST['search'])) {
                    //$query = "SELECT * FROM lte_accordion";
                    $query = DB::table('requestwfs')
                            ->get();
                } else {
                    //$query = "SELECT * FROM lte_accordion WHERE accordion_name LIKE '%".$_POST['search']."%'";
                    $search = $_POST['search'];
                    $query = DB::table('requestwfs')
                            ->where('requestwfs.subject','LIKE',"%$search%")
                            ->get();
                }
                //$numRows = $db_connect->query($query)->num_rows;
                $numRows = $query->count();
                //$db_connect->close();
                if ($numRows<$limit) {
                    $nbpage = 1;
                }else{
                    if (fmod($numRows,$limit)>0) {
                        $nbpage = $numRows%$limit;
                        $nbpage++;
                    }else $nbpage = $numRows%$limit;
                }
                $data['pagination'] = array();
                $data['pagination']['nbpage'] = $nbpage;
                $data['pagination']['nbtotal'] = $numRows;
                echo json_encode($data);
                exit();
            }
            else if ($_GET['got'] == "sublist")
            {
                //$sql = "SELECT * FROM lte_accordion WHERE accordion_id = '".$_POST['id']."' LIMIT 1";
                $id = $_POST['id'];
                $datasql = DB::table('requestwfs')
                            ->where('requestwfs.id','=',$id)
                            ->take(1)
                            ->get();
                //$result = $db_connect->query($sql);
                $num_rows = $datasql->count();
                $data = array('tpl'=>'');
                if ($num_rows > 0)
                {
                // output data of each row
                    //while($row = $result->fetch_assoc())
                    foreach($datasql as $oreq)
                    {
                        $name = $oreq->subject;
                        $date = date('d/m/Y h:i:s A', strtotime($oreq->created_at));
                        $data['tpl'] = '<div class="mailbox-read-info pt-0 pl-3 pr-3">
                                <h5 class="info-sender">
                                <span class="info-name">SDSP Manjakandriana</span>
                                <span class="text-muted info-mail">&lt;sdspmanjakandriana@gmail.com&gt;</span>
                                </h5> 
                                <h6>
                                <span class="text-muted info-receiver">To</span>
                                <span class="info-receiver">Philibert</span><a class="text-muted info-toggler dropdown-toggle" data-toggle="dropdown"></a>
                                <div class="dropdown-menu pt-3 pr-2 pb-3 pl-2">
                                    <table class="table-mail-info">
                                    <tr>
                                        <td><span class="text-muted">From :</span></td>
                                        <td><strong>SDSP Manjakandriana</strong><br/><span class="text-muted">&lt;sdspmanjakandriana@gmail.com&gt;</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">To :</span></td>
                                        <td><span>Philibert Randriamiaranirina</span><br/><span>&lt;randriamiaranirina@gmail.com&gt;</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Date :</span></td>
                                        <td><span>'.$date.'</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Object :</span></td>
                                        <td><span>'.$name.'</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Sent by :</span></td>
                                        <td><span>workflownv</span></td>
                                    </tr>
                                    </table>
                                </div>
                                </h6>
                            </div>
                            <div class="mailbox-read-message pt-2 pr-4 pb-2 pl-4">
                                <p>
                                <label class="mt-1">Entité source</label><br/>
                                <span>SDSP Manjakandriana</span>
                                </p>
                                <p>
                                <label class="mt-1">Utilisateur source</label><br/>
                                <span>SDSP Manjakandriana</span>
                                </p>
                                <p>
                                <label class="mt-1">Outil</label><br/>
                                <span>DHIS2 COVAX</span>
                                </p>
                                <p>
                                <label class="mt-1">Type de la demande</label><br/>
                                <span>Demande compte d\'accès</span>
                                </p>
                                <p>
                                <label class="mt-1">Corps de la demande</label><br/>
                                <span>
                                    Bonjour à tous,<br/>
                                    En tant que AT auprès du SDSP Manjakandriana, j\'ai besoin du compte d\'accès en DHIS2.<br/>
                                    En attaché ci-dessous les demandes relatifs.<br/>
                                    Cordialement
                                </span>
                                </p>
                                <p>
                                <label class="mt-1">Status de la demande</label><br/>
                                <span>En cours de traitement</span>
                                </p>
                            </div>
                            <div class="bg-white pt-3 pl-4 pr-4">
                            <label class="mb-3">Lettre de demande ou pièces jointes</label>
                            <ul class="mailbox-attachments align-items-stretch clearfix">
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-pdf.png" alt="PDF"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">Lettre_3.pdf</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>187 KB</span>
                                        <a href="assets_template/dist/pj/Lettre_3.pdf" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-pdf.png" alt="PDF"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">fr-troublesbipolaires.pdf</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>142 KB</span>
                                        <a href="assets/dist/pj/fr-troublesbipolaires.pdf" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-xlsx.png" alt="XLSX"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">Template_Guest_Invitations_V4.xlsx</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>33 KB</span>
                                        <a href="assets/dist/pj/Template_Guest_Invitations_V4.xlsx" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-doc.png" alt="DOC"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">Lettre_3.doc</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>291 KB</span>
                                        <a href="assets/dist/pj/Lettre_3.doc" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/pj/This-image.jpg" alt="JPG"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">This-image.jpg</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>96 KB</span>
                                        <a href="assets/dist/pj/This-image.jpg" class="btn btn-default btn-sm float-right link-view ml-1" title="Voir" data-toggle="lightbox" data-title="This-image.jpg" data-gallery="gallery"><i class="fas fa-eye"></i></a>
                                        <a href="assets/dist/pj/This-image.jpg" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                                <li>
                                <span class="mailbox-attachment-icon"><img class="icon" src="assets_template/dist/img/icons/icon-xlsx.png" alt="XLSX"></span>

                                <div class="mailbox-attachment-info">
                                    <label class="mailbox-attachment-name">Template_Guest_Invitations_V4.xlsx</label>
                                        <span class="mailbox-attachment-size clearfix mt-1">
                                        <span>33 KB</span>
                                        <a href="assets_template/dist/pj/Template_Guest_Invitations_V4.xlsx" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                        </span>
                                </div>
                                </li>
                            </ul>
                            </div>
                            <div class="bg-white pt-2 pb-3 pl-4 pr-4">
                            <label class="mb-3">Liste traitement de la demande</label>
                            <table class="table table-bordered mx-auto w-100">
                                <thead>
                                <tr>
                                    <th>Déscription</th>
                                    <th>Date</th>
                                    <th>Pièces jointes</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Il y a encore quelques tâches à faire</td>
                                    <td>14/06/2022</td>
                                    <td>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/img/icons/icon-pdf.png" alt="PDF">
                                        <span class="pj-name ml-1">Lettre_3.pdf</span>
                                        </label>
                                        <a href="assets_template/dist/pj/Lettre_3.pdf" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/img/icons/icon-xlsx.png" alt="XLSX">
                                        <span class="pj-name ml-1">Template_Guest_Invitations_V4.xlsx</span>
                                        </label>
                                        <a href="assets_template/dist/pj/Template_Guest_Invitations_V4.xlsx" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Suite traitement</td>
                                    <td>14/06/2022</td>
                                    <td>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/img/icons/icon-doc.png" alt="DOC">
                                        <span class="pj-name ml-1">Lettre_3.doc</span>
                                        </label>
                                        <a href="assets_template/dist/pj/Lettre_3.doc" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    </td>
                                </tr><tr>
                                    <td>Votre traitement est terminé</td>
                                    <td>15/06/2022</td>
                                    <td>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/img/icons/icon-pdf.png" alt="PDF">
                                        <span class="pj-name ml-1">fr-troublesbipolaires.pdf</span>
                                        </label>
                                        <a href="assets_template/dist/pj/fr-troublesbipolaires.pdf" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    <div class="d-block pj-data text-left">
                                        <label class="pj-content d-inline-block">
                                        <img class="pj-icon" src="assets_template/dist/pj/This-image.jpg" alt="JPG">
                                        <span class="pj-name ml-1">This-image.jpg</span>
                                        </label>
                                        <a href="assets_template/dist/pj/This-image.jpg" class="btn btn-default btn-xs float-right link-view ml-1" title="Voir" data-toggle="lightbox" data-title="This-image.jpg" data-gallery="gallery"><i class="fas fa-eye"></i></a>
                                        <a href="assets_template/dist/pj/This-image.jpg" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                    </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>';
                    }
                }
                
                echo json_encode($data);
                exit();
            }
        }
    }//===================end showrequest format accordeon========================//
    //============================================================================//
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
}
