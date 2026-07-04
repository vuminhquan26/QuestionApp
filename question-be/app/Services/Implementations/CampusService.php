<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\CampusServiceInterface;
use App\Models\Campus;
use Illuminate\Http\Request;

class CampusService implements CampusServiceInterface{
    public function getList(Request $request){
        return Campus::query()->get();
    }
}
