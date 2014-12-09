<?php
require('./vendor/autoload.php');

use NYTimes\ArticleSearch\ArticleSearchQuery;
use NYTimes\ArticleSearch\ArticleSearchRequest;
use NYTimes\ArticleSearch\Constants\ArticleSearchResponseFormat;
use NYTimes\ArticleSearch\Constants\SortField;

$query = new ArticleSearchQuery('tests');

$query
    ->page(1)
    ->sort(SortField::NEWEST());

$request = new ArticleSearchRequest(
    $query,
    ArticleSearchResponseFormat::JSON(),
    'your key'
);

$json = $request->query();
var_dump($json);