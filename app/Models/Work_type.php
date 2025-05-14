<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_type extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'work_type_code',
        'work_type_name',
        'work_type_desc',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'work_types';

}
