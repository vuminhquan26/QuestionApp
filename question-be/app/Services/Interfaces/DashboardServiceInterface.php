<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface DashboardServiceInterface
{
    public function getDashboardData(Request $request);
}
