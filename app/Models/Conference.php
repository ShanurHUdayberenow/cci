<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Conference extends Model
{
    use Translatable;
    use Sluggable;

    protected $fillable = [
        'slug',
        'name',
        'name_en',
        'name_tk',
        'title',
        'title_en',
        'title_tk',
        'desc',
        'desc_en',
        'desc_tk',
        'content',
        'content_en',
        'content_tk',
        'date',
        'image',
    ];

    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('image')) {
            if ($image) {
                Storage::delete($image);
            }

            $folder = date('Y-m-d');

            return $request->file('image')
                ->store("images/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
//        if (!$this->thumbnail) {
            // return asset('no-image.png');
//        }
        return asset("uploads/{$this->image}");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
