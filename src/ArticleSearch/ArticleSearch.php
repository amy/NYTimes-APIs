<?php

namespace NYTimes\ArticleSearch;

use NYTimes\ArticleSearch\Fields\FacetFields;
use NYTimes\ArticleSearch\Fields\ReturnedFields;
use NYTimes\BaseRequest;

/**
 * Class ArticleSearch
 *
 * PHP bindings for NYTimes article search API.
 *
 * Reference:
 * <http://developer.nytimes.com/docs/read/article_search_api_v2>
 *
 * @package NYTimes\ArticleSearch
 * @author Amy Chen <ac1084@scarletmail.rutgers.edu>
 */
class ArticleSearch extends BaseRequest
{
    /**
     * ArticleSearch constructor
     *
     * @param string $key
     * @param string $query
     * @param string $responseFormat
     * @param string $URI
     */
    public function __construct(
        $key,
        $query,
        $responseFormat = '.json',
        $URI = 'http://api.nytimes.com/svc/search/v2/articlesearch'
    ) {
        /* --- Exception Handling --- */

        /**
         * @TODO need better way of validating key and query
         */

        if (!is_string($key)) {
            throw new \InvalidArgumentException(
                "The key entered for ArticleSearch was not a string. \n
                You entered: $key"
            );
        }

        if (!is_string($query)) {
            throw new \InvalidArgumentException(
                "The query entered for ArticleSearch was not a string. \n
                You entered: $query"
            );
        }

        if ($responseFormat !== '.json' &&
            $responseFormat !== '.jsonp'
        ) {
            throw new \InvalidArgumentException(
                "The response format entered for ArticleSearch is invalid. \n
                Valid formats are .json, or .jsonp. You entered $responseFormat"
            );
        }

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

        parent::__construct(
            $URI,
            $query,
            $responseFormat,
            $key
        );
    }

    /**
     * Filtered search query
     *
     * Filtered search query using standard Lucene syntax
     * <http://lucene.apache.org/core/2_9_4/queryparsersyntax.html>.
     * The filter query can be specified with or without a limiting "field: label".
     *
     * For more info:
     * <http://developer.nytimes.com/docs/read/article_search_api_v2#filters>
     *
     * @param string $filteredQuery
     *    The filter query
     * @return $this
     */
    public function filteredQuery($filteredQuery)
    {
        /**
         * @TODO need a better way of validating filtered queries
         * @TODO also need to scan for spaces. Spaces will break query
         */

        /*if (!($filteredQuery instanceof FilteredQueryFields)) {
            throw new \InvalidArgumentException("INVALID QUERY");
        }*/

        // build query
        $this->query .= '&fq=' . $filteredQuery;

        return $this;
    }

    /**
     * Filter for responses with given date or later
     *
     * @param int $year
     * @param int $month
     * @param int $date
     * @return $this
     */
    public function beginDate($year, $month, $date)
    {
        /* --- Exception Handling --- */

        $year = filter_var(
            $year,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('Y')
                )
            )
        );

        if ($year === false) {
            throw new \InvalidArgumentException(
                "Invalid year entered for Article beginDate function. \n
                Valid entries include integers between 0 and current year inclusive. \n
                You entered: $year"
            );
        }

        $month = filter_var(
            $month,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('m')
                )
            )
        );

        if ($month === false) {
            throw new \InvalidArgumentException(
                "Invalid month entered for Article beginDate function. \n
                Valid entries include integers between 0 and current month inclusive. \n
                You entered: $month"
            );
        }

        $date = filter_var(
            $date,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('d')
                )
            )
        );

        if ($date === false) {
            throw new \InvalidArgumentException(
                "Invalid date entered for Article beginDate function. \n
                Valid entries include integers between 0 and current day inclusive. \n
                You entered: $date"
            );
        }

        if ($month < 10) {
            $month = '0' . $month;
        }

        if ($date < 10) {
            $date = '0' . $date;
        }

        /* --- Query Building --- */

        $this->query .= "&begin_date={$year}{$month}{$date}";

        return $this;
    }

    /**
     * Filter for responses with given date or earlier
     *
     * @param $year
     * @param $month
     * @param $date
     * @return $this
     */
    public function endDate($year, $month, $date)
    {
        /* --- Exception Handling --- */

        $year = filter_var(
            $year,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('Y')
                )
            )
        );

        if ($year === false) {
            throw new \InvalidArgumentException(
                "Invalid year entered for Article beginDate function. \n
                Valid entries include integers between 0 and current year inclusive. \n
                You entered: $year"
            );
        }

        $month = filter_var(
            $month,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('m')
                )
            )
        );

        if ($month === false) {
            throw new \InvalidArgumentException(
                "Invalid month entered for Article beginDate function. \n
                Valid entries include integers between 0 and current month inclusive. \n
                You entered: $month"
            );
        }

        $date = filter_var(
            $date,
            FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 0,
                    'max_range' => date('d')
                )
            )
        );

        if ($date === false) {
            throw new \InvalidArgumentException(
                "Invalid date entered for ArticleSearch beginDate function. \n
                Valid entries include integers between 0 and current day inclusive. \n
                You entered: $date"
            );
        }

        if ($month < 10) {
            $month = '0' . $month;
        }

        if ($date < 10) {
            $date = '0' . $date;
        }

        /* --- Query Building --- */

        $this->query .= "&end_date={$year}{$month}{$date}";

        return $this;
    }

    /**
     * Sorts responses based on publication date
     *
     * By default, search results are otherwise sorted by their
     * relevance to the query term (q).
     *
     * @param $sort
     * @return $this
     */
    public function sort($sort)
    {
        /* --- Exception Handling --- */

        if ($sort !== 'newest' &&
            $sort !== 'oldest'
        ) {
            throw new \InvalidArgumentException(
                "Invalid sort entered for ArticleSearch sort function. \n
                Valid sorts are 'newest' or 'oldest'. \n
                You entered: $sort"
            );
        }

        /* --- Query Building --- */

        $this->query .= "&sort=$sort";

        return $this;
    }

    /**
     * Limits the fields returned in your search results.
     *
     * @param array $fields
     *    Array of ReturnedFields instances.
     * @return $this
     * @throws \Exception
     *    Exception thrown if fields array elements are not
     *    all of type ReturnedFields
     */
    public function limitFields(array $fields)
    {
        /* --- Exception Handling --- */

        foreach ($fields as $field) {
            if (!($field instanceof ReturnedFields)) {
                throw new \Exception();                         //@TODO MAKE EXCEPTION SPECIFIC!!!!!!!!!!!!!!!!!
            }
        }

        $fieldValues = array_map(
            function($instance) {
                return $instance->value();
            },
            $fields
        );

        /* --- Query Building --- */

        $this->query .= '&fl=' . implode(',', $fieldValues);

        return $this;
    }

    /**
     * Enables/disables highlighting in search results.
     *
     * The query term (q) is highlighted in the headline and
     * lead_paragraph fields.
     *
     * Note: If highlighting is enabled, snippet will be returned
     * even if it is not specified in limitFields $fields array.
     *
     * @param boolean $boolean
     *    True enables highlighting. False disables highlighting.
     * @return $this
     */
    public function highlight($boolean)
    {
        /* --- Exception Handling --- */
        $booleanFinal = filter_var(
            $boolean,
            FILTER_VALIDATE_BOOLEAN,
            FILTER_NULL_ON_FAILURE
        );

        if ($booleanFinal === null) {
            throw new \InvalidArgumentException(
                "Parameter entered for ArticleSearch highlight method was not a boolean value. \n
                Valid entries include true or false. \n
                $boolean entered."
            );
        }

        /* --- Query Building --- */

        $this->query .= "&hl=$booleanFinal";

        return $this;
    }

    /**
     * Returns results in sets of 10.
     *
     * The value of page corresponds to a set of 10 results
     * (it does not indicate the starting number of the result set).
     * For example, page=0 corresponds to records 0-9.
     * To return records 10-19, set page to 1, not 10.
     *
     * @param integer $setOfTen
     * @return $this
     */
    public function page($setOfTen)
    {
        /* --- Exception Handling --- */

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

        /* --- Query Building --- */

        $this->query .= '&page=' . $setOfTen;

        return $this;
    }

    /**
     * Specifies the sets of facet values.
     *
     * Specifies the sets of facet values to include in the facets
     * array at the end of response, which collects the facet values
     * from all the search results. By default no facet fields will be returned.
     *
     * @param array $facets
     * @return $this
     */
    public function addFacets(array $facets)
    {
        /* --- Exception Handling --- */

        $finalFacets = array_map(
            function ($facet) {
                if (!($facet instanceof FacetFields)) {
                    throw new \InvalidArgumentException(
                        "Invalid facet entered for ArticleSearch addFacets method facets array. \n
                        Valid facets are of type FacetFields. \n
                        You entered $facet"
                    );
                }

                return $facet->value();
            },
            $facets
        );

        /* --- Query Building --- */

        $this->query .= '&facet_field=' . implode(',', $finalFacets);

        return $this;
    }

    /**
     * Facet counts will respect any applied filters.
     *
     * Facet counts will respect any applied filters (fq, date range, etc.)
     * in addition to the main query term. To filter facet counts, specifying at
     * least one facet_field is required.
     *
     * @return $this
     */
    public function addFacetFilter()
    {
        /* --- Query Building --- */

        $this->query .= '&facet_filter=true';

        return $this;
    }

    /**
     * The name of the function the API call results will be passed to.
     *
     * Required when using JSONP.
     *
     * @return $this
     */
    public function callback()
    {
        /* --- Query Building --- */

        $this->query .= '&callback=svc_search_v2_articlesearch';

        return $this;
    }
}