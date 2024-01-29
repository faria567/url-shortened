<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'shortened_url'];

    /**
     * Get the user that owns the URL.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique shortened URL key.
     *
     * @return string
     */
    public static function generateShortUrlKey()
    {
        // Generate a unique 6-digit key
        $key = substr(md5(uniqid()), 0, 6);

        // Check if the key already exists, regenerating if necessary
        while (static::where('shortened_url', $key)->exists()) {
            $key = substr(md5(uniqid()), 0, 6);
        }

        return $key;
    }
}
