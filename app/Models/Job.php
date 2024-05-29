<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Job extends Model{
    // name of the table if class name mismatches
    protected $table = 'job_listings';

    // list of all columns that can be mass assigned
    protected $fillable = ['title', 'salary'];
}

?>