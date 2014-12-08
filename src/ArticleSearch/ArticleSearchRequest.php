<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 12/8/14
 * Time: 10:43 AM
 */

namespace NYTimes\ArticleSearch;

use NYTimes\ArticleSearch\Constants\ArticleSearchResponseFormat;
use NYTimes\BaseRequest;

class ArticleSearchRequest extends BaseRequest
{
    public function __construct(
        ArticleSearchQuery $query,
        ArticleSearchResponseFormat $responseFormat,
        $key,
        $URI = 'http://api.nytimes.com/svc/search/v2/articlesearch'
    ) {

        parent::__construct(
            $query,
            $responseFormat,
            $key,
            $URI
        );
    }
} 