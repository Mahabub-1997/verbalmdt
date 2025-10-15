<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostEnrollment extends Model

{
    use HasFactory;

    protected $table = 'host_enrollments';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'annual_income_id',
        'employee_number',
        'city',
        'state',
        'country_id',
        'county_id',
        'parish_id',
        'zip_code_id',
        'message',
        'licence_number',
        'licence_agency_url',
        'status',
        'answers_json',
    ];

    // Cast fields
    protected $casts = [
        'answers_json' => 'array',
        'status'       => 'string', // enum field
    ];

    // Relationships (if you want to define)
    public function phone()
    {
        return $this->belongsTo(PhoneNumber::class, 'phone_id');
    }

    public function annualIncome()
    {
        return $this->belongsTo(AnnualIncome::class, 'annual_income_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function county()
    {
        return $this->belongsTo(County::class, 'county_id');
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class, 'parish_id');
    }

    public function zipCode()
    {
        return $this->belongsTo(ZipCode::class, 'zip_code_id');
    }
}

