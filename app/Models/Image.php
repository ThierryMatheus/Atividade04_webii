<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'path'
    ];
    protected static function booted()
    {
        static::deleting(function (Image $image) {
            Log::channel('stderr')->info('Evento PostDeleted' . $image->id);
            Storage::disk('public')->delete($image->path);
        });
    }
}
