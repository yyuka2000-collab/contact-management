<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    // Contactsとのリレーション
    public function contacts()
    {
        return $this->hasMany(Contacts::class);
    }
}
