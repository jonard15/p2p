<?php

use Illuminate\Support\Facades\Schema as FacadesSchema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\{Subscribers,Plans};


function columnSetter($model, $request)
{
    $columns = FacadesSchema::getColumnListing($model->getTable());
    foreach ($columns as $column) {
        if (!isset($request[$column]) || empty($request[$column])) {
            continue;
        }
        if (is_array($request[$column])) {
            if (array_filter($request[$column])) {
                $model->{$column} = json_encode(
                    $request[$column]
                );
            }
            continue;
        }
        $model->{$column} = $request[$column];
    }
    unset($column);
}

function generateAccountNo()
{
    $date = Carbon::today()->format('Y-m-d');
    $count = Subscribers::whereDate('created_at', '=', $date)->count();
    $date_created = Carbon::now();
    $counted = substr(str_repeat(0, 4).($count + 1), - 4);
    return
        'S'.
        $date_created->format('m').
        $date_created->format('d').
        $date_created->format('Y').
        $counted;
}

function generatePlanCode()
{
    $date = Carbon::today()->format('Y-m-d');
    $count = Plans::whereDate('created_at', '=', $date)->count();
    $date_created = Carbon::now();
    $counted = substr(str_repeat(0, 4).($count + 1), - 4);
    return
        'P'.
        $date_created->format('m').
        $date_created->format('d').
        $date_created->format('Y').
        $counted;
}