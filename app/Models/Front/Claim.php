<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $table = 'claim';

    protected $fillable = ['amount', 'description', 'paymentDueDate'];
}
