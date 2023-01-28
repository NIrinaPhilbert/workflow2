<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Entity;
use App\User;
use App\Helpers\Helper as Helper;

use Redirect,Response;

use Illuminate\Http\Request;

class AjaxToolController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    public function index()
    {
        {
            $Tools = DB::table('tools')->orderBy('id','desc')->get();
            return view('tools.tooldt', compact('Tools'));
        }
    }
    public function store(Request $request)
    {  
        echo "pass store";
        
        $tooId = $request->id;
        $tool  = Tool::updateOrCreate(['id' => $toolId],
                    ['name' => $request->name, 'description' => $request->description]);  
        echo "pass store";      
        //return Response::json($entity);
    }
}
