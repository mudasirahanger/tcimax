<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Excel;
use App\Imports\SalesImportClass;
use App\Imports\UsersImportClass;

class ProcessUploadedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process uploaded files every 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // php artisan app:process-sales command
        $uploads = User::getUploadinfo();

        foreach ($uploads as $upload) {
            $filePath = $upload->file_path;
      
            if (Storage::exists($filePath)) {
                // Process the file (e.g., move, parse, convert)
                // Example: Just marking it as processed
               $where = ['upload_id' => $upload->upload_id];
               $update = ['process_id' => '1', 'processed_at' => now()];
              
                if($upload->upload_type === 'bulksales' && $upload->status == true){
                // Process the Excel file
               // Excel::import(new SalesImportClass, $file);
                } 
                if($upload->upload_type === 'bulkusers'){
                    // Process the Excel file
                    Excel::import(new UsersImportClass, $filePath);
                } 
               
                
                User::updateUploadinfo($where,$update);

                $this->info("Processed: " . $upload->file_name . ' Type: ' . $upload->upload_type);
            } else {
                $this->error("File not found: " . $upload->file_name . ' Type: ' . $upload->upload_type);
            }
        }

        $this->info('File processing completed.');
    }
}
