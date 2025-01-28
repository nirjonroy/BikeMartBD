<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siteInformation extends Model
{
    use HasFactory;

    protected $table = 'site_information';

    protected $guarded = [];
}
