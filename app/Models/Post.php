<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'postes';
    protected $fillable = [
        'description',
        'image_url',
        'user_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];
    public function user()
    {
        return $this->belongsTo('app\Models\User');
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
}
