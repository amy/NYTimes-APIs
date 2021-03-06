<?php

namespace NYTimes\Common;

use NYTimes\Validator;

class DateValidator extends Validator
{
    /* --- Date --- */

    public function year($year)
    {
        $year = filter_var(
            $year,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('Y')
                )
            )
        );

        if ($year === false) {
            throw new \InvalidArgumentException(
                "Invalid year entered. \n
                Valid entries include integers between 0 and current year inclusive. \n
                You entered: $year"
            );
        }
    }

    public function month($month)
    {
        $month = filter_var(
            $month,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('m')
                )
            )
        );

        if ($month === false) {
            throw new \InvalidArgumentException(
                "Invalid month entered for Article beginDate function. \n
                Valid entries include integers between 0 and current month inclusive. \n
                You entered: $month"
            );
        }
    }

    public function day($day)
    {
        $day = filter_var(
            $day,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('d')
                )
            )
        );

        if ($day === false) {
            throw new \InvalidArgumentException(
                "Invalid date entered for Article beginDate function. \n
                Valid entries include integers between 0 and current day inclusive. \n
                You entered: $day"
            );
        }
    }
} 