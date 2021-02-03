<?php


class AirtableScriptsController extends Controller
{
    public function beforeroute()
    {
    }

    public function processCall(){
        $fp = fopen($this->getRootDirectory() . '/logs/airtable-'.$this->generateRandomString(12).'.log', 'a');
        $post = file_get_contents('php://input');
        fwrite($fp, $post);
        fclose($fp);
        var_dump($post);
    }

    public function processWebhookUser(){
        echo "OK";
    }
}