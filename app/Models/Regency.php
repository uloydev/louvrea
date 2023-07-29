<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    public const jabodetabek = [3201,3276,3171,3172,3173,3174,3175,3216,3275,3603,3671,3674];

    protected $table = "reg_regencies";
}
