<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cactus_formations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
        'description',
        'slug',
        'photo'
    ];

    /**
     * Desactive timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the etudiants for the club.
     */
    public function etudiants()
    {
        # foreignKey
        return $this->hasMany(Etudiant::class, 'formation_id');
    }
}
