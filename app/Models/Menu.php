<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'menu_name',
        'menu_url',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'menus';

}
