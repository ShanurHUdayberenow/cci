<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Branch;
use App\Models\Carousel;
use App\Models\Conference;
use App\Models\Gallery;
use App\Models\Membership;
use App\Models\News;
use App\Models\NewsCci;
use App\Models\Partner;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Cookie;
use App\Models\Visitor;
use Stevebauman\Location\Facades\Location;
class MainController extends Controller
{
    public function index()
    {
        $this->addVisitor();
        $running = News::orderByDesc('publish_at')
            ->get()
            ->take('5');

        $news = News::orderByDesc('publish_at')
            ->get()
            ->take('3');

        $newsCci = NewsCci::orderByDesc('publish_at')
            ->get()
            ->take('3');

        $galleries = Gallery::get();

        $partners = Partner::select(['thumbnail', 'is_show','web'])
            ->get();

        $banner = Banner::get();

        $carousels = Carousel::get();

        $title = __('main.controllers.main');

  


        return view('org.home', compact('news', 'newsCci', 'galleries', 'partners', 'banner', 'carousels', 'title', 'running'));
    }

    public function branch($slug)
    {
        $branch = Branch::where('slug', $slug)
            ->firstOrFail();

        $title = $branch->__('name') . ' | ' . __('main.cci');

        return view('org.branch_single', compact('branch', 'title'));
    }

    public function album($slug)
    {
        $gallery = Gallery::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $album = Str::of($gallery->album)
            ->explode(',');

        $title = __('main.controllers.album');

        return view('org.album', compact('gallery', 'album', 'title'));
    }

    public function membership($slug)
    {
        $membership = Membership::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $title = __('main.controllers.membership');

        return view('org.membership', compact('membership', 'title'));
    }

    public function conferences()
    {

        $conferences = Conference::paginate('16');

        $title = __('main.controllers.conf');

        return view('org.conferences', compact('conferences','title'));
    }

    public function changeLocale($locale)
    {
        session(['locale' => $locale]);

        App::setLocale($locale);

        return redirect()->back();
    }

    public function addVisitor() {
        $visitor = Visitor::where('ip', $_SERVER['REMOTE_ADDR'])->first();
        if ($visitor) {
            if (session('visited') === null) {
                $visitor->update(['visitCount' => $visitor->visitCount + 1]);
                session(['visited'=> true]);
            }
        } else {
            Visitor::create(['ip' => $_SERVER['REMOTE_ADDR'], 'visitCount' => '1']);
            session(['visited'=>true]);
        }
    }
}
