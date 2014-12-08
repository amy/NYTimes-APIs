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
        $URI = 'http://api.nytimes.com/svc/search/v2/articlesearch',
        ArticleSearchQuery $query,
        ArticleSearchResponseFormat $responseFormat,
        $key
    ) {

        parent::__construct(
            $URI,
            $query,
            $responseFormat,
            $key
        );
    }
} 