<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 12/6/14
 * Time: 2:39 AM
 */

namespace NYTimes;

class NYTimesException extends \Exception
{
    protected $exception;

    public function __construct($exception = "NYTimes exception thrown")
    {
        $this->exception = $exception;
        parent::__construct($exception);
    }
} 