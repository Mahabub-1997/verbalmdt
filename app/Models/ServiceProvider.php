<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','category_id','subcategory_ids','pricing_type_id','company_name','registration_number',
        'year_of_establishment','total_employees','phone','email','description','cover_photo','logo','amount',
        'country_id','county_id','parish_id','zip_code_id','state','city','address','upload_document','experience_years',
        'licence_number','licence_agency_url'
    ];

    protected $casts = [
        'subcategory_ids' => 'array',
        'amount' => 'decimal:2',
    ];

    // Provider belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Provider belongs to a Category
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    // Provider belongs to a Subcategory
    public function subcategory()
    {
        return $this->belongsTo(ServiceSubcategory::class, 'subcategory_id');
    }

    // Provider belongs to a Pricing Type
    public function pricingType()
    {
        return $this->belongsTo(PricingType::class, 'pricing_type_id');
    }

    // Provider belongs to Country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // Provider belongs to County
    public function county()
    {
        return $this->belongsTo(County::class, 'county_id');
    }

    // Provider belongs to Parish
    public function parish()
    {
        return $this->belongsTo(Parish::class, 'parish_id');
    }

    // Provider belongs to ZipCode
    public function zipCode()
    {
        return $this->belongsTo(ZipCode::class, 'zip_code_id');
    }

//    // Provider has many Services
    public function services()
    {
        return $this->hasMany(ProviderService::class, 'provider_id');
    }
//
//    // Provider has many Plans
//    public function plans()
//    {
//        return $this->hasMany(ServicePlan::class, 'service_provider_id');
//    }
//
//    // Provider has many Payments
//    public function payments()
//    {
//        return $this->hasMany(Payment::class, 'service_provider_id');
//    }
}
