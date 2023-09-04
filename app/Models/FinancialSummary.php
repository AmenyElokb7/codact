<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialSummary extends Model
{
    protected $table = 'financial_summary';

    // Define the fillable attributes for the financial summary
    protected $fillable = [
        // Attributes from WalletHistoric
        'user_id', 'pdf_path', 'amount','title','description',
        // Attributes from TransactionOffline
        'montant', 'status', 'compte', 'reference', 'date_heure', 'photo_paiement',
        // Attributes from Transaction
        'sender_id', 'recipient_id', 'amount', 'pdf_path','Creator'
    ];

    // Define the relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    // Define any additional relationships or logic here as needed
}