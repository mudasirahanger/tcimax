<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use App\Imports\SalesImportClass;
use Illuminate\Validation\ValidationException;

class SalesController extends Controller
{

   
    public function addbulksales(Request $request) {

      try {
        // Validate the uploaded file
        $request->validate([
            'bulk_sales' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('bulk_sales');

        // Process the Excel file
        Excel::import(new SalesImportClass, $file);
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


}