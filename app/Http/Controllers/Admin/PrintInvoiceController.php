<?php

namespace App\Http\Controllers\Admin;

use App\Exports\InvoicesTableToExcel;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PrintInvoiceController extends Controller
{
    public function print_invoice()
    {
        Excel::download(new InvoicesTableToExcel, 'invoicesExcel.xlsx');
        session()->flash('success', 'Downloaded Excel');
        return redirect()->route('invoice.index');
    }
}
