<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\RentPayment;
use App\Models\Maintenance;

class DashboardController extends Controller
{
    public function index(){
        $dashboardData = [
           'latestUsers' => User::latest()->take(10)->get(),
            'user_count' => User::all()->count(),
             'latestTransactions' => Transaction::latest()->take(10)->with('user')->get(),
            'totalProperties' => Property::count(),
            'activeProperties' => Property::where('status','active')->count(),
            'totalTenants' => Tenant::count(),
            'monthlyCollected' => RentPayment::whereMonth('payment_date',now()->month)->sum('amount'),
            'openMaintenance' => Maintenance::where('status','!=','completed')->count(),
        ];

        return view('Admin.index', compact('dashboardData'));
    }
}
