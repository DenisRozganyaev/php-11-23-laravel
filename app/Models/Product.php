<?php

namespace App\Models;

use App\Services\Contract\FileStorageServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['slug', 'title', 'description', 'SKU', 'price', 'new_price', 'quantity', 'thumbnail'];

    public $sortable = ['id', 'title', 'SKU', 'price', 'quantity'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function followers():BelongsToMany
    {
        return $this->belongsToMany(
          User::class,
          'wish_list',
          'product_id',
          'user_id'
        );
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('quantity', '>', 0);
    }

    public function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function() {
                if (Storage::has($this->attributes['thumbnail'])) {
                    return Storage::url($this->attributes['thumbnail']);
                }

                return $this->attributes['thumbnail'];
            }
        );
    }

    public function setThumbnailAttribute($image)
    {
        $fileStorage = app(FileStorageServiceContract::class);

        if (!empty($this->attributes['thumbnail'])) {
            $fileStorage->remove($this->attributes['thumbnail']);
        }

        // public/iphone/____.jpeg
        $this->attributes['thumbnail'] = $fileStorage->upload(
            $image,
            $this->attributes['slug']
        );
    }

    public function finalPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => round(($this->attributes['new_price'] && $this->attributes['new_price'] > 0 ? $this->attributes['new_price'] : $this->attributes['price']), 2)
        );
    }

    public function discount(): Attribute
    {
        return Attribute::make(
            get: function() {
                if (!$this->attributes['new_price'] || $this->attributes['new_price'] === 0) {
                    return null;
                }
                $result = ($this->attributes['price'] - $this->attributes['new_price']) / ($this->attributes['price'] / 100);

                return round($result, 2);
            }
        );
    }

    public function isExists(): Attribute
    {
        return Attribute::get(fn() => $this->attributes['quantity'] > 0);
    }
}
