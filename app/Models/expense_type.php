<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense_type extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'expense_code',
        'expense_name',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'expense_types';

}
