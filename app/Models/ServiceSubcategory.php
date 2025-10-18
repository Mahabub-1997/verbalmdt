<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
    ];

    // Relationship to ServiceCategory
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
    // Relation: Subcategory has many ServiceProviders
    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class, 'subcategory_id');
    }
    // Subcategory has many Providers
    public function providers()
    {
        return $this->hasMany(ServiceProvider::class, 'subcategory_id');
    }
}
