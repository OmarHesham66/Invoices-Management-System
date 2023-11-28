<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Traits\Filteration\FilterInvoice;
use Illuminate\Http\Request;

class FilterInvoiceController extends Controller
{
    use FilterInvoice;
    public function index()
    {
        return view('Site.FilterInvoices.filter_invoice');
    }
    public function search(Request $request)
    {
        $invoices = $this->filter($request);
        session()->flash('invoices', $invoices);
        return redirect()->route('invoice.search');
    }
}
