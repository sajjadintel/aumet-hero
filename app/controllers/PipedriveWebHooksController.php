<?php


class PipedriveWebHooksController extends Controller
{
    public function beforeroute()
    {
    }

    public function webhookOrganizationAdded(){
        $req_dump = print_r($_REQUEST, TRUE);
        $fp = fopen($this->getRootDirectory() . '/logs/request-'.$this->generateRandomString(12).'.log', 'a');
        fwrite($fp, $req_dump);
        fclose($fp);
    }
}