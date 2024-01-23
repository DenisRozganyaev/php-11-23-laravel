<?php

namespace App\Models;

use App\Services\Contract\FileStorageServiceContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'imageable_id', 'imageable_type'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function() {
                if (Storage::has($this->attributes['path'])) {
                    return Storage::url($this->attributes['path']);
                }

                return $this->attributes['path'];
            }
        );
    }

    public function setPathAttribute($path)
    {
        $this->attributes['path'] = app(FileStorageServiceContract::class)->upload(
            $path['image'],
            $path['directory'] ?? null
        );
    }
}
