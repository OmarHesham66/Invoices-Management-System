<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsController extends Controller
{
    public function get_invoice_details(Invoice $invoice)
    {
        $invoice = $invoice->load('Details');
        return view('Site.Invoices.invoices_details', compact('invoice'));
    }
    public function show_file(Invoice $invoice)
    {
        return response()->file('files/' . $invoice->invoice_number . '/' . $invoice->attachment);
    }

    public function download_file(Invoice $invoice)
    {
        return response()->download('files/' . $invoice->invoice_number . '/' . $invoice->attachment, $invoice->attachment);
    }
    public function delete_file(Invoice $invoice)
    {
        Storage::disk('files')->delete($invoice->invoice_number . $invoice->attachment);
        $invoice->attachment = null;
        $invoice->save();
        session()->flash('deleted', 'Attachment Deleted');
        return redirect()->back();
    }
}
