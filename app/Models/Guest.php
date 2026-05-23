<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'guests';

    protected $primaryKey = 'id';

    const UPDATED_AT = null;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'company',
        'message',
        'photo_url',
    ];
}
