<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'module',
        'flag_desc',
        'flag_value',
        'created_by',
        'updated_by',
    ];

    protected $table = 'statuses';

}
