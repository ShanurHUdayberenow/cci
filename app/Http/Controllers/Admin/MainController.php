<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use App\Models\Visitor;
use Illuminate\Support\Carbon;
class MainController extends Controller
{
    public function index(){
        $user = auth()->user();

        $users = User::get();

        $news_month = News::whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $news_week = News::whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $news_day = News::whereDate('date', Carbon::today())->count();
       
        $visitors = Visitor::whereDate('updated_at', Carbon::today())->take('100')->get();
        $visitors_month = Visitor::whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $visitors_week = Visitor::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $visitors_day = Visitor::whereDate('updated_at', Carbon::today())->count();

        return view('admin.index', compact('user', 'users','news_month','news_week','news_day','visitors','visitors_month','visitors_week','visitors_day'));
    }

}
