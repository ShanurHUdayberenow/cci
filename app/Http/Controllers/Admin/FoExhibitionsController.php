<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exhibitions\Foreign\StoreForeignExhibitionRequest;
use App\Http\Requests\Exhibitions\Foreign\UpdateForeignExhibitionRequest;
use App\Models\Foexhibition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoExhibitionsController extends Controller
{
    public function index()
    {
        $fo_exhibitions = Foexhibition::query()
            ->orderBy('start_time')
            ->paginate(15);

        return view('admin.fo_exhibitions.index', compact('fo_exhibitions'));
    }

    public function create()
    {
        return view('admin.fo_exhibitions.create');
    }

    public function store(StoreForeignExhibitionRequest $request): RedirectResponse
    {	
        $data = $request->validated();

        $data['start_time'] = explode(' - ', $data['date'])[0];
        $data['end_time'] = explode(' - ', $data['date'])[1];

        $data['thumbnail'] = Foexhibition::uploadImage($request);
        $data['file'] = Foexhibition::uploadFiles($request);
        $data['file_tk'] = Foexhibition::uploadFilesTk($request);
        $data['file_en'] = Foexhibition::uploadFilesEn($request);

        Foexhibition::create($data);

        return redirect()->route('exhibition.fo_exhibitions.index')->with(
            'success',
            'Новая выставка успешна сохранилась'
        );
    }


    public function edit(Foexhibition $fo_exhibition)
    {
        return view('admin.fo_exhibitions.edit', compact('fo_exhibition'));
    }


    public function update(
        UpdateForeignExhibitionRequest $request,
        Foexhibition $fo_exhibition
    ): RedirectResponse {
        $data = $request->validated();

        $data['start_time'] = explode(' - ', $data['date'])[0];
        $data['end_time'] = explode(' - ', $data['date'])[1];

        if ($file = Foexhibition::uploadImage($request, $fo_exhibition->thumbnail)) {
            $data['thumbnail'] = $file;
        }

        if ($file = Foexhibition::uploadFiles($request, $fo_exhibition->file)) {
            $data['file'] = $file;
        }

        if ($file = Foexhibition::uploadFilesTk($request, $fo_exhibition->file_tk)) {
            $data['file_tk'] = $file;
        }

        if ($file = Foexhibition::uploadFilesEn($request, $fo_exhibition->file_en)) {
            $data['file_en'] = $file;
        }

        $fo_exhibition->update($data);

        $fo_exhibition->touch();

        return redirect()->route('exhibition.fo_exhibitions.index')->with('success', 'Выставка успешна изменена');
    }


    public function destroy(Foexhibition $fo_exhibition): RedirectResponse
    {
        if ($fo_exhibition->thumbnail) {
            Storage::delete($fo_exhibition->thumbnail);
        }
        if ($fo_exhibition->file) {
            Storage::delete($fo_exhibition->file);
        }
        if ($fo_exhibition->file_tk) {
            Storage::delete($fo_exhibition->file_tk);
        }
        if ($fo_exhibition->file_en) {
            Storage::delete($fo_exhibition->file_en);
        }

        $fo_exhibition->delete();

        return redirect()->route('exhibition.fo_exhibitions.index')->with('success', 'Выставка успешна удалена');
    }
}
