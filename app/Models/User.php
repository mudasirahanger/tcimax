<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lname',
        'email',
        'mobile',
        'role_id',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function addUsers($data) {
        $user = DB::table('users')
                ->insert($data);

        if($user){
            return $user;
        }else{
            return null;
        }
    }

    public static function addUsersAddress($data) {
        $users_address = DB::table('users_address')
                ->insert($data);

        if($users_address){
            return $users_address;
        }else{
            return null;
        }
    }

    public static function getUsers($page,$limit,$role_id){
        $users = DB::table('users')
                     ->orderBy('id', 'desc')
                      ->limit($limit)
                      ->offset(($page - 1) * $limit)
                      ->where('role_id', $role_id)
                      ->get();
        if($users){
            return $users;
        }else{
            return null;
        }
    }

    public static function getRole($role_id) {
        $roles = DB::table('users_roles')
        ->where('role_id', $role_id)
        ->get()
        ->toArray();   
    
        if($roles){
            return $roles[0]->name;
        }else{
            return null;
        }
    }

    public static function getRoles() {
        $roles = DB::table('users_roles')
        ->get()
        ->toArray();
        if($roles){
            return $roles;
        }else{
            return null;
        }
    }
    public static function getDistrictByID($user_id) {
        $roles = DB::table('users_address')
        ->where('user_id', $user_id)
        ->get()
        ->toArray();   
    
        if($roles){
            return $roles[0]->district;
        }else{
            return '';
        }
    }

   public static function addUploadinfo($data) {
    $file_info = DB::table('uploads')
                          ->insert($data);
        if($file_info){
        return $file_info;
        }else{
        return null;
        }
   } 

   public static function getUploadinfo() {
    $file_info = DB::table('uploads')->where('process_id', 0)
    ->get();
    if($file_info){
        return $file_info;
    }else{
        return null;
    }
   }

   public static function updateUploadinfo($where,$update) {
    $file_info = DB::table('uploads')
                          ->where($where)
                          ->update($update);
        if($file_info){
        return $file_info;
        }else{
        return null;
        }
   } 

}
