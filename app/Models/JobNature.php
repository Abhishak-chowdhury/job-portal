<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobNature extends Model
{
    use HasFactory;
    protected $table = 'job_roll';
    protected $primaryKey = 'id';
}
