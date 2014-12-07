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
abstract class BaseRequest
{
    protected $URI;
    protected $query;
    protected $responseFormat;
    protected $key;

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
        $query,
        $responseFormat,
        $key
    ) {
        $this->URI = $URI;
        $this->query = $query;
        $this->responseFormat = $responseFormat;
        $this->key = $key;
    }

    /**
     * Returns the query in the response format requested.
     * (Ex: json, xml)
     *
     * @return mixed
     *    Query response
     */
    public function query($newQuery = null)
    {
        if ($newQuery !== null) {
            $this->query = $newQuery;
        }

        $string = "{$this->URI}{$this->responseFormat}?q={$this->query}&api-key={$this->key}";
        echo "\n YOUR QUERY \n" . $string . "\n END QUERY \n";

        // Get cURL resource
        $curl = curl_init();

        // Set some options - we are passing in a useragent too here
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $string
            )
        );

        // Send the request & save response to $resp
        $response = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);

        return $response;
    }


} 