<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance_expense extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'expense_no',
        'expense_date',
        'expense_type_id',
        'amount',
        'description',
        'created_by',
        'updated_by',
    ];

    protected $table = 'finance_expenses';

}
