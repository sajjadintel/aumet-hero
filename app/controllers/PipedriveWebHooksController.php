<?php


class PipedriveWebHooksController extends Controller
{
    public function beforeroute()
    {
    }

    public function processWebhookOrganization(){
        $fp = fopen($this->getRootDirectory() . '/logs/organization-'.$this->generateRandomString(12).'.log', 'a');
        $post = file_get_contents('php://input');
        fwrite($fp, $post);
        fclose($fp);
        echo "OK";
    }

    public function processWebhookUser(){
        echo "OK";
    }
}