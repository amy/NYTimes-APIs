<?php

namespace NYTimes\ArticleSearch;

use NYTimes\BaseRequest;

class ArticleSearch extends BaseRequest
{
    public function __construct(
        $key,
        $query,
        $responseFormat = '.json',
        $URI = 'http://api.nytimes.com/svc/search/v2/articlesearch'
    ) {
        /**
            Check for some errors here!!!!!!!!!!!
         */

        parent::__construct(
            $key,
            $query,
            $responseFormat,
            $URI
        );
    }

    public function filteredQuery($filteredQuery)
    {
        if (!($filteredQuery instanceof FilteredQueryFields)) {
            throw new \InvalidArgumentException("INVALID QUERY");
        }

        $this->query .= '&fq=source:("The New York Times")';

        return $this;
    }
}