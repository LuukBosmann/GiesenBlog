<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reacties extends Model
{
    use HasFactory;

    protected $fillable = [
        'blogs_id',
        'gebruikersId',
        'inhoud',
    ];
}
