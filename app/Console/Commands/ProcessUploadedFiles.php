<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


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
    protected $description = 'Process uploaded files every 15 minutes';

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
              
               User::updateUploadinfo($where,$update);

                $this->info("Processed: " . $upload->file_name);
            } else {
                $this->error("File not found: " . $upload->file_name);
            }
        }

        $this->info('File processing completed.');
    }
}
