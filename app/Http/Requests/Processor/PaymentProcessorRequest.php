<?php

namespace App\Http\Requests\Processor;

use Illuminate\Validation\Rule;
use App\Enums\ProcessorStatusEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class PaymentProcessorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required', Rule::when(
                    $this->route('processor'),
                    Rule::unique('payment_processors', 'name')->ignore($this->route('processor')->id),
                    Rule::unique('payment_processors', 'name')
                )
            ],
            'status' => ['nullable', new Enum(ProcessorStatusEnum::class)],
            'currency_ids' => ['required', 'array'],
            'currency_ids.*' => ['integer', 'exists:blinqpay_currencies,id'],
            'fees_percentage' => ['required', 'numeric'],
            'fees_cap' => ['nullable', 'numeric'],
            'reliability' => ['nullable', 'integer'],
        ];
    }
}
