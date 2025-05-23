<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    use HasFactory;

    protected $fillable = [
        "contenu",
        "auteur",
        "popularite",
        "nbr_mots",
        "url_image",
    ];
}
