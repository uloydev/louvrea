<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;

class RegionController extends Controller
{
    public function jabodetabekRegency()
    {
        return Regency::whereIn('id', Regency::jabodetabek)->get();
    }

    public function districtByRegency(int $id)
    {
        return District::where('regency_id', $id)->get();
    }
}
