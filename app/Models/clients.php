<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class clients extends Model implements AuditableContract
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'application_type',
        'account_no',
        'name',
        'ext_name',
        'contact_number',
        'landline_number',
        'email',
        'present_house_no',
        'present_street',
        'present_address_brgy',
        'present_address_muncity',
        'present_address_province',
        'present_address_region',
        'permanent_house_no',
        'permanent_street',
        'permanent_address_brgy',
        'permanent_address_muncity',
        'permanent_address_province',
        'permanent_address_region',
        'birth_date',
        'nationality',
        'birth_place',
        'client_sex',
        'civil_status',
        'client_status',
        'date_deceased',
        'date_registered',
        'industry',
        'tin',
        'representative_name',
        'company_id',
        'ownership',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
