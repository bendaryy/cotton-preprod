<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apisetting extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','secret_id','commercial_number','access_token' ];
}
