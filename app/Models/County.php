<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id'];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function parishes()
    {
        return $this->hasMany(Parish::class);
    }

    public function zipCodes()
    {
        return $this->hasManyThrough(ZipCode::class, Parish::class);
    }
    // A county can have many registrations
    public function electricianRegistrations()
    {
        return $this->hasMany(GlobalElectricianRegistration::class);
    }
    /**
     * Get all sponsors associated with this county.
     */
    public function sponsors()
    {
        return $this->hasMany(GlobalElectricianSponsor::class, 'county_id');
    }
    public function enrollments()
    {
        return $this->hasMany(HostEnrollment::class, 'county_id');
    }
    // Relation: County has many ServiceProviders
    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class, 'county_id');
    }
}
