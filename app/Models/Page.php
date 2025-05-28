<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo', 'mail_id', 'contact', 'banner_image', 'header', 'text', 'address', 'status'
    ];
}