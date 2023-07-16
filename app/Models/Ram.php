<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Ram extends Model
{
    use Sluggable;

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
