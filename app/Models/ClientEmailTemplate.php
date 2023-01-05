<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClientEmailTemplate extends Model
{
     protected $fillable = [
        'template_id',
        'client_id',
        'workspace_id',
        'is_active',
    ];
}
