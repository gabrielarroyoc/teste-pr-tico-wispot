<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;
    protected $table="table_eventos";
    protected $fillable = [
        'name',
        'description',
        'time',
        'start_time',
        'end_time',
        'recurrence'	
    ];
}
