<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistik extends Model
{
    use HasFactory;
    protected $fillable = ['jumlah_view', 'jumlah_like', 'jumlah_share'];
}
