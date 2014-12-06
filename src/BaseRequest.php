<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 12/6/14
 * Time: 1:55 AM
 */

namespace NYTimes;

abstract class BaseRequest
{
    protected $URI;
    protected $query;
    protected $responseFormat;
    protected $key;

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

    public function query()
    {
        $string = "{$this->URI}{$this->query}{$this->key}";

        // Get cURL resource
        $curl = curl_init();

        // Set some options - we are passing in a useragent too here
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $this->URI
            )
        );

        // Send the request & save response to $resp
        $response = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);

        return $response;
    }
} 