<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibBrgies extends Model
{
    use HasFactory;
    protected $table = 'lib_brgy';
    protected $primaryKey ='brgy_id';
    protected $fillable = [
        'brgy_id',
        'psgc_rcode',
        'region',
        'psgc_pcode',
        'province',
        'psgc_mcode',
        'muncity',
        'psgc_bcode',
        'brgy',
        'geolocation',
        'created_at',
        'updated_at'
    ];
}
