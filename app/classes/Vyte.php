<?php

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions as RequestOptions ;

abstract class Vyte
{
    public $key;
    public $api_url;
    public $organization;

    public function __construct() {
        /*  getting defined parameters */
        $this->key = getenv('VYTE_KEY');
        $this->api_url = getenv('VYTE_URI');
        $this->organization = getenv('VYTE_ORGANIZATION');
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface|void
     *
     */
    public function doRequest(string $method, string $uri, array $options = []){

        $client = new GuzzleClient();

        // Method "json" is deprecated for GuzzleHttp/Response as of 6's version

        /* Prepare URI for sending Vyte Request */
        if(isset($options['token'])){
            $options['headers']['Authorization'] = $options['token'];
        }else{
            $options['headers']['Authorization'] = $this->key;
            $options['headers']['Content-Type'] = 'application/json';
        }

        $response = $client->request($method, $uri, $options);

        $responseData = json_decode($response->getBody(), true);
        return $responseData;
    }

    /**
     * @param $data
     * @return array
     */
    protected function prepareJSONData($data){
        //Preparing JSON data for post requests to Vyte api
        return [RequestOptions::JSON =>$data];
    }

    /**
     * @param $endpoint
     * @return string
     */
    protected function prepareURI($endpoint){
        //Connecting Endpoint with api URI
        return $this->api_url.$endpoint;
    }
}