<?php

namespace App\Http\Controllers;

use App\Models\Foexhibition;
use App\Models\Tmexhibition;

class ExhibitionsController extends Controller
{
    public function tmExhibition()
    {
        $title = __('main.controllers.tm_ex');

        $tm_ex = Tmexhibition::orderBy('number','asc')->paginate(10);

        return view('org.tm_exhibition', compact('tm_ex', 'title'));
    }

    public function foExhibition()
    {
        $title = __('main.controllers.fo_ex');

        $fo_ex = Foexhibition::query()
  //          ->orderBy('start_time')
            ->orderByDesc('id')
            ->paginate(10);

        return view('org.fo_exhibition', compact('fo_ex', 'title'));
    }
}
