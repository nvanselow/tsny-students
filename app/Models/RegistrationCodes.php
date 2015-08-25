<?php

namespace Tsny\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RegistrationCodes extends Model
{

    protected $dates = ['created_at', 'updated_at', 'expires'];

    public function isExpired(){
        return !$this->expires->isFuture();
    }
}
