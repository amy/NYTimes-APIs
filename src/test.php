<?php
namespace NYTimes;

require "../vendor/autoload.php";
use NYTimes\ArticleSearch\ArticleSearch;

$search = new ArticleSearch(
    "&215e4381f56e8143a7ebfcf71cc47f96:17:70278005", // key
    "q=stupid"                                      // query
);

$search->query();