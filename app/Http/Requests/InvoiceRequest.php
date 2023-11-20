<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            // 'invoice_number' => 'required|numeric',
            'date_create_invoice' => 'required|date',
            'due_date_invoice' => 'required|date',
            // 'status' => 'required',
            'product' => 'required',
            'bank' => 'required',
            'collection' => 'required|numeric',
            'commission' => 'required|numeric',
            'vat' => 'required|numeric',
            'discount' => 'numeric',
            'total' => 'required|numeric',
            'attachment' => 'file|mimes:png,jpg,pdf,jpeg',
        ];
    }
}
