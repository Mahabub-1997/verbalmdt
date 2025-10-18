<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'parish_id'];

    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    public function county()
    {
        return $this->parish ? $this->parish->county : null;
    }

    public function country()
    {
        return $this->parish && $this->parish->county ? $this->parish->county->country : null;
    }
    // A zip code can have many registrations
    public function electricianRegistrations()
    {
        return $this->hasMany(GlobalElectricianRegistration::class, 'zip_code_id');
    }
    /**
     * Get all sponsors associated with this zip code.
     */
    public function sponsors()
    {
        return $this->hasMany(GlobalElectricianSponsor::class, 'zip_code_id');
    }
    public function enrollments()
    {
        return $this->hasMany(HostEnrollment::class, 'zip_code_id');
    }
    // Relation: ZipCode has many ServiceProviders
    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class, 'zip_code_id');
    }
}
