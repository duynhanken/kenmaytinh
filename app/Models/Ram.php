<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    use HasFactory;
    public $timestamps  =false;
    protected $fillable = [
        'name',
        'slug',
        'capacity',
        'bus',
        'bandwidth',
        'numberofpins',
        'desc',
        'status',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
