<?php

require "./vendor/autoload.php";
use NYTimes\ArticleSearch\ArticleSearch;

$search = new ArticleSearch(
    "215e4381f56e8143a7ebfcf71cc47f96:17:70278005", // key
    "stupid"                                      // query
);

echo "TEST QUERY DUMP: \n";
print_r(
    $search
        ->filteredQuery('source:("The%20New%20York%20Times")')
        ->beginDate(2013, 12, 20)
        ->query()
);