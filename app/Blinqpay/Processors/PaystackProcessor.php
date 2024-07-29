<?php

namespace App\Blinqpay\Processors;

use Ajosav\Blinqpay\Processors\BasePaymentProcessor;

class PaystackProcessor extends BasePaymentProcessor
{
    public function process(float $amount, ?string $currency = 'NGN'): bool
    {
        // Implement process action.
        return true;
    }

}
