<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\RentPayment;
use App\Models\Maintenance;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProperties' => Property::count(),
            'activeProperties' => Property::where('status','active')->count(),
            'totalUnits' => Property::sum('total_units'),
            'totalTenants' => Tenant::count(),
            'monthlyCollected' => RentPayment::whereMonth('payment_date',now()->month)->sum('amount'),
            'openMaintenance' => Maintenance::where('status','!=','completed')->count(),
        ]);
    }
}