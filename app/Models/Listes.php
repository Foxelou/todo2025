<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listes extends Model
{
    use HasFactory;

    protected $fillable = ['libelle'];

    // Une liste a plusieurs todos
    public function todos(): HasMany
    {
        return $this->hasMany(Todos::class);
    }
}
