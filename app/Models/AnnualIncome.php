<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'annual_income',
    ];
    public function enrollments()
    {
        return $this->hasMany(HostEnrollment::class, 'annual_income_id');
    }
}
