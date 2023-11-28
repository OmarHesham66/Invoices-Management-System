<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ApiRequests\Invoice\InvoiceRequestApi;

class InvoiceController extends Controller
{
    use \App\Traits\ResponseApi\Response;
    /**
     * Display a listing of the resource.
     */
    public function index($status = null)
    {
        if ($status) {
            $invoices = Invoice::where('status', $status)->Paginate(COUNTER);
        } else {
            $invoices = Invoice::Paginate(COUNTER);
        }
        return $this->sendResponse('data', InvoiceResource::collection($invoices), 'success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequestApi $request)
    {
        if (!empty($request->getErrors())) {
            return $this->sendResponse('errors', $request->getErrors(), 'Error', 401);
        }
        $data = $request->getRequest()->except('_token', 'file');
        $data['status'] = 'Unpaid';
        $data['user'] = auth()->id();
        DB::beginTransaction();
        try {
            Invoice::create($data)->Details()->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendResponse('errors', $th->getMessage(), 'Error', 401);
        }
        return $this->sendResponse('message', 'Created Invoice Successfuly', 'success', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequestApi $request, Invoice $invoice)
    {
        if (!empty($request->getErrors())) {
            return $this->sendResponse('errors', $request->getErrors(), 'Error', 401);
        }
        $request->getRequest()['user'] = auth()->id();
        if ($request->getRequest()->hasFile('attachment')) {
            if ($invoice->attachment) {
                Storage::disk('files')->delete($invoice->attachment);
                $request->getRequest()['attachment'] = $this->save($request->getRequest()->file('attachment'), 'attachment', 'files');
            } else {
                $request->getRequest()['attachment'] = $this->save($request->getRequest()->file('attachment'), 'attachment', 'files');
            }
        }
        $invoice->update($request->getRequest()->all());
        return $this->sendResponse('message', 'Updated Invoice Successfuly', 'success', 200);
    }

    public function archive(Invoice $invoice)
    {
        $invoice->delete();
        return $this->sendResponse('message', 'Archived Invoice Successfuly', 'success', 204);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->forceDelete();
        return $this->sendResponse('message', 'Deleted Invoice Successfuly', 'success', 204);
    }
    public function apply_status(Request $request, Invoice $invoice)
    {
        $Validator = Validator::make($request->all(), ['status' => 'required', 'TimeOfChangeStatus' => 'required']);
        if ($Validator->fails()) {
            return $this->sendResponse('errors', $Validator->errors()->toArray(), 'Error', 401);
        }
        $invoice->status = $request->status;
        $invoice->save();
        $invoice->Details()->create(['created_at' => $request->TimeOfChangeStatus, 'status' => $request->status]);
        return $this->sendResponse('message', 'Updated Status Of Invoice', 'success', 204);
    }
    public function GetAllProductsByOneSection($id)
    {
        $products = DB::table('products')->select('id', 'name')->where('Bank', $id)->get();
        return $this->sendResponse('data', $products, 'success', 200);
    }
}
