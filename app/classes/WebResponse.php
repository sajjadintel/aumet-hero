<?php

/**
 * Description of WebResponse
 *
 * @author Alaa
 */
class WebResponse
{
    private $errorCode;
    private $message;
    private $title;
    private $data;

    public function __construct()
    {
        $this->errorCode = Constants::ERROR_SUCCESS; // 0 means no error
        $this->message = "";
        $this->data = null;
        $this->title = null;
    }

    /**
     * @return json representation of the object
     */
    public function getJSONResponse()
    {
        // clear the old headers
        header_remove();
        // set the actual code
        http_response_code(200);
        // set the header to make sure cache is forced
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        // treat this as json
        header('Content-Type: application/json');
        // ok, validation error, or failure
        header('Status: 200 OK');
        // return the encoded json
        return json_encode(
            [
                "errorCode" => $this->errorCode,
                "message" => $this->message,
                "data" => $this->data,
                "title" => $this->title
            ]
        );
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     */
    public function setErrorCode(int $errorCode): void
    {
        $this->errorCode = $errorCode;
    }
}
