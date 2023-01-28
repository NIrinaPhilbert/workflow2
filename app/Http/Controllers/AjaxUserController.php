<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Entity;
use App\User;
use App\Helpers\Helper as Helper;
//use Helper;
use Redirect,Response;

use Illuminate\Http\Request;

class AjaxUserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index()
    {
        {
            
            
            

            $dataid = ' ';
            $data = Entity::with('entity')->orderBy('name', 'ASC')->get();
            $dataUser = User::with('entity')->orderBy('id', 'DESC')->get();
            
            //remove the ',' at the end of the variable;
            /*echo '<pre>';
            print_r($dataUser);
            echo '</pre>';*/
            //exit();
            
            return view('user.userdt', compact('dataUser','data'));
        }
    }
}
