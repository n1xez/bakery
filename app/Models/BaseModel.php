<?php

namespace App\Models;

use App\Traits\AuthorisationTrait;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use AuthorisationTrait;
}