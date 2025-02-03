<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
            $user = array(
                'first_name' => $row['first_name'],
                'last_name'  => $row['last_name'],
                'mobile'     => $row['mobile10_digit'],
                'email'      => $row['emailoptional'] ?? '',
                'address'    => $row['address'],
                'district'   => $row['district'],
                'tehsil'     => $row['tehsil'],
                'pincode'    => $row['pincode'],
                'type'       => ($row['type'] === 'Retialer' ? '5' : '4')
            );

      //      var_dump($user);

        }
    }


}
