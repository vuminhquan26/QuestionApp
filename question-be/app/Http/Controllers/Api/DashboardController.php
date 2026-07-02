<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardServiceInterface $service){
        $this->service = $service;
    }

}
