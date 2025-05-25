<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving_header extends Model
{

    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'rec_no',
        'rec_date',
        'supp_name',
        'invoice_no',
        'flag',
        'created_by',
        'updated_by'
    ];

    protected $table = "receiving_headers";

}
