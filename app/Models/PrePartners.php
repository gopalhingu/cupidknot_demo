<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrePartners extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'pre_income_from',
        'pre_income_to',
        'pre_manglik'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function preOccupation()
    {
        return $this->hasMany(PreOccupation::class, 'partner_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function preFamilyType()
    {
        return $this->hasMany(PreFamilyTypes::class, 'partner_id', 'id');
    }


}
