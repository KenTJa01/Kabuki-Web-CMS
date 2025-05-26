<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income_type extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'income_code',
        'income_name',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'income_types';

}
