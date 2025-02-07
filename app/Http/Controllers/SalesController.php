<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sales;
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
            'date' => ['required'],
            'distributor_id' => ['required','integer'],
            'retailer_id' => ['required','integer'],
            'retailer_name' => ['required'],
            'retailer_address' => ['required'],
            'retailer_mobile' => ['required', 'integer'],
            'qty' => ['required','integer'],
        ], [
            'date.required' => 'date is required.',
            'distributor_id.required' => 'distributor id is required.',
            'retailer_id.required' => 'retailer id is required.',
            'retailer_name.required' => 'retailer name is required.',
            'retailer_address.required' => 'retailer address is required.',
            'retailer_mobile.required' => 'retailer mobile is required.',
            'qty.required' => 'qty is required.',
        ]);

        $sales = [];
        $mysqlDate = Carbon::createFromFormat('d/M/Y', $request->date)->format('Y-m-d');
        $sales['dated'] = $mysqlDate;
        $sales['distributor_id'] = $request->distributor_id ?? '';
        $sales['retailer_id'] = $request->retailer_id ?? '';
        $sales['retailer_name'] = $request->retailer_name ?? '';
        $sales['retailer_mobile'] =  $request->retailer_mobile ?? '';
        $sales['retailer_address'] =  $request->retailer_address ?? '';
        $sales['qty'] =  $request->qty ?? '';
        $sales['status'] = '1';
        $sales['source'] = "form";
        $sales['voucher_no'] = $request->voucher_no ?? '';
        $sales['created_on'] = NOW();
        $sales['updated_at'] = NOW();

        // echo '<pre>';
        // var_dump($sales);
        // echo '</pre>';
        // die();

        Sales::create($sales);
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
                'upload_id' => $result->upload_id,
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


    public function approveSales(Request $request)
    {

        try {
            // Validate the uploaded file
            $validatedData = $request->validate([
                'user_id' => ['required'],
                'upload_id' => ['required'],
                'status' => ['required']
            ], [
                'user_id.required' => 'user_id is required.',
                'upload_id.required' => 'upload_id is required.',
                'status.required' => 'status is required.',
            ]);

            $sales = [];
            $sales['user_id'] = $request->user_id;
            $sales['upload_id'] = $request->upload_id ?? '';
            $sales['status'] = $request->status ?? '';    
            $sales['upload_type'] = 'bulksales';        
            $sales['created_on'] =  NOW();

            $results = User::UpdateSalesQueue($sales);

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


    public function getSales($page,$limit) {

        $data = [];
        $sales = [];

        if(!empty($page) && !empty($limit)){

        $results = Sales::getSales($page,$limit);
        $id = 1;
        foreach($results as $result){
            $sales[] = [
            'sr' => $id,
            'dated' => Carbon::parse($result->created_at)->format('d/m/Y'),
            'distributor' => User::find($result->distributor_id)->name,
            'retailer' => User::find($result->retailer_id)->name,
            'qty' => $result->qty
            ];
            $id++;
        }
        $data['sales'] = $sales;

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