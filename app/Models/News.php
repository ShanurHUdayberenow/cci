<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use Translatable;
    use Sluggable;

    protected $table = 'news';

    protected $fillable = [
        'publish_at',
        'slug',
        'title',
        'title_en',
        'title_tk',
        'thumbnail',
        'desc',
        'desc_en',
        'desc_tk',
        'date',
    ];

    public static function uploadImage(Request $request, $image = null)
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

    public function getImage()
    {
//        if (!$this->thumbnail) {
            // return asset('no-image.png');
//        }
        return asset("uploads/{$this->thumbnail}");
    }

    public function getUpdatedAtAttribute($value)
    {
        $date = date_create($value);
        return date_format($date, "d.m.Y");
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getNewsDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d.m.Y');
    }
}
