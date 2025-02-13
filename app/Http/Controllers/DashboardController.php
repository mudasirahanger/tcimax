<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

class DashboardController extends Controller
{
   

    public function getDashboard() {

        $data = [];

        $data['total_distributors'] = Dashboard::getCountUsers('4') ?? '0';
        $data['total_retailors'] =  Dashboard::getCountUsers('5') ?? '0';
        $data['sales_pending'] = Dashboard::getCountSales('0') ?? '0';
        $data['sales_achieved'] = Dashboard::getCountSales('1') ?? '0';

        return response()->json([
            'counts' => $data,
            'message' => 'Success',
        ]);

    }

}