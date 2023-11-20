<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionInvoice extends Model
{
    use HasFactory;
    protected $table = "transactions-invoices";
    protected $fillable = [
        'invoice_id',
        'status',
    ];
    public function Invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
}
