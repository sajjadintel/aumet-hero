<?php


class PipedriveWebHooksController extends Controller
{
    public function beforeroute()
    {
    }

    public function webhookOrganizationAdded(){
        $fp = fopen($this->getRootDirectory() . '/logs/request-'.$this->generateRandomString(12).'.log', 'a');
        $post = file_get_contents('php://input');
        fwrite($fp, $post);
        fclose($fp);
    }
}