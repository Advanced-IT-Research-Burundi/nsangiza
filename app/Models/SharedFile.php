<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_id',
        'shared_by',
        'user_id',
        'access_level',
    ];

    /**
     * Get the file that was shared.
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /**
     * Get the user who shared the file.
     */
    public function sharedBy()
    {
        return $this->belongsTo(User::class, 'shared_by');
    }

    /**
     * Get the user with whom the file was shared.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
