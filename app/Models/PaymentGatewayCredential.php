<?php

namespace App\Models;

use App\Traits\HasRestaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayCredential extends Model
{

    use HasFactory, HasRestaurant;

    protected $guarded = ['id'];

    const QR_CODE_FOLDER = 'qr-codes';


    protected $casts = [
        'stripe_key' => 'encrypted',
        'razorpay_key' => 'encrypted',
        'stripe_secret' => 'encrypted',
        'razorpay_secret' => 'encrypted',
    ];


    protected $appends = [
        'qr_code_image_url',
    ];


    public function qrCodeImageUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->qr_code_image ? asset_url_local_s3(self::QR_CODE_FOLDER . '/' . $this->qr_code_image) : '';
        });
    }

    public function getFlutterwaveKeyAttribute()
    {
        return ($this->flutterwave_mode == 'test' ? $this->test_flutterwave_key : $this->live_flutterwave_key);
    }

    public function getFlutterwaveSecretAttribute()
    {
        return ($this->flutterwave_mode == 'test' ? $this->test_flutterwave_secret : $this->live_flutterwave_secret);
    }

    public function getFlutterwaveWebhookKeyAttribute()
    {
        return ($this->flutterwave_mode == 'test' ? $this->flutterwave_test_webhook_key : $this->flutterwave_live_webhook_key);
    }
}
