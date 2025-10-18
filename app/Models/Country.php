<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Get all counties that belong to this country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function counties()
    {
        return $this->hasMany(County::class);
    }

    /**
     * Get all parishes through counties of this country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function parishes()
    {
        return $this->hasManyThrough(Parish::class, County::class);
    }

    /**
     * Get all zip codes through parishes of this country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function zipCodes()
    {
        // Parameters: Related, Through, ForeignKey on Through, ForeignKey on Related, LocalKey, LocalKey on Through
        return $this->hasManyThrough(
            ZipCode::class,
            Parish::class,
            'county_id',
            'parish_id',
            'id',
            'id'
        );
    }
    // One country can have many registrations
    public function electricianRegistrations()
    {
        return $this->hasMany(GlobalElectricianRegistration::class);
    }
    /**
     * Get all sponsors associated with this country.
     */
    public function sponsors()
    {
        return $this->hasMany(GlobalElectricianSponsor::class, 'country_id');
    }
    public function enrollments()
    {
        return $this->hasMany(HostEnrollment::class, 'country_id');
    }
    // Relation: Country has many ServiceProviders
    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class, 'country_id');
    }
}
