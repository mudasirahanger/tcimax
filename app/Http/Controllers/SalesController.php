<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Excel;
use App\Imports\SalesImportClass;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{

   
    public function addbulksales(Request $request) {

      try {
        // Validate the uploaded file
        $request->validate([
            'bulk_sales' => 'required|mimes:xlsx,xls,csv',
        ]);

        $uploadinfo = [];

        // Get the uploaded file
        $path = $request->file('bulk_sales')->store('excels');

         // Get file details
        $fileName = basename($path); // Get the file name
        $fileExtension = $request->file('bulk_sales')->getClientOriginalExtension();
        // Storage::url($path);        

        // add files in queue
        $uploadinfo['file_name'] = $fileName;
        $uploadinfo['file_path'] = $path;
        $uploadinfo['file_type'] = $fileExtension;
        $uploadinfo['status'] = '0';
        $uploadinfo['user_id'] = Auth::id();
        $uploadinfo['upload_type'] = 'bulksales';
        $uploadinfo['process_id'] = '0';
        $uploadinfo['processed_at'] = NOW();
        $uploadinfo['created_on'] = NOW();

         User::addUploadinfo($uploadinfo);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Sales Data Uploaded in queue successfully.',
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


    public function addsales(Request $request) {

      try {
        // Validate the uploaded file
        $validatedData = $request->validate([
            'date' => ['required',],
            'distributor' => ['required',],
            'retailer' => ['required',],
            'retailer_address' => ['required'],
            'mobile' => ['required', 'integer'],
            'qty' => ['required','integer'],
        ], [
            'date.required' => 'date  is required.',
            'distributor.required' => 'distributor is required.',
            'retailer.required' => 'retailer is required.',
            'retailer_address.required' => 'retailer address is required.',
            'mobile.required' => 'mobile is required.',
            'qty.required' => 'qty is required.',
        ]);

        $sales = [];
        $sales['date'] = $request->date;
        $sales['distributor'] = $request->distributor ?? '';
        $sales['retailer'] = $request->retailer ?? '';
        $sales['retailer_address'] =  $request->retailer_address ?? '';
        $sales['mobile'] =  $request->mobile ?? '';
        $sales['qty'] =  $request->qty ?? '';
       // $sales['created_at'] =  NOW();
       
        echo '<pre>';
        var_dump($sales);
        echo '</pre>';
        die();



        // Return success response
        return response()->json([
            'success' => true,
           
        ], 200);
    } catch (ValidationException $e) {
        // Handle validation errors
        return response()->json([
            'success' => false,
            'errors' => $e->errors(),
        ], 422);

    }

   }


   public function getSalesQueue($page,$limit,$type) {

            $data = [];
            $uploads = [];

            if(!empty($page) && !empty($limit) && !empty($type)){

            $results = User::getSalesQueue($page,$limit,$type);
            $id = 1;
            foreach($results as $result){
                if (Storage::exists($result->file_path)) {
                 $url = asset('storage/app/private/' . $result->file_path);
                } else {
                 $url = '';
                }
                $uploads[] = [
                'sr' => $id,
                'dated' => Carbon::parse($result->created_on)->format('d/m/Y'),
                'status' => $result->status,
                'upload_by' => User::find($result->user_id)->name,
                'upload_type' => $result->upload_type,
                'process_id' => $result->process_id,
                'upload_type' => $result->upload_type,
                'download' => $url
                ];
                $id++;
            }
            $data['uploads'] = $uploads;

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

}