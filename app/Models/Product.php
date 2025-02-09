<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

    protected $fillable = [
        'user_id',
        'name',
        'price',
        'stock',
        'description',
        'address',
        'addres_detail',
        'date_info',
        'grade',
        'image',
        'latitude',
        'longitude'
    ];

    protected static function boot()
    {
        parent::boot();

        // Tambahkan event deleting
        static::deleting(function ($product) {
            if ($product->image) {
                // Hapus file gambar dari storage
                Storage::disk('public')->delete('images/' . $product->image);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }
}
