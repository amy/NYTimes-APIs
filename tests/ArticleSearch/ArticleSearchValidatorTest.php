<?php

namespace NYTimesTest\ArticleSearch;

require('vendor/autoload.php');

use NYTimes\ArticleSearch\ArticleSearchValidator;
use NYTimes\ArticleSearch\Constants\FacetFields;
use NYTimes\ArticleSearch\Constants\ReturnedFields;
use NYTimesTest\NYTimesTest;

class ArticleSearchValidatorTest extends NYTimesTest
{
    protected $ArticleSearchValidator;

    public function setUp()
    {
        $this->ArticleSearchValidator = new ArticleSearchValidator();
    }

    /**
     * Filtered Query
     */

    /**
     * URI
     */

    public function URI($input)
    {
        $this->ArticleSearchValidator->URI($input);
    }

    /* --- Expected Input --- */

    public function testURIExpected()
    {
        $this->URI(
            'https://www.facebook.com/groups/LadiesStormHackathons/'
        );
    }

    /* --- Unexpected Input --- */
    public function testURIUnexpectedBoolean()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->URI(false);
    }

    public function testURIUnexpectedInteger()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->URI(100);
    }

    public function testURIUnexpectedString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->URI('unexpected input');
    }

    /**
     * Limit Fields
     */

    public function limitFields($input)
    {
        $this->ArticleSearchValidator->limitFields($input);
    }

    /* --- Expected Input --- */

    public function testLimitFieldsExpected()
    {
        $input = array(
            ReturnedFields::_ABSTRACT(),
            ReturnedFields::_BLOG()
        );

        $this->limitFields($input);
    }

    /* --- Unexpected Input --- */

    public function testLimitFiledsUnexpectedInteger()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $input = array(
            100
        );

        $this->limitFields($input);
    }

    public function testLimitFiledsUnexpectedBoolean()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $input = array(
            true
        );

        $this->limitFields($input);
    }

    public function testLimitFiledsUnexpectedString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $input = array(
            'unexpected value'
        );

        $this->limitFields($input);
    }

    /**
     * Highlight
     */

    public function highlight($input)
    {
        $this->ArticleSearchValidator->highlight($input);
    }

    /* --- Expected Input --- */

    public function testHighlightExpectedTrue()
    {
        $this->highlight(true);
    }

    public function testHighlightExpectedFalse()
    {
        $this->highlight(false);
    }

    /* --- Unexpected Input --- */

    public function testHighlightUnexpectedNull()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->highlight(null);
    }

    public function testHighlightUnexpectedInteger()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->highlight(100);
    }

    public function testHighlightUnexpectedString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->highlight('invalid input');
    }

    /**
     * Page
     */

    public function page($input)
    {
        $this->ArticleSearchValidator->page($input);
    }

    /* --- Expected Input --- */

    public function testPageExpectedInteger()
    {
        $this->page(0);
    }

    /* --- Unexpected Input --- */

    public function testPageUnexpectedNegativeInteger()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->page(-1);
    }

    public function testPageUnexpectedFloat()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->page(1.3);
    }

    public function testPageUnexpectedBoolean()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->page(true);
    }

    public function testPageUnexpectedString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->page('invalid input');
    }

    /**
     * Add Facets
     */

    public function addFacets($input)
    {
        $this->ArticleSearchValidator->addFacets($input);
    }

    /* --- Expected Input --- */

    public function testAddFacetsExpectedArray()
    {
        $this->addFacets(
            array(
                FacetFields::DAY_OF_WEEK(),
                FacetFields::DOCUMENT_TYPE()
            )
        );
    }

    /* --- Unexpected Input --- */

    public function testAddFacetsUnexpectedBoolean()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->addFacets(
            array(
                true
            )
        );
    }

    public function testAddFacetsUnexpectedString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->addFacets(
            array(
                'invalid input'
            )
        );
    }

    public function testFacetsUnexpectedInteger()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->addFacets(
            array(
                100
            )
        );
    }

    /**
     * Add Facets Filter
     */

    public function addFacetsFilter($input)
    {
        $this->ArticleSearchValidator->addFacetsFilter($input);
    }

    /* --- Expected Input --- */

    public function testAddFacetsFilterExpectedTrue()
    {
        $this->addFacetsFilter(true);
    }

    public function testAddFacetsFilterExpectedFalse()
    {
        $this->addFacetsFilter(false);
    }

    /* --- Unexpected Input --- */

    public function testAddFacetsFilterUnexpectedNull()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->addFacetsFilter(null);
    }

    public function testAddFacetsFilterUnexpectedString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->addFacetsFilter('Invalid Input');
    }

    public function testAddFacetsFilterUnexpectedInteger()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->addFacetsFilter(100);
    }

    /**
     * Callback
     */

    public function callback1($input)
    {
        $this->ArticleSearchValidator->callback($input);
    }

    /* --- Expected Input --- */

    public function testCallbackExpectedTrue()
    {
        $this->callback1(true);
    }

    public function testCallbackExpectedFalse()
    {
        $this->callback1(false);
    }

    /* --- Unexpected Input --- */

    public function testCallbackUnExpectedNull()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->callback1(null);
    }

    public function testCallbackUnExpectedString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->callback1('Invalid Input');
    }

    public function testCallbackUnExpectedInteger()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->callback1(100);
    }
}
 