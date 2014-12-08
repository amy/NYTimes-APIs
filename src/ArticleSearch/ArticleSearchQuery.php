<?php

namespace NYTimes\ArticleSearch;

use NYTimes\ArticleSearch\Constants\SortField;
use NYTimes\BaseQuery;
use NYTimes\Common\Date;

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
class ArticleSearchQuery extends BaseQuery
{
    protected $query;

    /**
     * ArticleSearch constructor
     *
     * @param string $searchTerm
     */
    public function __construct(
        $searchTerm
    ) {

        /* --- Initialize Validator --- */

        $this->validator = new ArticleSearchValidator();

        /* --- Exception Handling --- */

        $this->validator->searchTerm($searchTerm);

        /* -- Initialize Query -- */

        $this->query = array(
            'q' => $searchTerm,
            'fq' => null,
            'begin_date' => null,
            'end_date' => null,
            'sort' => null,
            'fl' => null,
            'hl' => null,
            'page' => null,
            'facet_field' => null,
            'facet_filter' => null,
            'callback' => null
        );

        parent::__construct($this->query);
    }

    public function __toString()
    {
        //@TODO fix this later to use implode so that I dont need to start off with a value.
        $queryString = $this['q'];

        foreach($this as $description => $value)
        {
            if ($value !== null) {
                $queryString .= "&{$description}={$value}";
            }
        }

        return $queryString;
    }

    public function searchTerm($searchTerm)
    {
        $this['q'] = $searchTerm;

        return $this;
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
        $this['fq'] = $filteredQuery;

        return $this;
    }

    /**
     * Filter for responses with given date or later
     *
     * @param Date $date
     * @return $this
     */
    public function beginDate(Date $date)
    {
        /* --- Query Building --- */

        $this['begin_date'] = $date->__toString();

        return $this;
    }

    /**
     * Filter for responses with given date or earlier
     *
     * @param Date $date
     * @return $this
     */
    public function endDate(Date $date)
    {
        /* --- Exception Handling --- */

        $this['end_date'] = $date->__toString();

        /* --- Query Building --- */

        $this->query = $date;

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
    public function sort(SortField $sort)
    {
        /* --- Query Building --- */

        $this['sort'] = $sort->value();

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
        $this->validator->limitFields($fields);

        /* --- Query Building --- */
        $fieldValues = array_map(
            function($instance) {
                return $instance->value();
            },
            $fields
        );

        //@TODO change to object for toString purposes?
        $this['fl'] = $fieldValues;

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

        $this->validator->highlight($boolean);

        /* --- Query Building --- */

        $this['hl'] = $boolean;

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

        $this->validator->page($setOfTen);

        /* --- Query Building --- */

        $this['page'] = $setOfTen;

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

        $this->validator->addFacets($facets);

        /* --- Query Building --- */

        $finalFacets = array_map(
            function ($facet) {

                return $facet->value();
            },
            $facets
        );

        $this['facet_field'] = $finalFacets;

        return $this;
    }

    /**
     * Facet counts will respect any applied filters.
     *
     * Facet counts will respect any applied filters (fq, date range, etc.)
     * in addition to the main query term. To filter facet counts, specifying at
     * least one facet_field is required.
     *
     * @param boolean $boolean
     * @return $this
     */
    public function addFacetFilter($boolean)
    {
        /* --- Exception Handling --- */

        $this->validator->addFacetsFilter($boolean);

        /* --- Query Building --- */

        $this['facet_filter'] = $boolean;

        return $this;
    }

    /**
     * The name of the function the API call results will be passed to.
     *
     * Required when using JSONP.
     *
     * @param boolean $boolean
     * @return $this
     */
    public function callback($boolean)
    {
        /* --- Exception Handling --- */

        $this->validator->callback($boolean);

        /* --- Query Building --- */

        $this['callback'] = $boolean;

        return $this;
    }
}