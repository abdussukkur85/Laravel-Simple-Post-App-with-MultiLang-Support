<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements TranslatableContract {
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['user_id'];

    public function ownedBy(User $user) {
        return $user->id === $this->user_id;
    }
    public function likedBy(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
