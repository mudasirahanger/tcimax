<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
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
            'name' => $result->name .' '. $result->lname,
            'status' => $result->status,
            'mobile' => $result->mobile,
            'district' => User::getDistrictByID($result->id),
            'role' => User::getRole($result->role_id),
            'address' => User::getAddressByID($result->id),
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

    public function addbulkusers(Request $request) {
        try {
            // Validate the uploaded file
            $request->validate([
                'bulk_users' => 'required|mimes:xlsx,xls,csv',
            ]);
    
            $uploadinfo = [];
    
            // Get the uploaded file
            $path = $request->file('bulk_users')->store('excels');
    
             // Get file details
            $fileName = basename($path); // Get the file name
            $fileExtension = $request->file('bulk_users')->getClientOriginalExtension();
            // Storage::url($path);        
    
            // add files in queue
            $uploadinfo['file_name'] = $fileName;
            $uploadinfo['file_path'] = $path;
            $uploadinfo['file_type'] = $fileExtension;
            $uploadinfo['status'] = '0';
            $uploadinfo['user_id'] = Auth::id();
            $uploadinfo['upload_type'] = 'bulkusers';
            $uploadinfo['process_id'] = '0';
            $uploadinfo['processed_at'] = NOW();
            $uploadinfo['created_on'] = NOW();
    
             User::addUploadinfo($uploadinfo);
    
                // Return success response
                return response()->json([
                    'success' => true,
                    'message' => 'User Data Uploaded in queue successfully.',
                ], 201);
    
    
            // Process the Excel file
           // Excel::import(new SalesImportClass, $file);
    
    
    
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
    
        }
    }    



    public function getUsersByRole($role_id)
    {
       
        $data = [];
        $users = [];

        if(!empty($role_id)){
        $results = User::getUsersType($role_id);
        $id = 1;
        foreach($results as $result){
            $users[] = [
            'sr' => $id,
            'user_id' => $result->id,
            'mobile' => $result->mobile,
            'name' => $result->name .' '. $result->lname,
            'address' => User::getAddressByID($result->id),
            'status' => $result->status,
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

    public function addMessage(Request $request) {


        try {
            // Validate the uploaded file
            $request->validate([
                'message' => 'required',
                'role_id' =>'required',
                'user_id' => 'required'
            ]);

            $message = [
                'message' => $request->message,
                'user_id' => $request->user_id,
                'role_id' =>  $request->role_id,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];

            User::addNotification($message);
           
               // Return success response
               return response()->json([
                'success' => true,
                'message' => 'Notification added successfully.',
            ], 201);



        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
    
        }



    }

    public function getMessage(Request $request) {

        try {
            // Validate the uploaded file
            $request->validate([
                'user_id' => 'required',
                // 'role_id' =>'required'
            ]);

            $message = [
                'user_id' => $request->user_id,
                // 'role_id' =>  $request->role_id,
            ];

            $messages = User::getNotification($message);


           
               // Return success response
               return response()->json([
                'success' => true,
                'data' => $messages,
                'message' => 'Notification retrived successfully.',
            ], 201);



        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
    
        }

    }


}