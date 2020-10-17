<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Phone numbers that belong to this contact.
     */
    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }

    /**
     * Get contact's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Clean-up dependent records.
     */
    public static function boot() {
        parent::boot();
        self::deleting(function($contact) {
             $contact->phoneNumbers()->each(function($phoneNumber) {
                $phoneNumber->delete();
             });
        });
    }
}
