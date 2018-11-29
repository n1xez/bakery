<?php

namespace App\Http\Controllers;

use App\Models\Activities\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Activity::groupBy('assortment_id')
            ->groupBy('color')
            ->with('assortment')
            ->selectRaw('assortment_id, color, sum(COALESCE(unix_timestamp(finish_date), unix_timestamp()) - unix_timestamp(start_date)) as time');

        $shop_id = $request->get('shop_id');
        if ($shop_id) {
            $query->whereHas('assortment', function ($subQuery) use ($shop_id) {
                $subQuery->where('shop_id', $shop_id);
            });
        }

        $start_date = $request->get('start_date');
        if ($start_date) {
            $query->where('start_date', '>', $start_date);
        }

        $finish_date = $request->get('finish_date');
        if ($finish_date) {
            $query->where('start_date', '<', $finish_date);
        }

        $activities = $query->get();

        $activities->map(function ($activity) {
            $activity->time = $this->calculateTime($activity->time);
        });

        return view('activities.index', compact('activities', 'shop_id', 'start_date', 'finish_date'));
    }

    /**
     * @param $time
     * @return string
     */
    private function calculateTime($time)
    {
        $hours = floor($time / 3600);
        $minutes = floor($time / 3600) % 60;
        $seconds = $time % 60;
        return sprintf("%s:%02d:%02d", $hours, $minutes, $seconds);
    }
}