<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use App\Models\User;

class UsersImportClass implements ToCollection , WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        foreach ($collection as $row) {
            //
            //echo $row[0];
            if(isset($row['mobile10_digit']) && !empty($row['mobile10_digit'])){
            $user = array(
                'name' => $row['first_name'],
                'lname'  => $row['last_name'],
                'mobile'     => $row['mobile10_digit'],
                'email'      => $row['emailoptional'] ?? '',
                'address'    => $row['address'],
                'district'   => $row['district'],
                'tehsil'     => $row['tehsil'],
                'pincode'    => $row['pincode'],
                'role_id'    => ($row['type'] === 'Retialer' ? '5' : '4'),
                'password'   => '1298@XYZ',
                'status'     => '1'
            );

                //      var_dump($user);

                $userdata = [
                    'name' => $user['name'],
                    'lname' => $user['lname'],
                    'mobile' =>  $user['mobile'],
                    'email' => $user['email'],
                    'email_verified_at' => NULL,
                    'password' =>  bcrypt($user['password']),
                    'role_id' => (int) $user['role_id'],
                    'remember_token' => NULL,
                    'status' => (int) $user['status'],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $users =  User::create($userdata);


                 // adding user address
                $address = [];
                $address['user_id'] = $users->id;
                $address['address'] = $user['address'] ?? '';
                $address['district'] = $user['district'] ?? '';
                $address['tehsil'] =  $user['tehsil']?? '';
                $address['pincode'] =  $user['pincode'] ?? '';
                $address['created_at'] =  NOW();

                $address_id = User::addUsersAddress($address);

                // Trigger the Registered event
             
            }


        }
    }


}
