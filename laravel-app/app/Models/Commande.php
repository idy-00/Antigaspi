<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'boutique_id',
        'client_name',
        'panier_type',
        'prix',
        'status',
        'is_high_priority',
        'due_at',
    ];

    public function boutique()
    {
        return $this->belongsTo(User::class, 'boutique_id');
    }
}
