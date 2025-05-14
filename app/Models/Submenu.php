<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'menu_id',
        'submenu_name',
        'submenu_url',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'submenus';

}
