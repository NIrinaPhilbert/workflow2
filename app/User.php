<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'entity_id', 'function', 'email', 'phone', 'password', 'activated', 'administrator','answering','validator','image' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Relation One to One
    public function phone() //un utilisateur a un numero téléphone (relation one to one)
    {
        return $this->hasOne('App\Phone');
    }

    public function entity() //un utilisateur a un numero téléphone (relation one to one)
    {
        return $this->belongsTo('App\Entity');
        
    }

    //relation One to Many
    public function posts(){
        return $this->hasMany('App\Post');
    } 


    //relation Many to Many
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();

    }
    public function getStatusAttribute($attributes)
    {
        return $this->getStatusOptions()[$attributes];
    }

    public function getStatusOptions()
    {   
        return[
            '0' => 'Inactif',
            '1' => 'Actif'
        ];

    }
    public static function getEntityIdByUserId($userId){
        $entity_id = 0;
        $result = DB::table('users')->select('entity_id')->where('id','=',$userId)->get();
        foreach($result as $user)
        {
            $entity_id = $user->entity_id;
        }
        return $entity_id;
    }

    public static function getEntityNameByUserId($userId){
        $entity_name = "";
        $result = DB::table('users')
                    ->join('entities','entities.id','=','users.entity_id')
                    ->select('entities.name as entity_name')
                    ->where('users.id','=',$userId)
                    ->get();
        foreach($result as $user)
        {
            $entity_name = $user->entity_name;
        }
        return $entity_name;
    }
    public static function getNameAndEntityUserbyId($userId){
        $zRes = "";
        $result = DB::table('users')
                    ->join('entities','entities.id','=','users.entity_id')
                    ->select('users.name as user_name','entities.name as entity_name')
                    ->where('users.id','=',$userId)
                    ->get();
        foreach($result as $user)
        {
            $zRes = $user->user_name.'['.$user->entity_name.']';
        }
        return $zRes;

    }
    public static function getNameUserbyId($userId){
        $zRes = "";
        $result = DB::table('users')
                    ->join('entities','entities.id','=','users.entity_id')
                    ->select('users.name as user_name','entities.name as entity_name')
                    ->where('users.id','=',$userId)
                    ->get();
        foreach($result as $user)
        {
            $zRes = $user->user_name;
        }
        return $zRes;

    }
    public static function getPhotoUserbyId($userId){
        $zRes = "";
        $result = DB::table('users')
                    ->join('entities','entities.id','=','users.entity_id')
                    ->select('users.image as user_photo','entities.name as entity_name')
                    ->where('users.id','=',$userId)
                    ->get();
        foreach($result as $user)
        {
            $zRes = $user->user_photo;
        }
        return $zRes;

    }
    public static function getEmailUserbyId($userId){
        $zRes = "";
        $result = DB::table('users')
                    ->join('entities','entities.id','=','users.entity_id')
                    ->select('users.email as user_email','entities.name as entity_name')
                    ->where('users.id','=',$userId)
                    ->get();
        foreach($result as $user)
        {
            $zRes = $user->user_email;
        }
        return $zRes;

    }
    public static function getListEmailAdressAdministratorByEntityId($entity_id)
    {
        
        $resultGetRemainingEntityList = DB::table('users')
        ->where('entity_id',$entity_id)
        ->where('validator',1)
        ->where('activated',1)
        ->select('users.email as email_admin')
        ->get();

       
        return $resultGetRemainingEntityList;
        
    }
    public static function getListEmailAdressAdministrator()
    {
        $resultGetEmailAdmin = DB::table('users')
        ->where('activated',1)
        ->where('administrator',1)
        ->select('users.email as email_admin')
        ->get();
        return $resultGetEmailAdmin;
    }

    public static function getListUserInProcessByTypeRequestIDToolID($TypeRequestID,$ToolID,$oEntityID){
        $ListUserbyentity = DB::table('process_users')
        ->join('users','users.id', '=', 'process_users.user_id')
        ->join('processings','processings.id', '=', 'process_users.process_id')
        ->join('requestwfs','requestwfs.id', '=', 'processings.requestwf_id')  
        ->where('requestwfs.tool_id',$ToolID)
        ->where('requestwfs.type_request_id',$TypeRequestID)
        ->where('process_users.entity_id',$oEntityID)
        ->orderBy('users.name','ASC')
        ->select('process_users.user_id as userid','users.name as username') 
        ->distinct('process_users.user_id')  
        ->get();   
      
        $zContenuSelect = "<option value='0'>Choisir employe</option>";
        foreach($ListUserbyentity as $oUser){
            $zContenuSelect = $zContenuSelect."<option value=".$oUser->userid.">".$oUser->username."</option>";
        }
        
        return $zContenuSelect;
    }

    
}
