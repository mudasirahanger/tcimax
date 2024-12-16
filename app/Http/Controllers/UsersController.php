<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class UsersController extends Controller
{



    public function users(Request $request): View
    {
       
        $data = [];
        $users = [];
        $data['title'] = 'List Users';
        $results = User::paginate(env('APP_PAGINATION'));
        foreach($results as $result){
            $users[] = [
            'sr' => $result->id,
            'name' => $result->name,
            'email' => $result->email,
            'status' => $result->status,
            'role' => User::getRole($result->role_id),
            'created_at' => Carbon::parse($result->created_at)->format('M d Y')
            ];
        }
        $data['users'] = $users;
        $data['paginations'] = $results->links();


        return view('pages/users_list',$data);
    }


    public function add(Request $request) {
      
        $data = [];
        $users = [];
        $data['title'] = 'Add Users';
       



        return view('pages/users_add',$data);

    }


}