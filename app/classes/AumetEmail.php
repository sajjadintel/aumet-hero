<?php


class AumetEmail
{
    private $fromName;
    private $fromAddress;
    private $mailPassword;

    public function __construct($fromName, $fromAddress, $mailPassword)
    {
        $this->fromAddress = $fromAddress;
        $this->fromName = $fromName;
        $this->mailPassword = $mailPassword;
    }

    function send($subject, $html, $arrTo, $arrCC = null, $arrBCC = null)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($this->fromAddress, $this->fromName);
        $email->setSubject($subject);
        $email->addTos($arrTo);

        if ($arrCC != null) {
            $email->addCcs($arrCC);
        }

        if ($arrBCC != null) {
            $email->addBccs($arrBCC);
        }

        $email->addContent(
            "text/html",
            $html
        );

        $sendgrid = new \SendGrid($this->mailPassword);
        try {
            $response = $sendgrid->send($email);
            return $response->statusCode();
        } catch (Exception $e) {
            return FALSE;
        }
    }
}