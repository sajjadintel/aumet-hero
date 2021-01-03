<?php


class VyteUsers extends Vyte
{
    /**
     * @param string $method
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface|void
     */
    public function createUser($method = 'POST',$data = [] ){
        $endpoint = 'users';
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
    public function getUsersList($method = 'GET' ){
        $data = [];
        $endpoint = 'users';

        /* Prepare JSON data for request */
        $data = $this->prepareJSONData($data);

        /* Prepare URI for request */
        $uri = $this->prepareURI($endpoint);

        $response = $this->doRequest($method, $uri, $data);
        return $response;
    }

    /**
     * @param string $method
     * @param $user_id
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface|void
     */
    public function updateUser($method = 'PUT', $user_id, $data = [] ){
        $endpoint = 'users/'.$user_id;

        /* Prepare JSON data for request */
        $data = $this->prepareJSONData($data);

        /* Prepare URI for request */
        $uri = $this->prepareURI($endpoint);

        $response = $this->doRequest($method, $uri, $data);
        return $response;
    }

    /**
     * @param array $userData
     */
    public function createUserIfNotOnVyte($userData = []){
        $users = $this->getUsersList('GET');
        $found = false;
        foreach ($users as $user){
            foreach ($user['emails'] as $email){
                if($userData['email']==$email){
                    $found = true;
                }
            }
        }
        if (!$found){
            $userData['user'] = $userData;
            $userData['organization'] = $this->organization;
//            $this->createUser('POST', $userData);
        }
    }

}