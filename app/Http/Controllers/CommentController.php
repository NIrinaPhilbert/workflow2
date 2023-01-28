<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        
        //$this->middleware('auth');
    }
    public function index(){
        $Comments = DB::table('comments')->orderBy('created_at','asc')->get();
        return view('comment.index',compact('Comments'));

    }
    public function store(Request $request)
    {
        $zComment = request('comment'); 
        $zEmail_visitor = request('mailvisitor');       
        $oComment = new Comment();
        $oComment->email_visitor = $zEmail_visitor;
        $oComment->comment = $zComment;
        $oComment->save();
        $idComment = $oComment->id;
        echo $idComment;

    }
    

}
