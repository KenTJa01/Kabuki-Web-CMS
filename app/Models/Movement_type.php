<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement_type extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'mov_code',
        'mov_name',
        'created_by',
        'updated_by',
    ];

    protected $table = 'movement_types';

}
