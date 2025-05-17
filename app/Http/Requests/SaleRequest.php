<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        dd($this->request);

        return [
            'customer_id' => 'required|exists:partnerships,id',
            'date' => 'required|date',
            'total' => 'required|numeric',
            'disc_percentage' => 'nullable|numeric',
            'disc_nominal' => 'nullable|numeric',
            'final_total' => 'required|numeric',
            'notes' => 'nullable',
            'sale_details' => 'array|min:1',
            'sale_details.*.product_id' => 'required|exists:products,id',
            'sale_details.*.qty' => 'required|numeric',
            'sale_details.*.price' => 'required|numeric',
            'sale_details.*.disc_percentage' => 'nullable|numeric',
            'sale_details.*.disc_nominal' => 'nullable|numeric',
            'sale_details.*.final_price' => 'required|numeric',
            'sale_details.*.notes' => 'nullable',
        ];
    }
}
