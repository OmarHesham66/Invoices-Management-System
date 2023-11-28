<?php

namespace App\Http\Requests\ApiRequests\Invoice;

use App\Http\Requests\ApiRequests\BaseApiForm;

class InvoiceRequestApi extends BaseApiForm
{
    public function rules()
    {
        return [
            'date_create_invoice' => 'required|date',
            'due_date_invoice' => 'required|date',
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
