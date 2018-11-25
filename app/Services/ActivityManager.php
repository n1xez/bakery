<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Activities\Activity;
use App\Models\Assortments\Assortment;

class ActivityManager
{
    /**
     * @var Activity
     */
    private $activity;

    /**
     * @var Assortment
     */
    private $assortment;

    /**
     * ActivityManager constructor.
     * @param Activity $activity
     * @param Assortment $assortment
     */
    public function __construct(Activity $activity, Assortment $assortment)
    {
        $this->activity = $activity;
        $this->assortment = $assortment;
    }

    /**
     *
     */
    public function calculate()
    {
        $currentActivities = $this->getAllActive();
        $problemAssortment = $this->getAllProblemAssortment();

        $this->closeAllWithoutProblem($currentActivities, $problemAssortment);
        $this->checkAssortment($currentActivities, $problemAssortment);
    }

    /**
     * Return activities
     */
    private function getAllActive()
    {
        return $this->activity->where('is_active', true)->get();
    }

    /**
     * Return problem assortment
     */
    private function getAllProblemAssortment()
    {
        return $this->assortment
            ->whereColumn('quantity', '>', 'yellow_quantity')
            ->orWhereColumn('quantity', '>', 'warning_quantity')
            ->get();
    }

    /**
     * @param $currentActivities
     * @param $problemAssortment
     */
    private function closeAllWithoutProblem($currentActivities, $problemAssortment)
    {
        $activitiesForClosing = $currentActivities->expect($problemAssortment->pluck('id'));
        foreach ($activitiesForClosing as $activity) {
            $this->activityFinish($activity);
        }
    }

    /**
     * @param $currentActivities
     * @param $problemAssortment
     */
    private function checkAssortment($currentActivities, $problemAssortment)
    {
        foreach ($problemAssortment as $assortment) {
            $activity = $currentActivities->where('assortment_id', $assortment->id)->first();
            if ($activity) {
                if ($activity->color != $assortment->warningColor) {
                    $this->activityFinish($activity);
                    $this->createActivity($assortment);
                }
            } else {
                $this->createActivity($assortment);
            }
        }
    }

    /**
     * @param $activity
     */
    private function activityFinish($activity)
    {
        $activity->update([
            'is_active' => false,
            'finish_date' => Carbon::now(),
        ]);
    }

    /**
     * @param $assortment
     */
    private function createActivity($assortment)
    {
        $this->activity->create([
            'assortment_id' => $assortment->id,
            'color' => $assortment->warningColor,
            'start_date' => Carbon::now(),
        ]);
    }
}