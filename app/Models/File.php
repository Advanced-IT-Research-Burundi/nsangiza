<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'path',
        'type',
        'size',
    ];

    /**
     * Get the user that owns the file.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shared file records for this file.
     */
    public function sharedFiles()
    {
        return $this->hasMany(SharedFile::class);
    }

    /**
     * Get all activities for this file.
     */
    public function activities()
    {
        return $this->hasMany(FileActivity::class);
    }

    /**
     * Get formatted file size.
     *
     * @return string
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get the file icon based on file type.
     *
     * @return string
     */
    public function getFileIconAttribute()
    {
        $type = strtolower($this->type);

        if (in_array($type, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])) {
            return 'fas fa-file-image';
        } elseif (in_array($type, ['doc', 'docx', 'odt', 'rtf'])) {
            return 'fas fa-file-word';
        } elseif (in_array($type, ['xls', 'xlsx', 'ods'])) {
            return 'fas fa-file-excel';
        } elseif (in_array($type, ['pdf'])) {
            return 'fas fa-file-pdf';
        } elseif (in_array($type, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm'])) {
            return 'fas fa-file-video';
        } elseif (in_array($type, ['mp3', 'wav', 'ogg', 'flac'])) {
            return 'fas fa-file-audio';
        } elseif (in_array($type, ['zip', 'rar', '7z', 'tar', 'gz'])) {
            return 'fas fa-file-archive';
        } elseif (in_array($type, ['html', 'css', 'js', 'php', 'py', 'java', 'c', 'cpp', 'cs', 'rb', 'go', 'ts', 'jsx', 'vue'])) {
            return 'fas fa-file-code';
        } else {
            return 'fas fa-file';
        }
    }

    /**
     * Get the file icon class based on file type.
     *
     * @return string
     */
    public function getIconClassAttribute()
    {
        $type = strtolower($this->type);

        if (in_array($type, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])) {
            return 'image';
        } elseif (in_array($type, ['doc', 'docx', 'odt', 'rtf'])) {
            return 'document';
        } elseif (in_array($type, ['xls', 'xlsx', 'ods'])) {
            return 'excel';
        } elseif (in_array($type, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm'])) {
            return 'video';
        } elseif (in_array($type, ['html', 'css', 'js', 'php', 'py', 'java', 'c', 'cpp', 'cs', 'rb', 'go', 'ts', 'jsx', 'vue'])) {
            return 'code';
        } else {
            return '';
        }
    }
}
