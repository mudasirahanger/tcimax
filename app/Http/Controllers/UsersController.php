<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class UsersController extends Controller
{



    public function users($page,$limit,$role_id)
    {
       
        $data = [];
        $users = [];

        if(!empty($page) && !empty($limit) && !empty($role_id)){

        $results = User::getUsers($page,$limit,$role_id);
        $id = 1;
        foreach($results as $result){
            $users[] = [
            'sr' => $id,
            'name' => $result->name,
            'status' => $result->status,
            'mobile' => $result->mobile,
            'district' => User::getDistrictByID($result->id),
            'role' => User::getRole($result->role_id),
            'created_at' => Carbon::parse($result->created_at)->format('d/m/Y')
            ];
            $id++;
        }
        $data['users'] = $users;

        return response()->json([
            'data' => $data,
            'message' => 'Success',
        ]);
       } else {
        return response()->json([
            'data' => [],
            'message' => 'Error',
        ]);
       }
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