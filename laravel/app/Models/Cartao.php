<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cartao extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'banco_id', 'numero', 'validade',
        'cvv', 'tipo', 'limite', 'saldo', 'estado'
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function banco(): BelongsTo
    {
        return $this->belongsTo(Banco::class);
    }
}