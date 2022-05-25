<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusType extends Model
{
    use HasFactory;

    public $table = 'status_types';

    public function status()
    {
        return $this->hasOne(Status::class);
    }
}
