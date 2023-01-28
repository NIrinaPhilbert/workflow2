<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\User;
use App\Entity;
use Helper;
use DataTables;
use RedirectsUsers, ThrottlesLogins;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function AuthRouteAPI(Request $request){
        return $request->user();
     }*/
    
    public function customresetpassword(Request $request){
        if(!empty(request('email'))){
            $zMail = request('email');
            $checker = User::select('email')->where('email',request('email'))->exists();
            if($checker == true){  // verif si mail existant
                $user_id_json = User::select('id')->where('email',request('email'))->first();// return {"id":98}
                $user_id=$user_id_json->id;
                $zMdpTemp = rand().'@wf';
                $zLienUpdateInitPassword = url("updateinitpassword").'?mail='.$zMail;
                $zMdpTempDB = Hash::make($zMdpTemp);
                DB::table('users')
                ->where('id', $user_id)
                ->update(['istemp'=> 1, 'password'=>$zMdpTempDB]);

                Session::flash("message", "Votre mots de passe a été réinitialisé, veuillez consulter votre mail");
                Session::flash('alert-class', 'alert-success');

                $header = "Notification reinitialisation mots de passe";
                $subject = "Notification réinitialisation mots de passe dans le système workflow";

       
                $zMessageNotification = "Votre compte workflow est actuellement reinitialisé Pour se connecter, veuillez cliquer sur le lien ".$zLienUpdateInitPassword." le compte Login: ".$zMail." et mots de passe: ".$zMdpTemp;
                Helper::sendnotification($zMail,$subject,$header,$zMessageNotification);
                //return redirect('customresetpassword');
                return redirect()->route('password.request');



                //echo 'suite reinitialisation password';
                //exit();
            }else{
                //Demande d'auto enregistrement
                Session::flash("messagealert", "Vous n'être pas encore enregistré dans le système; veuillez faire un auto-enregistrement");
                Session::flash('alert-class', 'alert-danger');
                $header = "Notification reinitialisation mots de passe echoué";
                $subject = "Notification réinitialisation echoué";       
                $zMessageNotification = "Votre opération de réinitialisation a echoué puisque votre mail n'est pas encore figuré d";
                //Helper::sendnotification($zMail,$subject,$header,$zMessageNotification);
                return redirect()->route('register');
            }
        }
    }
    public function customlogin(Request $request){
        echo 'passage au niveau custom login';
        echo 'email='.request('email').'et password'.request('password').'<br>';
        echo "==================================================================";
        echo 'newpassword='.request('newpassword').'et new password confirm = '.request('new-password-confirm'); 
        //exit();
        
        if(request('newpassword') == request('new-password-confirm')){
            $zNewPassword = request('newpassword');
            
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // Authentication passed...
                //return redirect()->intended('/');
                //set password temp = 
                
                $id = Auth::id();
                DB::table('users')
                ->where('id', $id)
                ->update(['istemp'=> 0, 
                'password'=>Hash::make(request('newpassword'))
                ]);


                //return redirect()->intended('dashboard');
                //return redirect()->route('home');
                //return redirect()->intended('homenew');
                //return view('homenew');
                return redirect('/home');
    
            }else{
                $zMail = request('email');
                $zLienUpdateInitPassword = url("updateinitpassword").'?mail='.$zMail;
                Session::flash('message', 'Veuillez verifier votre mots de passe');
                Session::flash('alert-class', 'alert-danger');

                //return redirect()->route("updateinitpassword?mail=".$zMail);
                //return redirect()->route('password.request');
                
                header("Location: " . $zLienUpdateInitPassword . "&error=1") ;
                exit();
                
            }

        }else{
                Session::flash('message', 'Veuillez reconfirmer votre mots de passe');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('password.request');
            }
        
        
 
       
        /*if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
            // The user is active, not suspended, and exists.
        }*/
    }
    public function authenticate_user(){
        return view('auth.loginnew');
    }
    public function index_old()
    {
        /*$users = DB::table('users')
                        ->orderBy('name','asc')
                        ->paginate(7);*/
        $users = User::with('entity')->orderBy('name','asc')->paginate(5);
        return view('user.index', ['users' => $users]);
    }

    public function index(Request $request)

    {

        if ($request->ajax()) {

            $data = User::latest()->get();
            //dd($data);

            return DataTables::of($data)

                    ->addIndexColumn()

                    ->addColumn('action', function($row){
                         $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }

      

        return view('user.users');

    }
    public function data(Datatables $datatables)
    {
        $builder = Article::query()->select('id', 'base_id', 'gencode', 'size', 'colorLib');

        return $datatables->eloquent($builder)
                          ->editColumn('id', function ($user) {
                              return '<a>' . $user->id . '</a>';
                          })
                          //->addColumn('action', 'eloquent.tables.users-action')
                          ->rawColumns([1, 5])
                          ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $entities = Entity::with('entity')->orderBy('name', 'ASC')->get();
       
        return view('user.create', compact('entities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //public function mampiditra()
    {
       $request->validate([
        'name' => 'required'
        //'image' => 'required|image|max:2048'
       ]);
       /*
       request()->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'confirmed', 'min:8'],
        'password_confirmation' => ['required'],
        ]);*/
       $image = $request->file('image');
       $new_name = rand().'.'.$image->getClientOriginalExtension();
       //echo $new_name;
       //exit();
       $target_image = public_path()."/images/";
        if (!file_exists($target_image)) mkdir($target_image, 0777, true);
       // $request->file->move('storage/',$filename);
       $image->move(public_path('images'),$new_name);

        if(request('password_confirmation') == request('password'))
        {
         
            $user = new User();
            
            $user->name = request('name');
            $user->email = request('email');
            $user->entity_id = request('entity_id');
            $user->activated = request('useractivation');
            $user->administrator = request('useradministrator');
            $user->validator = request('uservalidator');
            $user->answering = request('useranswering');
            $user->image = $new_name;
            $user->password = Hash::make(request('password'));
            $user->save();
        }
        $data = Entity::with('entity')->orderBy('name', 'ASC')->get();
        $dataUser = User::with('entity')->orderBy('id', 'DESC')->get();

        return view('user.userdt', compact('dataUser','data'));
        //return redirect('crud')->with('success','Data Added successfully.');
    }

    public function store_extuser(Request $request)
    //public function mampiditra()
    {
       
        $request->validate([
        'image' =>  'file|mimes:jpg,jpeg,png,gif|max:2048',
        'name' => 'required',
        'entity_id' => 'required',
        'email' => ['required', 'email']
       
       ]);
       
        /*request()->validate([
        'email' => ['required', 'email']
        
        ]);*/
       
        //Check if mail or user exit
        $checker = User::select('email')->where('email',request('email'))->exists();
        if($checker == false){  
            $image = $request->file('image');
            $new_name = '' ;
            if($image)
            {
                $new_name = rand().'.'.$image->getClientOriginalExtension();
                //echo $new_name;
                //exit();
                $target_image = public_path()."/images/";
                if (!file_exists($target_image)) mkdir($target_image, 0777, true);
                // $request->file->move('storage/',$filename);
                $image->move(public_path('images'),$new_name);
            }
            
            
                    
            $user = new User();
            
            $user->name = request('name');
            $user->email = request('email');
            $user->phone = request('tel');
            $user->entity_id = request('entity_id');
            $user->function = request('function');
            $user->activated = 0;
            $user->administrator = 0;
            $user->validator = 0;
            $user->answering = 0;
            $user->image = $new_name;
            $user->password = Hash::make('workflow@123');
            $user->save();
            $iduser = $user->id;
            $zEntiteUser = Entity::getNameEntityById($user->entity_id);
            //=======Notification mail utilisateur=============//
            $header = "Notification reception demande compte dans le système workflow";
            $subject = "Notification reception demande compte dans le système workflow";
            $zMessageNotification = "Votre demande de compte est enregistré dans le système workflow<br/> on attend l'approbation de l'administrateur <br/> une mail vous sera envoyé dès que cet action est effectué";
            Helper::sendnotification($user->email,$subject,$header,$zMessageNotification);

            //=======Notification mail administrateur==========//
            $ListEmailAdministrator = User::getListEmailAdressAdministrator();
            $header = "Notification utilisateur en attente de votre activation dans le système workflow";
            $subject = "Notification utilisateur  en attente de votre activation dans le système workflow";
            $zMessageNotification = "L utilisateur ".$user->name." au sein de l'entité ".$zEntiteUser.", ID ".$iduser." est actuellement en attente de votre activation dans le systeme workflow";
            if ($ListEmailAdministrator->count() > 0) {
                foreach($ListEmailAdministrator as $omailaddress){
                
                    Helper::sendnotification($omailaddress->email_admin,$subject,$header,$zMessageNotification);
    
                } 
            }
            


            //==============================================================================//

        

            Session::flash("message", "Inscription effectuée avec succès, veuillez attendre l'activation de l'administrateur");
            Session::flash("message1", "Un  email vous sera envoyé dès que votre compte est actif");
            Session::flash('alert-class', 'alert-success');
            $data = Entity::with('entity')->orderBy('name', 'ASC')->get();
            $dataUser = User::with('entity')->orderBy('id', 'DESC')->get();
            return redirect()->route('register');
            //return redirect('register')->withSuccess('Success message');
        }else{
            Session::flash('message', 'Adresse mail'.request('email').'déjà existant, veuillez saisir un autre');
            Session::flash('alert-class', 'alert-danger');
            $data = Entity::with('entity')->orderBy('name', 'ASC')->get();
            $dataUser = User::with('entity')->orderBy('id', 'DESC')->get();
            return redirect()->route('register');
        }
        //return view('user.userdt', compact('dataUser','data'));
        //return redirect('crud')->with('success','Data Added successfully.');
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
        //dd($id);
        
        $entities = DB::table('entities')->orderBy('name','asc')->get();
        $user = User::find($id);
        return view('user.edit', ['user' => $user],['entities' => $entities]);
    }
    public function enableuser($id)
    {
        $user = User::find($id);
        $entities = DB::table('entities')->orderBy('name','asc')->get();
        return view('user.enable',['user' => $user],['entities' => $entities]);
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
        //dd($request->has('activated'));
        
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'name'  => 'required',
                'image' => 'file|mimes:jpg,jpeg,png,gif|max:2048'
            ]);
            $image_name = rand().'.'.$image->getClientOriginalExtension();
            $target_image = public_path()."/images/";
                if (!file_exists($target_image)) mkdir($target_image, 0777, true);
            // $request->file->move('storage/',$filename);
            $image->move(public_path('images'),$image_name);
           
        }
        else{
            $request->validate([
                'name'  => 'required',
                
            ]);
        }
        
        if(empty($request->password_confirmation)) {
            
            DB::table('users')
            ->where('id', $id)
            ->update(['name'=>request('name'), 'email'=>request('email'), 
            'entity_id'=>request('entity_id'), 'activated'=> request('activated'), 
            'administrator'=> request('administrator'), 'validator'=>request('validator'), 'image'=>$image_name, 'answering'=>request('answering')]);
            Session::flash("message", "Mises à jour information utilisateur effectué avec succès");
            Session::flash('alert-class', 'alert-success');
        }
        else{
            if($request->password_confirmation == $request->password){
                
                DB::table('users')
                ->where('id', $id)
                ->update(['name'=>request('name'), 'email'=>request('email'), 
                'entity_id'=>request('entity_id'), 'activated'=>$request->has('activated'), 
                'administrator'=>$request->has('administrator'), 
                'validator'=>$request->has('validator'), 
                'answering'=>$request->has('answering'),
                'image' =>$image_name,
                'password'=>Hash::make(request('password'))
                ]);

                Session::flash("message", "Mises à jour mot de passe utilisateur effectué avec succès");
                Session::flash('alert-class', 'alert-success');
            }
            else
            {
                echo "Veuillez reconfirmer votre mots de passe";
            }
        }
        $data = Entity::with('entity')->orderBy('name', 'ASC')->get();
        $dataUser = User::with('entity')->orderBy('id', 'DESC')->get();
        
        $urlprevious = url()->previous();
        
        if (strpos($urlprevious, "showprofil")!==false){
            return redirect()->route('showprofil',[$id]);
        }
        else {
            return view('user.userdt', compact('dataUser','data'));
        }
        

        
        
    }

    public function setenable(Request $request, $id){
        $user = User::find($id);
        $zLogin = $user->email;
        $zMdpTemp = rand().'@wf';
        $zMdpTempDB = Hash::make($zMdpTemp);
        $zLienUpdateInitPassword = url("updateinitpassword").'?mail='.$zLogin;

        DB::table('users')
        ->where('id', $id)
        ->update(['activated'=> 1, 
        'administrator'=>request('useradministrator'), 'validator'=>request('uservalidator'), 'answering'=>request('useranswering'), 'istemp'=>1, 'password'=>$zMdpTempDB]);
        

        Session::flash("message", "Activation utilisateur effectuée avec succès");
        Session::flash('alert-class', 'alert-success');

        $header = "Notification activation compte dans le système workflow";
        $subject = "Notification activation compte dans le système workflow";
        $zMessageNotification = "Votre compte workflow est actuellement activé<br/> Pour se connecter, veuillez accèder au lien ".$zLienUpdateInitPassword." pour changer votre mots de passe temporaire le compte Login: ".$zLogin." et mots de passe: ".$zMdpTemp;
        //$zMessageNotification = "Votre compte workflow est actuellement activé<br/> Pour se connecter, veuillez utiliser le compte  Login: ".$zLogin." et mots de passe: ".$zMdpTemp;
        Helper::sendnotification($zLogin,$subject,$header,$zMessageNotification);
        
        
        

        //=======Notification mail utilisateur=============//
        return redirect()->route('userdatatable');
        
        //return redirect()->route('enableuser',[$id]);
    }
    public function setdisable(Request $request, $id){
        $user = User::find($id);
        $zLogin = $user->email;
        

        DB::table('users')
        ->where('id', $id)
        ->update(['activated'=> 0, 
        'administrator'=>request('useradministrator'), 'validator'=>request('uservalidator'), 'answering'=>request('useranswering')]);
        Session::flash("message", "Desactivation utilisateur effectuée avec succès");
        Session::flash('alert-class', 'alert-success');

        //=======Notification mail utilisateur=============//
        $header = "Notification desactivation compte dans le système workflow";
        $subject = "Notification desactivation compte dans le système workflow";
        $zMessageNotification = "Votre compte workflow est actuellement desactivé";
        Helper::sendnotification($zLogin,$subject,$header,$zMessageNotification);

        return redirect()->route('enableuser',[$id]);
    }
    public function resetpassword(Request $request){
        $zMail = request('email');
        $zLogin = $zMail;
        $zMdpTemp = rand().'@wf';
        $zLienUpdateInitPassword = url("updateinitpassword").'?mail='.$zMail;
        echo $zLienUpdateInitPassword;

        $header = "Notification reinitialisation mots de passe";
        $subject = "Notification réinitialisation mots de passe dans le système workflow";
       
        $zMessageNotification = "Votre compte workflow est actuellement reinitialisé Pour se connecter, veuillez cliquer sur le lien".$zLienUpdateInitPassword." le compte Login: ".$zLogin." et mots de passe: ".$zMdpTemp;
        Helper::sendnotification($zLogin,$subject,$header,$zMessageNotification);

        exit();
        
        if (User::where('email', '=', $zMail)->exists()) {
            echo 'user existant';
            
            $zMdpTempDB = Hash::make($zMdpTemp);
            DB::table('users')
            ->where('email', $zMail)
            ->update(['istemp'=> 1, 'password'=>$zMdpTempDB]);
            Session::flash("message", "Votre mots de passe a été réinitialisé");
            Session::flash('alert-class', 'alert-success');

        //=======Notification mail utilisateur=============//
        
        
        
        }else {
            
            echo 'user inexistant';
        } 
        echo $zMail;
        exit();
        DB::table('users')
        ->where('id', $id)
        ->update(['activated'=> 0, 
        'administrator'=>request('useradministrator'), 'validator'=>request('uservalidator'), 'answering'=>request('useranswering')]);
        Session::flash("message", "Desactivation utilisateur effectuée avec succès");
        Session::flash('alert-class', 'alert-success');

        //=======Notification mail utilisateur=============//
        $header = "Notification desactivation compte dans le système workflow";
        $subject = "Notification desactivation compte dans le système workflow";
        $zMessageNotification = "Votre compte workflow est actuellement desactivé";
        Helper::sendnotification($zLogin,$subject,$header,$zMessageNotification);

        return redirect()->route('enableuser',[$id]);
    }
    public function updateinitpassword(){
        //return redirect()->route('updateinitpassword');
        echo 'testupdate';
        if(isset($_GET['error']))
        {
            $zMessageError = 'Veuillez vérifier votre mot de passe temporaire' ;
            return view('auth.passwords.reset',compact('zMessageError'));
        }
        else
        {
            return view('auth.passwords.reset');
        }
        //exit();
        
    }
    public function updatepasswordtemp(Request $request){
        $zEmail = request('email');
        $zPasswordTemp = request('passwordtemp');
        $zNewPassword = request('newpassword');
        $zConfirmNewPassword = request('new-password_confirmation');
        $zQueryVerif = DB::table('users')
        ->where('email','=',request('email'))
        ->where('istemp','=','1')
        ->get();
        $iNombreEnreg = $zQueryVerif->count();
        if($iNombreEnreg > 0){
            foreach($zQueryVerif as $infoUser){
                $zHashedPwd = $infoUser->password;
                $user_id = $infoUser->id;
                if(Hash::check($zPasswordTemp, $zHashedPwd)){
                    if($zNewPassword == $zConfirmNewPassword){
                        $zNewPasswordDB = Hash::make($zNewPassword);
                        DB::table('users')
                        ->where('email', $zEmail)
                        ->update(['istemp'=> 0, 'password'=>$zNewPasswordDB]);

                        //$user_id = Auth::id();
                        $user_name = $zEmail;
                        //echo $user_name;

                        $entity_user = User::getEntityIdByUserId($user_id);
                        //echo "test index";
                        //exit();
                        $entityname_user = User::getEntityNameByUserId($user_id);
                        $entityid_user = User::getEntityIdByUserId($user_id);
                        Session::put('s_userid', $user_id);
                        Session::put('s_entityid_user', $entity_user);
                        Session::put('s_entityname_user', $entityname_user);
                        
                        return \Redirect::route('login');
                        //return view('homenew');

                    }
                    
                }
    
            }

        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inscription(){
        $entities = Entity::with('entity')->orderBy('name', 'ASC')->get();
        $listentitetutelle = DB::table('entities')
        ->where('level_id','=',1)
        ->orWhere('level_id','=',2)
        ->orWhere('level_id','=',3)
        ->orWhere('level_id','=',4)
        ->orWhere('level_id','=',6)
        ->orderBy('name','asc')->get();
        $typeentity = DB::table('level')
        ->orderBy('name','asc')->get();
        return view('auth.registernew',compact('entities','listentitetutelle','typeentity'));
    }
    public function destroy($id)
    {
        //
    }
    public function updatePassword(Request $request)
    {
    $request->validate([
        'password' => 'required',
        'new_password' => 'required|string|confirmed|min:6|different:password'          
    ]);

    if (Hash::check($request->password, Auth::user()->password) == false)
    {
        return response(['message' => 'Unauthorized'], 401);  
    } 

    $user = Auth::user();
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response([
        'message' => 'Your password has been updated successfully.'
    ]);
    }
    public static function showuserbytoolandtyperequestinprocess(){
        $TypeRequestID = request('itypeRequestID');
        $ToolID = request('itoolID');
        $EntityID = request('iEntityID');
        $zReponse = User::getListUserInProcessByTypeRequestIDToolID($TypeRequestID,$ToolID,$EntityID);
        
        echo $zReponse;
    }
}
