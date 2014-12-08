<?php

namespace NYTimes\Common;

class Date extends \ArrayObject
{
    protected $date;

    public function __construct(
        $year,
        $month,
        $day
    ) {
        /* --- Validation --- */
        $validator = new DateValidator();
        $validator->year($year);
        $validator->month($month);
        $validator->day($day);

        if ($month < 10) {
            $month = '0' . $month;
        }

        if ($day < 10) {
            $day = '0' . $day;
        }

        $this->date = array(
            'year' => $year,
            'month' => $month,
            'day' => $day
        );
    }

    public function __toString()
    {
        return
            $this->date['year'] .
            $this->date['month'] .
            $this['day'];
    }
} 