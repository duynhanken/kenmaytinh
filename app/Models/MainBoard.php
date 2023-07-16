<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class MainBoard extends Model
{
    use HasFactory;

    use Sluggable;

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
