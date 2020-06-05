<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    private $table = 'claim';

    protected $fillable = ['amount, description, paymentDueDate'];
}
