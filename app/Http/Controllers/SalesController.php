<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
use App\Imports\SalesImportClass;

class SalesController extends Controller
{

   
    public function addsales(Request $request) {


        // Validate the uploaded file
        $request->validate([
            'bulk_sales' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('bulk_sales');

        // Process the Excel file
        Excel::import(new SalesImportClass, $file);


    }



}