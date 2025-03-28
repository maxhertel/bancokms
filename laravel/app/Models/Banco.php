<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banco extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'codigo', 'endereco', 'telefone', 'email'
    ];

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class);
    }

    public function cartoes(): HasMany
    {
        return $this->hasMany(Cartao::class);
    }
}