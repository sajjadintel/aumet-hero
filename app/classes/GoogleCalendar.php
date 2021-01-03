<?php


class GoogleCalendar
{

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    private function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('OnEx-cal');
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    public function getGoogleMeetingLink(){
        $client = $this->getClient();
        $calendarId = 'primary';
        $event = new Google_Service_Calendar_Event(array(
            'summary' => 'Google I/O 2015',
            'location' => '800 Howard St., San Francisco, CA 94103',
            'description' => 'THis is test event from google',
            'start' => array(
                'dateTime' => '2015-12-28T09:00:00-07:00',
                'timeZone' => 'America/Los_Angeles',
            ),
            'end' => array(
                'dateTime' => '2015-12-28T10:00:00-07:00',
                'timeZone' => 'America/Los_Angeles',
            ),
            'recurrence' => array(
                'RRULE:FREQ=DAILY;COUNT=2'
            ),
            'attendees' => array(
                array('email' => 'abs@ciklum.com'),
            ),
        ));
        $client->setRedirectUri("urn:ietf:wg:oauth:2.0:oob");
        $service = new Google_Service_Calendar($client);
        $event = $service->events->insert($calendarId, $event);
        $conference = new \Google_Service_Calendar_ConferenceData();
        $conferenceRequest = new \Google_Service_Calendar_CreateConferenceRequest();
        $conferenceRequest->setRequestId('randomString123');
        $conference->setCreateRequest($conferenceRequest);
        $event->setConferenceData($conference);
        $event = $service->events->patch($calendarId, $event->id, $event, ['conferenceDataVersion' => 1]);
        $link = $event->hangoutLink;
        $service->events->delete('primary', $event->id);
        return $link;
    }
}