<?php
namespace App\Services\Implementations;

use App\Services\Interfaces\DashboardServiceInterface;
use Illuminate\Http\Request;

class DashboardService implements DashboardServiceInterface{
    public function getDashboardData(Request $request)
    {
        return [];
    }

}
