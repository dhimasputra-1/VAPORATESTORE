<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_code', 'user_id', 'total_price', 'payment_method', 'transaction_date', 'print_status', 'printed_at'];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
