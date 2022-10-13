<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class subscriptions extends Model implements AuditableContract
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'subscriptions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'account_no',
        'plan_code',
        'subscription_date',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
