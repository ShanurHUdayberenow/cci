<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use App\Models\News;
use Illuminate\Http\Request;

class ConferencesController extends Controller
{
    public function index()
    {
        $conferences = Conference::paginate(10);

        return view('admin.conferences.index', compact('conferences'));
    }

    public function single($id)
    {
        $conference = Conference::find($id);
        return view('admin.conferences.single', compact('conference'));
    }

    public function create()
    {
        return view('admin.conferences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|min:3|max:255',
            'name_en'    => 'required|string|min:3|max:255',
            'name_tk'    => 'required|string|min:3|max:255',
            'title'      => 'nullable|string|min:3|max:255',
            'title_en'   => 'nullable|string|min:3|max:255',
            'title_tk'   => 'nullable|string|min:3|max:255',
            'desc'       => 'nullable|string|min:3',
            'desc_en'    => 'nullable|string|min:3',
            'desc_tk'    => 'nullable|string|min:3',
            'date'       => 'nullable|string|min:5|max:255',
            'image'      => 'nullable|image',
        ]);

        $validated['image'] = Conference::uploadImage($request);

        Conference::create($validated);

        return redirect()->route('conferences.index')
            ->with('success', 'Новая страница в "конференции" успешно создана');
    }

    public function edit($id)
    {
        $conference = Conference::find($id);

        return view('admin.conferences.edit', compact('conference'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'       => 'required|string|min:3|max:255',
            'name_en'    => 'required|string|min:3|max:255',
            'name_tk'    => 'required|string|min:3|max:255',
            'title'      => 'required|string|min:3|max:255',
            'title_en'   => 'nullable|string|min:3|max:255',
            'title_tk'   => 'nullable|string|min:3|max:255',
            'desc'       => 'nullable|string|min:3',
            'desc_en'    => 'nullable|string|min:3',
            'desc_tk'    => 'nullable|string|min:3',
            'date'       => 'nullable|string|min:5|max:255',
            'image'      => 'nullable|image'
        ]);

        $conference = Conference::findOrFail($id);

        if ($file = Conference::uploadImage($request, $conference->image)) {
            $validated['image'] = $file;
        }

        $conference->update($validated);

        return redirect()->route('conferences.index')
            ->with('success', 'Страница в "конференции" успешно изменён');
    }

    public function destroy($id)
    {
        $conference = Conference::find($id);

        $conference->delete();

        return redirect()->route('conferences.index')
            ->with('success', 'Страница в "конференции" успещно удалена');
    }
}
