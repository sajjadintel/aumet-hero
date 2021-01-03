<?php

class VyteEvents extends Vyte
{
    /**
     * @param string $method
     * @param $endpoint
     */
    public function createAnEvent($method = 'POST', $data=[] ){
        $endpoint = 'events';

        /* Prepare JSON data for request */
        $data = $this->prepareJSONData($data);

        /* Prepare URI for request */
        $uri = $this->prepareURI($endpoint);

        $response = $this->doRequest($method, $uri, $data);
        return $response;
    }


    /**
     * @param string $method
     * @return \Psr\Http\Message\ResponseInterface|void
     */
    public function getEventList($method = 'GET' , array $params = [] ){
        $endpoint = 'events';
        /* Prepare URI for request */
        if(isset($params) && count($params)){
            $endpoint .='?'.implode('&', $params);
        }
        $uri = $this->prepareURI($endpoint);

        $response = $this->doRequest($method, $uri);
        return $response;
    }

    /**
     * @param string $method
     * @param $event_id
     * @param string $status
     * @return \Psr\Http\Message\ResponseInterface|void
     */

    public function changeEventStatus($method = 'POST', $event_id, $status = 'confirm'  ){
        $endpoint = 'events/'.$event_id."/".$status;
        $data = [];

        /* Prepare JSON data for request */
        $data = $this->prepareJSONData($data);

        /* Prepare URI for request */
        $uri = $this->prepareURI($endpoint);

        $response = $this->doRequest($method, $uri, $data);
        return $response;
    }

    /**
     * @param string $method
     * @param $event_id
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface|void
     */
    public function updateEvent($method = 'PUT', $event_id, $data = []  ){
        $endpoint = 'events/'.$event_id;
        /* Prepare JSON data for request */
        $data = $this->prepareJSONData($data);

        /* Prepare URI for request */
        $uri = $this->prepareURI($endpoint);
        $response = $this->doRequest($method, $uri, $data);
        return $response;
    }
}