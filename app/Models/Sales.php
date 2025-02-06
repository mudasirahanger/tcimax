<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sales extends Model
{
    //

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dated',
        'distributor_id',
        'retailer_id',
        'retailer_name',
        'retailer_address',
        'retailer_mobile',
        'qty',
        'status',
        'source',
    ];




    public static function getSales($page,$limit){
        $sales = DB::table('sales')
                     ->orderBy('sales_id', 'desc')
                      ->limit($limit)
                      ->offset(($page - 1) * $limit)
                  //   ->where('upload_type', $type)
                      ->get();
        if($sales){
            return $sales;
        }else{
            return null;
        }
    }


}
