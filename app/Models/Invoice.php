<?php

namespace App\Models;

use App\Traits\SaveAttachments\Attachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'invoice_number',
        'date_create_invoice',
        'due_date_invoice',
        'status',
        'product',
        'bank',
        'collection',
        'commission',
        'vat',
        'discount',
        'user',
        'total',
        'notes',
    ];
    protected static function booted()
    {
        static::creating(function (Invoice $invoice) {
            $last = Invoice::latest()->first();
            if (!$last) {
                $invoice->invoice_number = 20230001;
            } else {
                $invoice->invoice_number = $last->invoice_number + 1;
            }
            if (request()->hasFile('attachment')) {
                $invoice->attachment = Attachment::save(request()->file('attachment'), $invoice->invoice_number, 'files');
            }
        });
    }
    public function Details()
    {
        return $this->hasMany(TransactionInvoice::class, 'invoice_id', 'id');
    }
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }
    public function Bank()
    {
        return $this->belongsTo(Section::class, 'bank', 'id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
