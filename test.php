<?php
require('./vendor/autoload.php');

use NYTimes\ArticleSearch\ArticleSearchQuery;
use NYTimes\ArticleSearch\ArticleSearchRequest;
use NYTimes\ArticleSearch\Constants\ArticleSearchResponseFormat;

$query = new ArticleSearchQuery('test');
$request = new ArticleSearchRequest(
    $query,
    ArticleSearchResponseFormat::JSON(),
    '215e4381f56e8143a7ebfcf71cc47f96:17:70278005'
);

var_dump($request->query());