<?php
/**
 * Created by PhpStorm.
 * User: N1xez
 * Date: 25.11.2018
 * Time: 19:50
 */

namespace App\Models\Activities;


use App\Models\BaseModel;

class Activity extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'activities';

    /**
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'assortment_id',
        'color',
        'start_date',
        'finish_date',
        'is_active',
    ];
}