<?php

namespace App\Http\Controllers\BizInfo;

use App\Http\Controllers\Controller;
use App\Models\Tmoffer;

class TmOffersController extends Controller
{
    public function __invoke()
    {
        $title = __('main.controllers.tm_offers');
        $tm_offers = Tmoffer::orderByDesc('id')->paginate(5);
        return view('org.biz_info.tm-offers', compact('tm_offers', 'title'));
    }
}
