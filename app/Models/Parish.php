<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Parish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'county_id'];

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function zipCodes()
    {
        return $this->hasMany(ZipCode::class);
    }

    public function country()
    {
        return $this->county ? $this->county->country : null;
    }

    // A parish can have many registrations
    public function electricianRegistrations()
    {
        return $this->hasMany(GlobalElectricianRegistration::class);
    }

    /**
     * Get all sponsors associated with this parish.
     */
    public function sponsors()
    {
        return $this->hasMany(GlobalElectricianSponsor::class, 'parish_id');
    }

    public function enrollments()
    {
        return $this->hasMany(HostEnrollment::class, 'parish_id');
    }

    // Relation: Parish has many ServiceProviders
    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class, 'parish_id');

    }
}
