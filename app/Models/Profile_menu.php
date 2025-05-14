<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile_menu extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'profile_id',
        'sub_menu_id',
        'created_by',
        'updated_by',
    ];

    protected $table = 'profile_menus';

}
