<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name','phone','service_id','address','note','status'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
