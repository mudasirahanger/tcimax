<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UsersImportClass implements ToCollection, WithHeadingRow
{
    protected $skippedUsers = [];

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if (!isset($row['mobile10_digit']) || empty($row['mobile10_digit'])) {
                continue; // Skip empty mobile numbers
            }

            // Check if the user already exists
            $existingUser = User::where('mobile', $row['mobile10_digit'])->first();

            if ($existingUser) {
                // Log skipped users
                $this->skippedUsers[] = [
                    'name'     => $row['first_name'],
                    'lname'    => $row['last_name'],
                    'mobile'   => $row['mobile10_digit'],
                    'email'    => $row['emailoptional'] ?? '',
                    'reason'   => 'Mobile number already registered'
                ];
                continue;
            }

            // Prepare user data
            $user = [
                'name'       => $row['first_name'],
                'lname'      => $row['last_name'],
                'mobile'     => $row['mobile10_digit'],
                'email'      => $row['emailoptional'] ?? '',
                'address'    => $row['address'],
                'district'   => $row['district'],
                'tehsil'     => $row['tehsil'],
                'pincode'    => $row['pincode'],
                'role_id'    => ($row['type'] === 'Retialer' ? '5' : '4'),
                'password'   => bcrypt('1298@XYZ'),
                'status'     => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];

            $users = User::create($user);

            // Add user address
            User::addUsersAddress([
                'user_id'    => $users->id,
                'address'    => $user['address'],
                'district'   => $user['district'],
                'tehsil'     => $user['tehsil'],
                'pincode'    => $user['pincode'],
                'created_at' => Carbon::now()
            ]);
        }

        // Generate an Excel file with skipped users
        if (!empty($this->skippedUsers)) {
            $this->exportSkippedUsers();
        }
    }

    /**
     * Export skipped users to an Excel file.
     */
    protected function exportSkippedUsers()
    {
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $filename = "skipped_users_{$timestamp}.xlsx";
     //   $filePath = Storage::put('excels',$filename);
     //   Excel::store(new SkippedUsersExport($this->skippedUsers), $filePath, 'local');
        Log::info("Skipped users exported: ");
        Log::info(print_r($this->skippedUsers,true));
    }
}
