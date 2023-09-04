<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOffline extends Model
{
    use HasFactory;

    protected $table = 'transaction_offline'; // Add this line

    protected $fillable = [
        'user_id',
        'montant',
        'status',
        'compte',
        'reference',
        'date_heure',
        'photo_paiement',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}