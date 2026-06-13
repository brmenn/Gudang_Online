<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = ['name', 'contact_person', 'email', 'phone', 'address'];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class);
    }
}
