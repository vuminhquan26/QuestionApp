<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface CampusServiceInterface
{
    public function getList(Request $request);
}
