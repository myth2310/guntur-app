<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'facility';
    protected $primaryKey = 'id_facility';
    protected $fillable = [
        'id_user',
        'lat',
        'longi',
        'type',
    ];
}
