<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type'];
    public $timestamps = false;
}
