<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //echo "ici";
        //return view('home');
        //print_r($_REQUEST);

        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        //echo $user_name;

        $entity_user = User::getEntityIdByUserId($user_id);
        $photo_user = User::getPhotoUserbyId($user_id);
        //echo "test index";
        //exit();
        $entityname_user = User::getEntityNameByUserId($user_id);
        $entityid_user = User::getEntityIdByUserId($user_id);
        Session::put('s_userid', $user_id);
        Session::put('s_entityid_user', $entity_user);
        Session::put('s_entityname_user', $entityname_user);
        Session::put('s_photo_user', $photo_user);
        echo $entityname_user;
        echo "index homeController";
        //Config::set(['vsession_entity' => Session::get('s_entityid_user'));
    
        //return view('homenew');
        return view('homenew');
    }
}
