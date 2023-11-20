<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Traits\SaveAttachments\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    use Attachment;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::Paginate(COUNTER);
        return view('Site.Invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banks = DB::table('sections')->select('id', 'name')->get();
        return view('Site.Invoices.Crud.add-invoices', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        $data = $request->except('_token', 'file');
        $data['status'] = 'Unpaid';
        $data['user'] = auth()->id();
        DB::beginTransaction();
        try {
            Invoice::create($data)->Details()->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('database', $th->getMessage());
            return redirect()->route('invoice.index');
        }
        session()->flash('success', __('Created Invoice'));
        return redirect()->route('invoice.index');
    }

    /**
     * Display the specified resource.
     */
    public function show_status(Invoice $invoice)
    {
        return view('Site.Invoices.Crud.edit-status', compact('invoice'));
    }
    public function apply_status(Request $request, Invoice $invoice)
    {
        $request->validate(['status' => 'required', 'TimeOfChangeStatus' => 'required']);
        $invoice->status = $request->status;
        $invoice->save();
        $invoice->Details()->create(['created_at' => $request->TimeOfChangeStatus, 'status' => $request->status]);
        session()->flash('success', __('Updated Status Of Invoice'));
        return redirect()->route('invoice.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $banks = DB::table('sections')->select('id', 'name')->get();
        return view('Site.Invoices.Crud.edit-invoices', compact('invoice', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $request['user'] = auth()->id();
        if ($request->hasFile('attachment')) {
            if ($invoice->attachment) {
                Storage::disk('files')->delete($invoice->attachment);
                $request['attachment'] = $this->save($request->file('attachment'), 'attachment', 'files');
            } else {
                $request['attachment'] = $this->save($request->file('attachment'), 'attachment', 'files');
            }
        }
        $invoice->update($request->all());
        session()->flash('update', __('Updated Invoice'));
        return redirect()->route('invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function archive(Invoice $invoice)
    {
        $invoice->delete();
        session()->flash('success', __('Archived Invoice'));
        return redirect()->route('invoice.index');
    }
    public function restore($id)
    {
        Invoice::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', __('Restore Invoice'));
        return redirect()->route('invoice.index');
    }
    public function destroy(Request $request, Invoice $invoice)
    {
        $invoice->forceDelete();
        session()->flash('success', __('Deleted Invoice'));
        return redirect()->route('invoice.index');
    }
    public function GetAllProductsByOneSection($id)
    {
        $products = DB::table('products')->select('id', 'name')->where('Bank', $id)->get();
        return response()->json(['products' => $products], 200);
    }
}
