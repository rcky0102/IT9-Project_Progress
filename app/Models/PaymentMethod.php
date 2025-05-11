<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';
    
    protected $fillable = [
        'cardholder_name',
        'card_number',
        'expiration_month',
        'expiration_year',
        'security_code',
    ];


    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = Crypt::encryptString($value);
    }


    // public function getCardNumberAttribute($value)
    // {
    //     return Crypt::decryptString($value);
    // }


    public function setSecurityCodeAttribute($value)
    {
        $this->attributes['security_code'] = Crypt::encryptString($value);
    }


    public function getSecurityCodeAttribute($value)
    {
        return Crypt::decryptString($value);
    }


    public function getExpirationDateAttribute()
    {
        return $this->expiration_month . '/' . $this->expiration_year;
    }
}
