<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientProject extends Model
{
    protected $fillable = [
        'client_id','project_id','is_active','permission'
    ];

    public static function getByProjects($project_id){
        $check = self::where('project_id',$project_id)->pluck('client_id');
        if($check->count() > 0){
            return $check->toArray();
        }else{
            return [];
        }
    }
}
