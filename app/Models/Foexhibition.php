<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Foexhibition extends Model
{
    use Translatable;

    protected $fillable = [
        'title',
        'title_en',
        'title_tk',
        'start_time',
        'end_time',
        'thumbnail',
//        'date',
        'file',
        'file_tk',
        'file_en',
    ];

    protected $casts = [
        'start_time' => 'date:d.m.Y',
        'end_time' => 'date:d.m.Y',
    ];

    public static function uploadImage(Request $request, $image = null): bool|string|null
    {
        if ($request->hasFile('thumbnail')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('thumbnail')->store("images/{$folder}");
        }
        return null;
    }

    public static function uploadFiles(Request $request, $file = null): bool|string|null
    {
        if ($request->hasFile('file')) {
            if ($file) {
                Storage::delete($file);
            }
            $folder = date('Y-m-d');
            return $request->file('file')->store("file/{$folder}");
        }
        return null;
    }

    public static function uploadFilesTk(Request $request, $file = null): bool|string|null
    {
        if ($request->hasFile('file_tk')) {
            if ($file) {
                Storage::delete($file);
            }
            $folder = date('Y-m-d');
            return $request->file('file_tk')->store("file/{$folder}");
        }
        return null;
    }

    public static function uploadFilesEn(Request $request, $file = null): bool|string|null
    {
        if ($request->hasFile('file_en')) {
            if ($file) {
                Storage::delete($file);
            }
            $folder = date('Y-m-d');
            return $request->file('file_en')->store("file/{$folder}");
        }
        return null;
    }

    public function getImage(): string
    {
        if (!$this->thumbnail) {
            return asset('no-image.jpg');
        }
        return asset("uploads/{$this->thumbnail}");
    }

    public function getFile(): string
    {
        return asset("uploads/{$this->file}");
    }

    public function getStartEndTimes(): string
    {
        $startTime = $this->start_time?->format('d.m.Y') ?? now()->format('d.m.Y');
        $endTime = $this->end_time?->format('d.m.Y') ?? now()->format('d.m.Y');

        return implode(' - ', [$startTime, $endTime]);
    }
}
