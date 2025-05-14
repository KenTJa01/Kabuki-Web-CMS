<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    use HasFactory;

    protected $primaryKey = "id";
    public $increment = true;

    protected $fillable = [
        'profile_code',
        'profile_name',
        'flag',
        'created_by',
        'updated_by',
    ];

    protected $table = 'profiles';

}
