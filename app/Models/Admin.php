<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_name','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

 	public function roles(){
 		return $this->belongsToMany('App\Models\Roles');
 	}

    public function getAuthPassword(){
        return $this->admin_password;
    }
    // public function hasAnyRoles($roles){

    //     if(is_array($roles)){
    //         foreach($roles as $role){
    //             if($this->hasRole($role)){
    //                 return true;
    //             }
    //         }
    //     }else{
    //         if($this->hasRole($roles)){
    //             return true;
    //         }
    //     }
    //     return false;
    // }
    // public function hasRole($role){
    //     if($this->roles()->where('name',$role)->first()){
    //         return true;
    //     }
    //     return false;
    // }

    public function hasAnyRoles($roles){
        return null != $this->roles()->whereIn('name',$roles)->first();
    }
    public function hasRole($role){
        return null != $this->roles()->where('name',$role)->first();
    }
}
