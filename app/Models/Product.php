<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'description',
    ];

    public function decreaseQuantity(int $amount): bool
    {
        if ($this->quantity < $amount) {
            return false;
        }

        $this->quantity -= $amount;
        $this->save();

        return true;
    }
}
