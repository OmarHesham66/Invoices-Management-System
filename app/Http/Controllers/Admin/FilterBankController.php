<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Filteration\FilterBanks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FilterBankController extends Controller
{
    use FilterBanks;
    public function index()
    {
        $banks = DB::table('sections')->select('id', 'name')->get();
        return view('Site.FilterInvoices.filter_banks', compact('banks'));
    }
    public function search(Request $request)
    {
        $invoices = $this->filter($request);
        session()->flash('invoices', $invoices);
        return redirect()->route('banks.search');
    }
}
