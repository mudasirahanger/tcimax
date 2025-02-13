<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Dashboard extends Model
{


    // get total users
    public static function getCountUsers($role_id){
        $users = DB::table('users')
                      ->where('role_id', $role_id)
                      ->count();
        if($users){
            return $users;
        }else{
            return null;
        }
    }


      // get total users
      public static function getCountSales($status_id){
        $sales = DB::table('sales')
                      ->where('status', $status_id)
                      ->count();
        if($sales){
            return $sales;
        }else{
            return null;
        }
    }



}