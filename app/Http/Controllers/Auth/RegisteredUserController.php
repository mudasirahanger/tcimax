<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{

    public function store(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
              //  'email' => ['required', 'string', 'email', 'max:255'],
                'mobile' => ['required', 'unique:users,mobile'],
                'role_id' => ['required', 'integer'],
                'status' => ['required', 'integer'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], [
                'name.required' => 'First name is required.',
                'lname.required' => 'Last name is required.',
                //  'email.required' => 'Email is required.',
                //  'email.email' => 'The email address is invalid.',
                //  'email.unique' => 'This email is already registered.',
                 'mobile.required' => 'Mobile number is required.',
                'mobile.unique' => 'This mobile number is already registered.',
                'role_id.required' => 'Role ID is required.',
                'role_id.integer' => 'Role ID must be a valid integer.',
                'status.required' => 'Status is required.',
                'status.integer' => 'Status must be a valid integer.',
                'password.required' => 'Password is required.',
                'password.confirmed' => 'Passwords do not match.',
            ]);

            // Create the user
            $user = User::create([
                'name' => $validatedData['name'],
                'lname' => $validatedData['lname'],
                'email' => $request->email ?? '', //$validatedData['email'],
                'mobile' => $validatedData['mobile'],
                'role_id' => (int) $validatedData['role_id'],
                'status' => (int) $validatedData['status'],
                'password' => Hash::make($validatedData['password']),
            ]);

           
           
            // adding user address
            $address = [];
            $address['user_id'] = $user->id;
            $address['address'] = $request->address ?? '';
            $address['district'] = $request->district ?? '';
            $address['tehsil'] =  $request->tehsil ?? '';
            $address['pincode'] =  $request->pincode ?? '';
            $address['created_at'] =  NOW();

            $address_id = User::addUsersAddress($address);

            // Trigger the Registered event
            event(new Registered($user));

            // Generate a personal access token for the user
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully.',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 201);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Log unexpected exceptions and return a generic error message
            Log::error('User Registration Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }
}
