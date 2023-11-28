<?php

namespace App\Traits\Filteration;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

trait FilterBanks
{
    public function filter(Request $request)
    {
        $invoices = Invoice::when($request->post('bank'), function (Builder $builder, $value) {
            $builder->where('bank', $value);
        })->when($request->post('product'), function (Builder $builder, $value) {
            $builder->where('product', $value);
        })->when($request->post('From'), function (Builder $builder, $value) {
            $builder->where('created_at', '>=', $value);
        })->when($request->post('To'), function (Builder $builder, $value) {
            $builder->where('created_at', '<=', $value);
        })->get();
        return $invoices;
    }
}
