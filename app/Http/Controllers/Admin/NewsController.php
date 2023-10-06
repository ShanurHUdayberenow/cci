<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsStoreRequest;
use App\Http\Requests\News\NewsUpdateRequest;
use App\Models\News;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderByDesc('publish_at')->paginate(16);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(NewsStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['thumbnail'] = News::uploadImage($request);

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Новость успешна сохранилась');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(NewsUpdateRequest $request, News $news): RedirectResponse
    {
        $data = $request->validated();

        if ($file = News::uploadImage($request, $news->thumbnail)) {
            $data['thumbnail'] = $file;
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Новость успещна изменена');
    }

    public function destroy($id)
    {
        $news = News::find($id);

        Storage::delete($news->thumbnail);

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Новость успешна удалена');
    }
}
