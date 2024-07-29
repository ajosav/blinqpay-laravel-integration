<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ajosav\Blinqpay\DTO\PaymentProcessorDto;
use Ajosav\Blinqpay\Models\BlinqpayCurrency;
use Ajosav\Blinqpay\Facades\Blinqpay;
use Ajosav\Blinqpay\Models\PaymentProcessor;
use App\Http\Requests\Processor\PaymentProcessorRequest;
use Throwable;

class ProcessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_processors = Blinqpay::processor()->all();
        return response()->success('Payment processor retrieved successfully', $payment_processors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentProcessorRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $processor = Blinqpay::processor()
                ->create(PaymentProcessorDto::fromArray(
                    $validated_data
                ));
            return response()->success('Payment processor created successfully', $processor);
        } catch (Throwable $th) {
            report($th);
            return response()->errorResponse('Something went wrong', ['context' => $th->getMessage()]);
        }
    }

    public function show(string $slug)
    {
        $processor =  Blinqpay::processor()->find($slug);
        return response()->success('Payment processor retrieved successfully', $processor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentProcessorRequest $request, PaymentProcessor $payment_processor)
    {
        try {
            $validated_data = $request->validated();
            $processor = Blinqpay::processor()
                ->update($payment_processor->slug, PaymentProcessorDto::fromArray(
                    $validated_data
                ));
            return response()->success('Payment processor updated successfully', $processor);
        } catch (Throwable $th) {
            report($th);
            return response()->errorResponse('Something went wrong', ['context' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function currencies()
    {
        return response()->success('Currencies retrieved successfully', BlinqpayCurrency::all());
    }
}
