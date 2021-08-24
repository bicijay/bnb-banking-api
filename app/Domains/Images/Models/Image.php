<?php


namespace App\Domains\Images\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'filename',
        'extension',
        'bytes',
        'filesystem',
        'path',
        'user_id'
    ];
}
