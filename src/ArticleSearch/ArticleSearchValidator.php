<?php

namespace NYTimes\ArticleSearch;

use NYTimes\ArticleSearch\Constants\FacetFields;
use NYTimes\ArticleSearch\Constants\ReturnedFields;
use NYTimes\Validator;

class ArticleSearchValidator extends Validator
{
    /* --- Private Methods --- */


    /* --- Query --- */

    public function filteredQuery($filteredQuery)
    {

    }

    /* --- URI --- */

    public function URI($URI)
    {
        $URI = filter_var(
            $URI,
            FILTER_VALIDATE_URL
        );

        if ($URI === false) {
            throw new \InvalidArgumentException(
                "The format of the URI entered for ArticleSearch was invalid. \n
                You entered: $URI"
            );
        }
    }

    public function limitFields(array $fields)
    {
        foreach ($fields as $field) {
            if (!($field instanceof ReturnedFields)) {
                throw new \Exception();                         //@TODO MAKE EXCEPTION SPECIFIC!!!!!!!!!!!!!!!!!
            }
        }
    }

    public function highlight($boolean)
    {
        if (!is_bool($boolean)) {
            throw new \InvalidArgumentException(
                "Parameter entered for ArticleSearch highlight method was not a boolean value. \n
                Valid entries include true or false. \n
                $boolean entered."
            );
        }
    }

    public function page($setOfTen)
    {
        $page = filter_var(
            $setOfTen,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0
                )
            )
        );

        if ($page === false) {
            throw new \InvalidArgumentException(
                "Page entered for ArticleSearch page function was invalid. \n
                Valid entries are integers greater than 0. \n
                You entered: $page"
            );
        }
    }

    public function addFacets(array $facets)
    {
        array_map(
            function ($facet) {
                if (!($facet instanceof FacetFields)) {
                    throw new \InvalidArgumentException(
                        "Invalid facet entered for ArticleSearch addFacets method facets array. \n
                        Valid facets are of type FacetFields. \n
                        You entered $facet"
                    );
                }
            },
            $facets
        );
    }

    public function addFacetsFilter($boolean)
    {
        if (!is_bool($boolean))
        {
            throw new \InvalidArgumentException(
                "Parameter entered for ArticleSearch addFacetsFilter method was not a boolean value. \n
                Valid entries include true or false. \n
                $boolean entered."
            );
        }
    }

    public function callback($boolean)
    {
        if (!is_bool($boolean))
        {
            throw new \InvalidArgumentException(
                "Parameter entered for ArticleSearch callback method was not a boolean value. \n
                Valid entries include true or false. \n
                $boolean entered."
            );
        }
    }
}
