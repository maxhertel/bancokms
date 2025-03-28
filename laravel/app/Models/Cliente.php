<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'banco_id', 'nome', 'bi_number', 'data_nascimento', 
        'genero', 'endereco', 'telefone', 'email', 
        'profissao', 'rendimento'
    ];

    public function banco(): BelongsTo
    {
        return $this->belongsTo(Banco::class);
    }

    public function cartoes(): HasMany
    {
        return $this->hasMany(Cartao::class);
    }
}