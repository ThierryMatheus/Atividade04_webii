<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'board', 'model',
    ];
    // protected static function booted()
    // {
    //     static::deleting(function (Vehicle $vehicle) {
    //         Log::channel('stderr')->info('Evento VehicleDelete' . $vehicle->id);
    //         Storage::disk('public')->delete($vehicle->image->path);
    //     });
    // }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }
}
