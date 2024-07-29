<?php

namespace App\Blinqpay\Processors;

use Ajosav\Blinqpay\Processors\BasePaymentProcessor;

class FlutterwaveProcessor extends BasePaymentProcessor
{
    public function process(float $amount, ?string $currency = 'NGN'): bool
    {
        // Implement process action.
        return true;
    }

}
