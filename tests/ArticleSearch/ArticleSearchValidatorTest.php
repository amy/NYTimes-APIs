<?php

namespace NYTimesTest\ArticleSearch;

//require('./../vendor/autoload.php');

use NYTimes\ArticleSearch\ArticleSearchValidator;
use NYTimesTest\NYTimesTest;

class ArticleSearchValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $ArticleSearchValidator;

    public function setUp()
    {
        $this->ArticleSearchValidator = new ArticleSearchValidator();
    }

    /**
     * URI
     */

    public function URI($input)
    {
        $this->ArticleSearchValidator->URI($input);
    }

    /* --- Expected Input --- */

    public function testURIExpectedTrue()
    {
        $this->URI(
            true
        );
    }

    public function testURIExpectedFalse()
    {
        $this->URI(
            false
        );
    }

    /* --- Unexpected Input --- */

}
 