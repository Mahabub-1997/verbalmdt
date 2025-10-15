<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number'];

    /**
     * Relationships
     */

    // If a phone number can belong to many electrician registrations
    public function electricianRegistrations()
    {
        return $this->hasMany(GlobalElectricianRegistration::class, 'phone_id');
    }
    /**
     * Get all sponsors associated with this phone number.
     */
    public function sponsors()
    {
        return $this->hasMany(GlobalElectricianSponsor::class, 'phone_id');
    }
    public function enrollments()
    {
        return $this->hasMany(HostEnrollment::class, 'phone_id');
    }
}
