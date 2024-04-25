<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;
    protected $table = 'jobapply';
    protected $primaryKey = 'id';
    public function job(){
        return $this->belongsTo(PostJob::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function company_user(){
        return $this->belongsTo(User::class);
    }
    
}
