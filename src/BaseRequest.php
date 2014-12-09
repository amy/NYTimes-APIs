<?php

namespace NYTimes;

use Httpful\Request;

/**
 * Class BaseRequest
 *
 * Abstract class for all NYTimes APIs.
 *
 * @package NYTimes
 * @author Amy Chen <ac1084@scarletmail.rutgers.edu>
 */
abstract class BaseRequest extends \ArrayObject
{
    protected $request;

    /**
     * BaseRequest constructor
     *
     * @param $URI
     * @param $query
     * @param $responseFormat
     * @param $key
     */
    public function __construct(
        BaseQuery $query,
        BaseResponseFormat $responseFormat,
        $key,
        $URI
    ) {
        $request = array(
            'URI' => $URI,
            'query' => $query,
            'response format' => $responseFormat,
            'key' => $key,
        );

        parent::__construct($request);
    }

    public function __toString()
    {
        return
            $this['URI'] . '.' .
            $this['response format']->value() . '?' .
            $this['query'] . '&api-key=' .
            $this['key'];
    }

    /**
     * Returns the query in the response format requested.
     * (Ex: json, xml)
     *
     * @return mixed
     *    Query response
     */
    public function query()
    {
        // echo "\n YOUR QUERY \n" . $this->__toString() . "\n END QUERY \n";

        $request = Request::get($this->__toString())
            ->send();

        $response = $request->raw_body;

        var_dump($request);
        return $response;
    }


}
