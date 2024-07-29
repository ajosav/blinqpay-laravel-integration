<?php

namespace App\Http\Controllers\API\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use Ajosav\Blinqpay\Facades\Blinqpay;

class PaymentController extends Controller
{
    public function __invoke(PaymentRequest $request)
    {
        Blinqpay::initiatePayment($request->amount, $request->currency ?? 'NGN')
            ->pay(fn ($reference, $log) => info("Successfully processed payment with transaction reference {$reference}. Amount: {$log->name}"));
        return response()->json(['status' => true, 'message' => 'Successful']);
    }
}
