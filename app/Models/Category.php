<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Categories\Models\Category as RinvexCategory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends RinvexCategory implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $casts = [
        'erp_medias' => 'json'
    ];
    
    // public function attributes() {
    //     return $this->hasMany(CategoryAttribute::class);
    // }
}
