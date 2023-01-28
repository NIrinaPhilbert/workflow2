<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entity;

class EntityController extends Controller
{
   
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        $entities = Entity::with('entity')->paginate(5);
        return view('entity.index', compact('entities'));
    }
    public function viewentity($id)
    {
        $zNameEntityParent = "";
        $oEntity = Entity::findOrFail($id);
        $idEntityParent = $oEntity->entity_id;
        if($idEntityParent > 0){
            $zNameEntityParent = Entity::getNameEntityById($idEntityParent);
        }

        return view('entity.viewentity', compact('oEntity','zNameEntityParent'));

    }
    public function create()
    {
        echo "test";
        //exit();
        $entities = DB::table('entities')->orderBy('name','asc')->get();
        $levels = DB::table('level')->orderBy('name','asc')->get();
       
        return view('entity.create', compact('entities','levels'));
    }
    public function edit($id)
    {
        
        //exit();
        $oEntity = Entity::findOrFail($id);
        $entities = DB::table('entities')->orderBy('name','asc')->get();
        $levels = DB::table('level')->orderBy('name','asc')->get();
        return view('entity.edit', compact('oEntity','entities','levels'));
    }
    public function store(Request $request)
    {
        //dd($request);
        //1er option d'enregistrement
        /*request()->validate([
            'name' => 'required|min3',
            'status' => 'required|integer',
            'entreprise_id' => 'required|integer',

        ]);
        */
        $name = request('name');
        $entity_id = request('entity_id');
        $level_id = request('level_id');
        $description = request('description');
        
        $oEntity = new Entity();
        $oEntity->name = $name;
        $oEntity->entity_id = $entity_id;
        $oEntity->level_id = $level_id;
        $oEntity->description = $description;
        $oEntity->status = 1;
        $oEntity->save();

        return redirect('entitydatatable')->with('message_info','Enregistrement entité effectue avec succés.');

    }
    public function update(Request $request)
    {
        //dd($request);
        //1er option d'enregistrement
        /*request()->validate([
            'name' => 'required|min3',
            'status' => 'required|integer',
            'entreprise_id' => 'required|integer',

        ]);
        */
        $id = request('id_ent');
        $name = request('name');
        $entity_id = request('entity_id');
        $level_id = request('level_id');
        $description = request('description');
        Entity::where('id',$id)->update(array('name'=>$name,'entity_id'=>$entity_id,'level_id'=>$level_id,'description'=>$description));
        return redirect('entitydatatable')->with('message_info','Enregistrement entité effectue avec succés.');

    }
    public function delete($id){
        $entity = Entity::where('entity_id',$id)->delete();
        $entity = Entity::where('id',$id)->delete();
        return "1";
        //return Response::json($entity,200);
    }
    public function showentitybytoolandtyperequest(){
         
        $TypeRequestID = request('itypeRequestID');
        $ToolID = request('itoolID');
        $zReponse = Entity::getListEntityByTypeRequestIDToolID($TypeRequestID,$ToolID);
        echo $zReponse;
    }
    public function showentitybytoolandtyperequestinprocess(){
        $TypeRequestID = request('itypeRequestID');
        $ToolID = request('itoolID');
        $zReponse = Entity::getListEntityInProcessByTypeRequestIDToolID($TypeRequestID,$ToolID);
        
        echo $zReponse;
    }
    public function showentitybytypeentityandentityparent(){
        
        $typeEntId = request('iTypeEntId');
        $entityparentId = request('iEntityParentId');
       
        $zReponse = Entity::getListEntityByTypeEntEntiteParentID($typeEntId,$entityparentId);
        
        
        echo $zReponse;
    }
}
