<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Policies;
use Illuminate\Support\Facades\DB;

use App\Tool;
use App\User;
use App\type_request;

class ToolController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //echo "1";
        //exit();
        if(request()->ajax())
        {
            return datatables()->of(Tool::latest()->get())
                    ->addColumn('action',function($data){
                        $button = '<button type="button" 
                        name="edit" id="'.$data->id.'"
                        class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;$nbsp;';
                        $button .='<button type="button" 
                        name="delete" id="'.$data->id.'" 
                        class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('tools.index');
    }
    public function view()
    {
    	//$this->authorize('create', Tool::class);
        //dd($user->email);
        //exit();
    	$tools = DB::table('tools')
                        ->orderBy('name','asc')
                        ->paginate(7);

        return view('tools.index', ['tools' => $tools]);
    }
    public function create()
    {
        
        return view('tools.create');
    }
    public function viewtool($id)
    {
        $requesttool =  DB::table('tools')
        ->where('id', $id)
        ->get();
        return view('tools.viewtool', compact('requesttool'));

    }
    
    public function storeold()
    {
        
        request()->validate([
            'lib_tool' => 'required'
        ]);
        $lib_tool = request('lib_tool');
        //pour affichage
        //dd($lib_tool);
        $tool = new Tool();
        $tool->label_tools = $lib_tool;
        $tool->save();
        // return back(); retur to the back page
        /*
        Autre methode pour faire le message flash
        session()->flash('message_info','Enregistrement outil effectue avec succÃ©s.');
        return redirect('tool');
        */
        return redirect('tool')->with('message_info','Enregistrement outil effectue avec succès.');

    }
    public function store(Request $request)
    {
        
        $name = request('name');
        $description = request('description');
        
        $oTool = new Tool();
        $oTool->name = $name;
        $oTool->description = $description;
        $oTool->status = 1;
        $oTool->save();

        return redirect('tooldatatable')->with('message_info','Enregistrement outil effectue avec succès.');
        //return redirect('tool')->with('message_info','Enregistrement outil effectue avec succès.');

    }
    public function inserttoolsajax()
    {
            // Add Data
            if(isset($_POST['added'])){
                $name = $_POST['name'];
                $description = $_POST['description'];
                $id = DB::table('tools')->insertGetId(
                    ['name' => $name, 'description' => $description, 'created_at' => NOW()]
                );

                if($id > 0){
                    echo json_encode(array("status" => 1));
                }
                else{
                    echo json_encode(array("status"=>2));
                }
                
                
            }
            // View Data
            if(isset($_POST["note_id"]))  
            {  
                $id= $_POST["note_id"];
                $output = '';  
                $tool = tool::find($id);
                $output .= '  
                <div class="table-responsive">  
                    <table class="table table-bordered">';  
                
                
                $output .= '  
                        <tr>  
                            <td width="30%"><label>Name</label></td>  
                            <td width="70%">'.$tool->name.'</td>  
                        </tr>  
                        <tr>  
                            <td width="30%"><label>Description</label></td>  
                            <td width="70%">'.$tool->description.'</td>  
                        </tr>  
                        <tr>  
                            <td width="30%"><label>Date</label></td>  
                            <td width="70%">'.$tool->created_at.'</td>  
                        </tr>  
                ';  
                
                $output .= '  
                    </table>  
                </div>  
                ';  
                echo $output;  
            }  
        

    }
    public function viewtoolsajax()
    {
        $tools = DB::table('tools')->get();
        //dd($tools);
        return view('tools.viewtoolsajax', ['tools' => $tools]);
        
    }
    public function delete($id){
        $tool = Tool::findOrFail($id);
        $tool->delete($id);
        //echo $id;
        echo "OK";
        //return response()->json(['success'=>'Record deleted successduly']);


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
        $id = request('id_tool');
        $name = request('name');
        $description = request('description');
        Tool::where('id',$id)->update(array('name'=>$name,'description'=>$description));
        return redirect('tooldatatable')->with('message_info','Enregistrement outil effectue avec succÃ©s.');

    }
    public function edit($id)
    {
        
        //exit();
        $oTool = Tool::findOrFail($id);
        return view('tools.edit', compact('oTool'));
    }
    public function showToolByTypeRequestId()
    {
        $itypeRequestID = request('itypeRequestID');
        $data=type_request::getToolByIdTypeRequest($itypeRequestID);
        return response()->json($data);
    }
}
