<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'content', 'created_by'];

    public function creator()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
}
