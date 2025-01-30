<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'common_name',
        'scientific_name',
        'other_names',
        'image_url',
        'cycle',
        'watering',
        'sunlight',
        'indoor',
        'hardiness',
        'edible',
        'poisonous'
    ];

    protected $casts = [
        'other_names' => 'array',
        'indoor' => 'boolean',
        'edible' => 'boolean',
        'poisonous' => 'boolean'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_plant');
    }
}

