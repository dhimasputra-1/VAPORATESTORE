<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'user_id',
        'total_price',
        'payment_status',
        'payment_proof',
        'payment_method',
        'payment_channel',
        'transaction_date',
        'print_status',
        'printed_at',
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // relasi ke tabel users
    }
}
