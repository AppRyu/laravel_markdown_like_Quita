<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function google_calendar() {

        $events = Event::get(); // 未来の全イベントを取得する

        foreach ($events as $event) {

            dump(
                $event->id, // カレンダーID
                $event->name, // タイトル
                $event->description, // 説明文
                $event->startDateTime, // 開始日時
                $event->endDateTime // 終了日時
            );

        }

    }

    public function google_calendar_start_at() {
        $start_dt = new Carbon('2021-02-08');
        $end_dt = new Carbon('2021-02-09');
        $events = Event::get($start_dt, $end_dt);
        foreach($events as $event) {
            dump(
                $event->id, // カレンダーID
                $event->name, // タイトル
            );
        }
    }
}
