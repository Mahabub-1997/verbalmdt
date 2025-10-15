<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalElectricianSponsor extends Model
{
    use HasFactory;

    protected $table = 'global_electrician_sponsors';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'state',
        'city',
        'country_id',
        'county_id',
        'parish_id',
        'zip_code_id',
        'message',
        'licence_number',
        'licence_agency_url',
        'status',
    ];

    /**
     * Relationships
     */

    // Phone relationship
    public function phone()
    {
        return $this->belongsTo(PhoneNumber::class);
    }

    // Country relationship
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // County relationship
    public function county()
    {
        return $this->belongsTo(County::class);
    }

    // Parish relationship
    public function parish()
    {
        return $this->belongsTo(Parish::class);
    }

    // Zip code relationship
    public function zipCode()
    {
        return $this->belongsTo(ZipCode::class);
    }

}
