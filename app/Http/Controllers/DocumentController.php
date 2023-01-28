<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use Validator; //for ajax controller
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    
    public function index(){
        //dd('ici');
        $documents = Document::all();
        return view('document.view',compact('documents'));

    }
    public function create(){
        return view('document.create');

    }
    public function show($id){
        $document = Document::find($id);
        return view('document.detail',compact('document'));

    }
    public function download($file){
        return response()->download('storage/'.$file);

    }
    public function edit($id){

    }
    public function store(Request $request){
        //dd($request);
        $data = new Document();
        if($request->file('file')){
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/',$filename);
            $data->file = $filename;
        }
        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();

        return redirect()->back();
    }
    public function storeajax(Request $request)
    {
        //dd($request);
        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|image|max:2048'
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails())
        {
            /*return response()->json(['errors'] => $error->errors()
                ->all());*/
            return 'erreur';
        }
        $file = $request->file('file');
        $new_name = rand().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images'),$new_name);
        $form_data = array(
            'title' => $request->title,
            'description' => $request->description,
            'file' => $new_name
        );
        Document::create($form_data);
        return response()->json(['success' => 'Data Added successfuly.']);
    }
}
