<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'imageurl',
        'logo_url',
        'tmdb_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
