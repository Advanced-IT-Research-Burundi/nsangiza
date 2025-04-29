<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileActivity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_id',
        'user_id',
        'action',
        'details',
    ];

    /**
     * Get the file associated with the activity.
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /**
     * Get the user who performed the action.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the icon for the activity based on the action.
     *
     * @return string
     */
    public function getActivityIconAttribute()
    {
        switch ($this->action) {
            case 'upload':
                return '<i class="fas fa-upload"></i>';
            case 'download':
                return '<i class="fas fa-download"></i>';
            case 'share':
                return '<i class="fas fa-share-alt"></i>';
            case 'view':
                return '<i class="fas fa-eye"></i>';
            case 'edit':
                return '<i class="fas fa-edit"></i>';
            case 'delete':
                return '<i class="fas fa-trash"></i>';
            default:
                return '<i class="fas fa-file"></i>';
        }
    }

    /**
     * Get the icon class for the activity based on the action.
     *
     * @return string
     */
    public function getIconClassAttribute()
    {
        switch ($this->action) {
            case 'upload':
                return 'upload';
            case 'share':
                return 'share';
            case 'download':
                return 'download';
            case 'view':
                return 'view';
            case 'edit':
                return 'edit';
            case 'delete':
                return 'delete';
            default:
                return '';
        }
    }
}
