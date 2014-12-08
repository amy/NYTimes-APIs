<?php

namespace NYTimes;

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
        $URI,
        BaseQuery $query,
        BaseResponseFormat $responseFormat,
        $key
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
            $this['response format'] . '?' .
            $this->request['query']->__toString() .
            '&api-key=' . $this->key;
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
        //echo "\n YOUR QUERY \n" . $string . "\n END QUERY \n";

        // Get cURL resource
        $curl = curl_init();

        // Set some options - we are passing in a useragent too here
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $this->__toString()
            )
        );

        // Send the request & save response to $resp
        $response = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);

        return $response;
    }


} 