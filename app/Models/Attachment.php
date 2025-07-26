<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    const NO_IMAGE = '/v1/dash/assets/images/no-photo.png';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function extension_image()
    {
        return '/assets/v1/dashboard/media/svg/files/' . $this->extension . '.svg';
    }

    public function link()
    {
        return response()->download(base_path() . '/storage/app/public/' . $this->path);
    }

    public function stream()
    {
        return Storage::url($this->path);
    }

    public function formattedSize(string $type = 'auto', int $precision = 2): string
    {
        $bytes = $this->filesize; // Assuming you have a `size` column in bytes

        if (!is_numeric($bytes)) {
            return 'N/A';
        }

        switch (strtolower($type)) {
            case 'b':
                return $bytes . ' B';
            case 'kb':
                return round($bytes / 1024, $precision) . ' KB';
            case 'mb':
                return round($bytes / 1048576, $precision) . ' MB';
            case 'gb':
                return round($bytes / 1073741824, $precision) . ' GB';
            case 'auto':
            default:
                if ($bytes < 1024) {
                    return $bytes . ' B';
                } elseif ($bytes < 1048576) {
                    return round($bytes / 1024, $precision) . ' KB';
                } elseif ($bytes < 1073741824) {
                    return round($bytes / 1048576, $precision) . ' MB';
                } else {
                    return round($bytes / 1073741824, $precision) . ' GB';
                }
        }
    }

    public function users()
    {
        $this->belongsToMany(User::class, 'attachment_users');
    }
}
