<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Todos extends Model
{
    use SoftDeletes;

    protected $fillable = ['texte', 'termine', 'important'];

    // Optionnel mais recommandé si tu veux accéder à deleted_at comme un objet Carbon
    //protected $dates = ['deleted_at'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Categories::class);
    }

    public function listes(): BelongsTo
    {
        return $this->belongsTo(Listes::class);//->withDefault();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,     // modèle lié
            'todos_user',    // nom exact de la table pivot
            'todos_id',      // clé locale (dans todos_user)
            'user_id'        // clé étrangère (dans todos_user)
        );
    } 
}
