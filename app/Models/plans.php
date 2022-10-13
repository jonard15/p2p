<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class plans extends Model implements AuditableContract
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'plan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'code',
        'name',
        'term_mode',
        'term_no',
        'amount',
        'installation_fee',
        'inclusions',
        'others',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
