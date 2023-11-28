<?php

namespace App\Traits\Filteration;

use App\Models\Invoice;

trait FilterInvoice
{
    public function filter($request)
    {
        if ($request->post('filter') == 'filter_by_type') {
            $invoices = $this->isAllInvoices($request);
        } else {
            $invoices = Invoice::where('invoice_number', $request->post('invoice_number'))->get();
        }
        return $invoices;
    }
    public function isAllInvoices($request)
    {
        if ($request->post('invoice') == 'all') {
            $invoices = $this->isFilledDate($request);
        } else {
            $invoices = $this->isFilledDate($request)
                ->where('status', $request->post('invoice'));
        }
        return $invoices;
    }
    public function isFilledDate($request)
    {
        if ($request->filled("From") && $request->filled("To")) {
            $invoices = Invoice::getDate($request)->get();
        } elseif ($request->filled("From")) {
            $invoices = Invoice::where('created_at', '>=', $request->post('From'))->get();
        } elseif ($request->filled("To")) {
            $invoices = Invoice::where('created_at', '<=', $request->post('To'))->get();
        } else {
            $invoices = Invoice::get();
        }
        return $invoices;
    }
}
