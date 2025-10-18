<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relation: PricingType has many ServiceProviders
    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class, 'pricing_type_id');
    }
}
