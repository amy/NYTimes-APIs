<?php

namespace NYTimesTest\ArticleSearch;

use NYTimes\ArticleSearch\ArticleSearchQuery;
use NYTimes\ArticleSearch\ArticleSearchRequest;
use NYTimes\ArticleSearch\Constants\ArticleSearchResponseFormat;

class ArticleSearchRequestTest extends \PHPUnit_Framework_TestCase
{
    protected $request;
    protected $query;
    protected $format;
    protected $key;
    protected $URI;

    public function setUp()
    {
        $this->query = new ArticleSearchQuery('test');
        $this->format = ArticleSearchResponseFormat::JSON();
        $this->key = 'test_key';
        $this->URI = 'http://api.nytimes.com/svc/search/v2/articlesearch';

        $this->request = new ArticleSearchRequest(
            $this->query,
            $this->format,
            $this->key,
            $this->URI
        );
    }

    /**
     * Test ArticleSearchRequest Instantiation
     */

    public function testConstruct()
    {
        $this->assertInstanceOf(
            'NYTimes\ArticleSearch\ArticleSearchRequest',
            $this->request
        );
    }

    public function testToString()
    {
        $expected =
            $this->URI . '.' .
            $this->format->value() . '?' .
            $this->query . '&api-key=' .
            $this->key;

        $actual = $this->request->__toString();

        $this->assertSame(
            $expected,
            $actual
        );
    }
/*
    public function testQuery()
    {
        
    }
*/
}
 
