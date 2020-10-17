<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * Phone numbers that belong to this contact.
     */
    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }
}
