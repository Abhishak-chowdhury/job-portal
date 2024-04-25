<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $primaryKey = 'id';

    public function jobNature(){
        return $this->belongsTo(JobNature::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function jobapply(){
        return $this->hasMany(JobApply::class,'job_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
