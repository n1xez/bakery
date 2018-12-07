<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Activities\Activity;

class ActivityController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $start_date = $request->get('start_date');
        $finish_date = $request->get('finish_date');


        $startDate = $this->getStartOfDay($start_date);
        $finishDate  = $this->getEndOfDay($finish_date);
        $finishStatement = $finish_date
            ? "COALESCE(if(unix_timestamp(finish_date) < unix_timestamp('$finishDate'), unix_timestamp(finish_date), unix_timestamp('$finishDate')), unix_timestamp())"
            : "COALESCE(unix_timestamp(finish_date), unix_timestamp())";
        $startStatement = $start_date
            ? "if(unix_timestamp(start_date) > unix_timestamp('$startDate'), unix_timestamp(start_date), unix_timestamp('$startDate'))"
            : "unix_timestamp(start_date)";
        $rawQuery = "sum($finishStatement - $startStatement) as seconds";

        $query = Activity::groupBy('assortment_id')
            ->groupBy('color')
            ->with('assortment')
            ->selectRaw("assortment_id, color, $rawQuery");

        $shop_id = $request->get('shop_id');
        if ($shop_id) {
            $query->whereHas('assortment', function ($subQuery) use ($shop_id) {
                $subQuery->where('shop_id', $shop_id);
            });
        }

        if ($start_date) {
            $query->where('start_date', '>', $startDate);
        }

        if ($finish_date) {
            $query->where('start_date', '<', $finishDate);
        }

        $query->orderBy('seconds', 'DESC');
        $activities = $query->get();

        $activities->map(function ($activity) {
            $activity->time = $this->calculateTime($activity->seconds);
        });

        return view('activities.index', compact('activities', 'shop_id', 'start_date', 'finish_date'));
    }

    /**
     * @param $startDay
     * @return null|string
     */
    private function getStartOfDay($startDay)
    {
        return $startDay ? (new Carbon($startDay))->startOfDay()->toDateTimeString() : null;
    }

    /**
     * @param $endDay
     * @return null|string
     */
    private function getEndOfDay($endDay)
    {
        return $endDay ? (new Carbon($endDay))->endOfDay()->toDateTimeString() : null;
    }

    /**
     * @param $time
     * @return string
     */
    private function calculateTime($time)
    {
        $hours = floor($time / 3600);
        $minutes = floor($time / 60 % 60);
        $seconds = $time % 60;
        return sprintf("%s:%02d:%02d", $hours, $minutes, $seconds);
    }
}