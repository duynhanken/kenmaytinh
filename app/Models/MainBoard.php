<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainBoard extends Model
{
    use HasFactory;
    public $timestamps  =false;
    protected $fillable = [
        'name',
        'slug',
        'size',
        'chipset',
        'usbgate',
        'ramslots',
        'manufacturer',
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
