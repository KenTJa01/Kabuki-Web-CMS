<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance_income extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'income_no',
        'income_date',
        'income_type_id',
        'amount',
        'description',
        'created_by',
        'updated_by',
    ];

    protected $table = 'finance_incomes';

}
