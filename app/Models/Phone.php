<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    public $table = 'phones';
    public $timestamps = false;
    protected $fillable = [
        'number','type','contact_id'
    ];
}
