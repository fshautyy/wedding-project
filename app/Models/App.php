<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class App extends Model
{
    use HasFactory;

    protected $table = 'apps';

    protected $fillable = [
        'user_id',
        'app_name',
        'app_slug',
        'app_type',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
