<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements TranslatableContract {
    use HasFactory;
    use Translatable;
    protected $guarder = ['id'];
    public $translatedAttributes = ['title', 'description'];
    // protected $fillable = ['user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
