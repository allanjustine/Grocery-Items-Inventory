<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\ItemCategory');
    }
}
