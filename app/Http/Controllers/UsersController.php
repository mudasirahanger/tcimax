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
        $data['roles'] = User::getRoles();



        return view('pages/users_add',$data);

    }

    public function save(Request $request) {

        $data = [];
        $users = [];
        $data['title'] = '';



        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role_id' => 'required',
                'status' => 'required',
            ]);

            $user = [
                'name' => $request->name,
                'lname' => $request->lname,
                'mobile' =>  $request->mobile,
                'email' => $request->email,
                'email_verified_at' => NULL,
                'password' =>  bcrypt($request->password),
                'role_id' => $request->role_id,
                'remember_token' => NULL,
                'status' => $request->status,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            User::addUsers($user);
            
            return redirect()->route('users-list')->with('success', 'User added successfully');

        }


    }


}