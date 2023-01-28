<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\type_request;
use App\type_request_tool;
use App\tool;
use App\validation_request;


class TypeRequestController extends Controller
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
        $type_requests = DB::table('type_requests')
                        ->orderBy('name','asc')
                        ->paginate(7);

        return view('type demande.index', ['type_requests' => $type_requests]);
        
    }
    public function showTypeRequestByToolId(){
        //dd($request);
        //dd($request->plateform);
       
        $toolId = request('iToolId');
        $data=type_request::getTypeRequestByIdTool($toolId);
        //echo $data;
        //dd($data);
        //return response()->json(['data'=>$data]);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$id = DB::table('users')->insertGetId(
            ['email' => 'john@example.com', 'votes' => 0]
        );
        DB::table('users')->insert([
            ['email' => 'taylor@example.com', 'votes' => 0],
            ['email' => 'dayle@example.com', 'votes' => 0]
        ]);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
    }
    public function createrequestbytool(){
        
        $dataTypeRequestAutocomplete ='[';
        $type_requests = DB::table('type_requests')->orderBy('name','asc')->get();
        foreach($type_requests as $type_request){
            $dataTypeRequestAutocomplete.= '{ label:"'.$type_request->name.'", val:'.$type_request->id.'},';
        }
        $dataTypeRequestAutocomplete = implode( ',', array_slice( explode( ',', $dataTypeRequestAutocomplete ), 0, -1 ));
        $dataTypeRequestAutocomplete.=']';
        //echo $dataTypeRequestAutocomplete;
        $tools=DB::table('tools')->orderBy('name','asc')->get();
        return view('type demande.create_type_request_by_tool',compact('tools','dataTypeRequestAutocomplete'));
    }
    public function edittyperequest($id){
        
        $tools=DB::table('tools')->orderBy('name','asc')->get();
        $type_request = type_request::find($id);
        $tools_type_request = type_request::getToolByIdTypeRequest($id);
        //dd($tools_type_request);
        //exit();


        //dd($tools1);
        return view('type demande.edit_type_request', compact('tools','type_request','tools_type_request'));
        
    }
    public function addApprobation(Request $request)
    {
        //echo "ici add approbation";
        //exit();
        $typeRequestId = request('type_request_id');
        $toolId = request('tool_id');
        $zEntityRank= request('listeplateforme');
        $tzEntityRank = explode(",",$zEntityRank);
        $iCountTab = sizeof($tzEntityRank);
        type_request::deleteApprobation($typeRequestId,$toolId);
        for($i=0;$i<$iCountTab;$i++) {
            
            $tabEntRank = explode("_",$tzEntityRank[$i]);
            $data = new validation_request();
            $data->type_request_id = $typeRequestId;
            $data->tool_id  = $toolId;
            $data->entity_id  = $tabEntRank[0];
            $data->rank = $tabEntRank[1];
            $data->save();
        
        }
       

        $toApprobation = type_request::viewListApprobation();

        return view('type demande.approbation', compact('toApprobation'));
        
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
    public function viewtyperequest($id)
    
    {
        
       
        $typerequest = type_request::find($id);
        $tools_type_request = $typerequest->tools;
        return view('type demande.viewtyperequest', compact('typerequest','tools_type_request'));

    }
    public function viewapprobationtyperequest($id)
    {
        $tiTR_ToolId = explode("_", $id) ;
        $typeRequestId = $tiTR_ToolId[0];
        $toolId = $tiTR_ToolId[1];
        $type_request = type_request::find($typeRequestId);
        //dd($type_request);
        $tool= tool::find($toolId);
        $entities=DB::table('entities')->orderBy('name','asc')->get();
        //dd($tool);
        $toApprobation = type_request::viewListApprobationByTypeRequestTool($typeRequestId,$toolId);
        return view('type demande.viewapprobationtyperequest', compact('toApprobation','type_request','tool','entities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$type_request = DB::table('type_requests')
                                ->where('id','=',$id)
                                ->get();
        dd($type_request);*/
        
        $tools = DB::table('tools')->orderBy('name','asc')->get();
        //dd($tools);
        $type_request = type_request::find($id);
        $tools_type_request = $type_request->tools;
        //dd($tools1);
        return view('type demande.edit', compact('type_request','tools','tools_type_request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    //public function update(Request $request)
    {
        $id = $_POST['IdTypeDemande'];
        $type_request = type_request::find($id);
        type_request::where('id',$id)->update(array('name'=>$_POST['LibTypeDemande'],'description'=>$_POST['Description']));
        $zData = $_POST['data'];
        $tzData = explode("|",$zData);
        $tiToolsID = explode(":",$tzData[1]); 
        //$zToolsId = request('listeplateforme');
        //echo $zToolsId;
        //$tiToolsID = explode(",", $zToolsId) ;
        
        $type_request->tools()->sync($tiToolsID);
       // return redirect("type_demande") ;
        
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
    public function delete($id){
        DB::table('tool_type_request')->where('type_request_id', $id)
        ->delete();
        DB::table('type_requests')->where('id', $id)
        ->delete();
        echo "1";
    }
    public function deletevalidationprocess($id){
        $tzParam = explode("_",$id);
        $iTypeRequestId = $tzParam[0];
        $iToolId = $tzParam[1];
        //echo "toolID".$iToolId."typerequestid".$iTypeRequestId."<br>";
        //exit();
        DB::table('validation_requests')->where('tool_id', $iToolId)
        ->where('type_request_id',$iTypeRequestId)
        ->delete();
        echo "1";
        
    }
    public function deletetool($id){
        $tzParam = explode("_",$id);
        $iToolId = $tzParam[0];
        $iTypeRequestId = $tzParam[1];
        echo 'toolid='.$iToolId.'typerequestid='.$iTypeRequestId;
        DB::table('tool_type_request')->where('tool_id', $iToolId)
        ->where('type_request_id',$iTypeRequestId)
        ->delete();
        echo "1";
        
    }
    public function approbationTypeRequest(){
        $toApprobation = type_request::viewListApprobation();
       return view('type demande.approbation', compact('toApprobation'));
    }
    public function editApprobation($id){
        $tiTR_ToolId = explode("_", $id) ;
        $typeRequestId = $tiTR_ToolId[0];
        $toolId = $tiTR_ToolId[1];
        $type_request = type_request::find($typeRequestId);
        //dd($type_request);
        $tool= tool::find($toolId);
        $entities=DB::table('entities')->orderBy('name','asc')->get();
        //dd($tool);
        $toApprobation = type_request::viewListApprobationByTypeRequestTool($typeRequestId,$toolId);
        //dd($toApprobation);
        return view('type demande.edit-approbation', compact('toApprobation','type_request','tool','entities'));
       
    }
    public function newApprobation(){
        $tools = DB::table('tools')->orderBy('name','asc')->get();
        $entities = DB::table('entities')->orderBy('name','asc')->get();
        return view('type demande.add-approbation',compact('entities','tools'));
    }
    public function updateApprobation($id){
        $tiTR_ToolId = explode("_", $id) ;
        $typeRequestId = $tiTR_ToolId[0];
        $toolId = $tiTR_ToolId[1];
        $zEntityRank= request('listeplateforme');
        $tzEntityRank = explode(",",$zEntityRank);
        $iCountTab = sizeof($tzEntityRank);
        type_request::deleteApprobation($typeRequestId,$toolId);
        for($i=0;$i<$iCountTab;$i++) {
            
            $tabEntRank = explode("_",$tzEntityRank[$i]);
            $data = new validation_request();
            $data->type_request_id = $typeRequestId;
            $data->tool_id  = $toolId;
            $data->entity_id  = $tabEntRank[0];
            $data->rank = $tabEntRank[1];
            $data->save();
        
        }
       

        //return redirect()->back();
        $toApprobation = type_request::viewListApprobation();
       return view('type demande.approbation', compact('toApprobation'));
        
        
        
        //dd($tzEntityRank);
        //$tiToolsID = explode(",", $zToolsId) ;
        //$toolId = $tiTR_ToolId[1];
    }
    public function insertTypeRequest(){
        
        
        $dataTypeRequestAutocomplete ='[';
        $type_requests = DB::table('type_requests')->orderBy('name','asc')->get();
        foreach($type_requests as $type_request){
            $dataTypeRequestAutocomplete.= '{ label:"'.$type_request->name.'", val:'.$type_request->id.'},';
        }
        $dataTypeRequestAutocomplete = implode( ',', array_slice( explode( ',', $dataTypeRequestAutocomplete ), 0, -1 ));
        $dataTypeRequestAutocomplete.=']';
        //echo $dataTypeRequestAutocomplete;
        $tools=DB::table('tools')->orderBy('name','asc')->get();
        
        return view('type demande.inserttyperequest', compact('type_requests','tools','dataTypeRequestAutocomplete'));
    }
}
