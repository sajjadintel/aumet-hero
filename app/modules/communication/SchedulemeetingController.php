<?php
class SchedulemeetingController extends Controller
{
    public $daySlots = [0,1,2,3,4];//$availablity->getAllSlots($this->objCompany->ID);

    public $timeSlots = [
                            '00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00'
                            ,'12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00'
                        ];
    /**
     * Getting meetings list
     */
    function getMyMeetings(){

        if (!$this->f3->ajax()) {
            $this->renderLayout("meetings");
        } else {
            $attendees = new AttendeesEvent();
            $userModel = new AuthUser();
            $countryModel = new Country();
            $availablity = new Availibilities();
            $admin = $this->objUser;

            $companyModel = new Company();
            $companyID =  $this->objCompany->ID;
            $attendeesObj = $attendees->getByCompanyId($companyID);
            $countryObj = $countryModel->getById($this->objCountry->ID);

            $availableSlots = [];
            foreach ($this->timeSlots as $key=>$freeStartTime) {
                foreach ($this->daySlots as $k=> $day) {
                    $arr = $availablity->getAllSlotsWithStartTime($companyID, $day, $freeStartTime);
                    if(count($arr)>0){
                        $availableSlots[$freeStartTime][] = $arr[0];
                    }else{
                        $availableSlots[$freeStartTime][] =[
                            'companyId' => $companyID,
                            'freeSlotStart' => $freeStartTime,
                            'status' => 'available',
                            'day' => $day
                        ];
                    }
                }
            }

            if($attendees->dry()){
                $this->f3->set('allSlots', $availableSlots);
                $this->f3->set('companyID', $companyID);
                $this->webResponse->setData(View::instance()->render("schedulemeeting/empty.php"));
            }
            else {
                foreach ($attendeesObj as $key=> $meeting){
                    $user_id = $meeting->organizerId;
                    $company_id = $meeting->organizerCompanyId;
                    if($meeting->organizerId == $admin->id){
                        $user_id = $meeting->userId;
                        $company_id = $meeting->companyId;
                    }

                    $timestamp = strtotime($meeting->startTime);
                    $dayofweek = date('w', $timestamp);
                    $attendeesObj[$key]->organizer = $userModel->getById($user_id);
                    $companyObj = $companyModel->getById($company_id);

                    // TODO: remove for production
                    if(empty($attendeesObj[$key]->organizer)) {
                        $incharge_person = (new AumetUser())->getInchargePerson($company_id);
                        $attendeesObj[$key]->organizer = $incharge_person;
                    }
                    //Remove for production

                    $availablities = $availablity->getAvailableSlots($companyID, $dayofweek);
                    $attendeesObj[$key]->availablities = $availablities;
                    if($countryObj && $companyObj) {
                        $attendeesObj[$key]->company = $companyObj;
                        $attendeesObj[$key]->company->country = $countryObj;
                    }
                }
//                print_r($attendeesObj);exit;

                $this->f3->set('arrEvents', $attendeesObj);
                $this->f3->set('allSlots', $availableSlots);
                $this->f3->set('companyID', $companyID);
                $this->f3->set('userEmail', $this->objUser->email);

                $this->webResponse->setData(View::instance()->render("schedulemeeting/meetings-list.php"));
            }

            echo $this->webResponse->getJSONResponse();
        }
    }

    /**
     * Creating meetings on Vyte
     */
    function createAMeeting(){

        $eventsVyte = new VyteEvents();
        $users = new VyteUsers();
        $googleCalendar = new GoogleCalendar();
        $data = [];
        $organizerCompanyId = $this->objCompany->ID;


        //Get meeting list for that distributor
        $attendees = new Attendees();
        $attendeesEvent = new AttendeesEvent();
        $admin = $this->objUser;

        $attendeesObj = $attendeesEvent->getByUserId($admin->id);
        //Event Model to update local DB
        $event = new Events();

        //Getting data from post array.
        $date =                 $this->f3->get('POST.date');
        $event_id =             $this->f3->get('POST.event_id');
        $startTime =            $this->f3->get('POST.startTime');
        $endTime =              $this->f3->get('POST.endTime');
        $timeZone =             $this->f3->get('POST.timZone');
        $timeMaridiamStart =    $this->f3->get('POST.maridiumStart');
        $timeMaridiamEnd =      $this->f3->get('POST.maridiumEnd');
        $attendee_email =       $this->f3->get('POST.attendee_email');
        $attendee_id =          $this->f3->get('POST.attendee_id');
        $attendee_companyId =   $this->f3->get('POST.attendee_companyId');
        $attendee_name =        $this->f3->get('POST.attendee_name');

//        echo "<pre>";print_r($attendee_id);exit;

        $userData = [
            'email'=>$admin->email,
            'first_name'=>$admin->firstName,
            'last_name'=>$admin->lastName,
            'timezone'=>$timeZone,
            'account'=>[
                'organization'=>[
                    'extid'=>$admin->id
                ]
            ]
        ];
        /* Create user On Vyte if does not exists */
//        try {
//            $users->createUserIfNotOnVyte($userData);
//        }catch (Exception $e){
//            $this->webResponse->setMessage('Vyte Api is not working!');
//            echo $this->webResponse->getJSONResponse();
//        }

        $eventObj = $event->getByEventId($event_id);

        /* set client side timezone. */
        if(!$timeMaridiamStart){
            $timeMaridiamStart = 'AM';
        }
        if(!$timeMaridiamEnd){
            $timeMaridiamEnd = 'AM';
        }
        $timestamp = strtotime($date." ".$startTime.":00 ".$timeMaridiamStart);
//        $meeting_time = date('g:i a', $timestamp - 60 * 60 * 1);
//        $timestamp = strtotime($date." ".$meeting_time);
        $dateStart = new DateTime("@".$timestamp);
        $dateStart->setTimezone(new DateTimeZone($timeZone));


        /* set client side timezone. */
        $timestamp2 = strtotime($date." ".$endTime.":00 ".$timeMaridiamEnd);
//        $meeting_time = date('g:i a', $timestamp2 - 60 * 60 * 1);
//        $timestamp2 = strtotime($date." ".$meeting_time);
        $dateEnd = new DateTime("@".$timestamp2);
        $dateEnd->setTimezone(new DateTimeZone($timeZone));

        $event->startTime = $dateStart->format('Y-m-d H:i:sP');
        $event->endTime = $dateEnd->format('Y-m-d H:i:sP');
        $event->organizerEmail = $admin->email;
        $event->organizerId = $admin->id;
        $event->timezone = $timeZone;
        $event->companyId = $attendee_companyId;
        $event->organizerCompanyId = $organizerCompanyId;

        /* Check If this client is having meeting at same time. */
        if($event->checkMeetingOnThisTime($event->startTime, $eventObj, $timeMaridiamStart, $timeZone, $attendeesObj)){
            $this->webResponse->setMessage('You have another meeting on same time!');
        }else {

            $attendeesList = [
                [
                    "full_name"=>'Vyte Admin',
                    "email"=>'a.sahi@aumet.com',
                    "user_id"=>1234
                ],
                [
                    "full_name"=>$attendee_name,
                    "email"=>$attendee_email,
                    "user_id"=>$attendee_id
                ],
                [
                    "full_name"=>$admin->displayName,
                    "email"=>$admin->email,
                    "user_id"=>$admin->id
                ]
            ];


            $data = [
                'title'=>$attendee_name.' <> '.$admin->displayName,
                'created_by'=>[
                    "email"=>'a.sahi@aumet.com'
                ],
                'dates' => [
                    'all_day' => false,
                    'date' => $dateStart->format('Y-m-d H:i:sP'),//$date."T".$newStartTime.":".explode(':',$startTime)[1].":00.000Z",
                    'end_date' => $dateEnd->format('Y-m-d H:i:sP'),//$date."T".$newEndTime.":".explode(':',$endTime)[1].":00.000Z"
                ],
                'invitees'=>$attendeesList,
                'confirmed'=>[
                    'flag'=>true
                ]
            ];
            try {
                /*----Adding google meeting link on Vyte api----*/
                $googleMeetingLink =  $googleCalendar->getGoogleMeetingLink();
                $data['places'] = [
                    "name"=>"Google Meet",
                    "address"=>$googleMeetingLink
                ];

                /*Create Event On vtye and as well as on local DB*/
                $response = $eventsVyte->createAnEvent('POST', $data);
                /*test api code for testing*/
//                $response= ['_id'=>'5fd1deb3d008ce951df5558a'];
                $event->eventId = $response['_id'];
                $event->meetingLink = $googleMeetingLink;
                $eventObj = $event->addAndLoadById();

            }catch (Exception $e){
                $this->webResponse->setMessage($e->getMessage());
                echo $this->webResponse->getJSONResponse();
            }
            try {
                /* ---- Update event attendees --------*/
                foreach ($attendeesList as $attendee) {
                    if($attendee['email']!='a.sahi@aumet.com') {
                        $attendees->reset();
                        $attendees->eventId = $response['_id'];
                        $attendees->email = $attendee['email'];
                        $attendees->userId = $attendee['user_id'];
                        $attendees->status = "confirm";
                        $attendees->eventTblId = $event->id;
                        $attendees->save();
                    }
                }
            }catch (Exception $e){
                $event->erase(['id'=>$event->id]);
            }
            $this->webResponse->setData($response);
        }
        echo $this->webResponse->getJSONResponse();
    }

    /**
     * Creating meetings on Vyte and on local DB
     */
    function cancelMeeting(){

        $events = new VyteEvents();
        $eventsDB = new Events();
        $attendees = new Attendees();
        $event_id = $this->f3->get('POST.event_id');
        $eventsObj = $eventsDB->getByEventId($event_id);
        try {
            $response = $events->changeEventStatus('POST', $event_id, 'cancel');
            /* Updating status in local DB events table */

                $attendeesData = $attendees->getAllByEventId($eventsObj->id);
                foreach ($attendeesData as $attendee) {
                    $attendeeObj = $attendees->getByEventId($attendee->eventTblId);
                    $attendees->status = 'canceled';
                    $attendees->update();
                }
            $this->f3->set('data', $response);
            $this->webResponse->setData($response);
        }catch (Exception $e){
            /* Set exception message when vyte api is having some exception */
            $this->webResponse->setMessage($e->getMessage());
        }

        echo $this->webResponse->getJSONResponse();
    }

    /**
     * Updating meetings on Vyte and on local DB
     */
    function updateAMeeting(){

        //Event Model for updating Vyte api event.
        $events = new VyteEvents();

        //Get meeting list for that manufacturer
        $attendees = new AttendeesEvent();
        $admin = $this->objUser;
        $attendeesObj = $attendees->getByUserId($admin->id);

        //Event Model to update local DB
        $event = new Events();

        //Getting data from post array.
        $date =                   $this->f3->get('POST.date');
        $event_id =               $this->f3->get('POST.event_id');
        $startTime =              $this->f3->get('POST.startTime');
        $endTime =                $this->f3->get('POST.endTime');
        $timeZone =               $this->f3->get('POST.timZone');
        $timeMaridiamStart =      $this->f3->get('POST.maridiumStart');
        $timeMaridiamEnd =        $this->f3->get('POST.maridiumEnd');
        $slot_selected =          $this->f3->get('POST.slot_selected');

        $eventObj = $event->getByEventId($event_id);

        /* set client side timezone. */
        if(!$timeMaridiamStart){
            $timeMaridiamStart = 'AM';
        }
        if(!$timeMaridiamEnd){
            $timeMaridiamEnd = 'AM';
        }

        $timestamp = strtotime($date." ".$startTime.":00 ".$timeMaridiamStart);
//        $meeting_time = date('g:i a', $timestamp - 60 * 60 * 1);
//        $timestamp = strtotime($date." ".$meeting_time);
        $dateStart = new DateTime("@".$timestamp);
        $dateStart->setTimezone(new DateTimeZone($timeZone));

        /* set client side timezone. */
        $timestamp = strtotime($date." ".$endTime.":00 ".$timeMaridiamEnd);
//        $meeting_time = date('g:i a', $timestamp - 60 * 60 * 1);
//        $timestamp = strtotime($date." ".$meeting_time);
        $dateEnd = new DateTime("@".$timestamp);
        $dateEnd->setTimezone(new DateTimeZone($timeZone));

        $event->startTime = $dateStart->format('Y-m-d H:i:sP');
        $event->endTime = $dateEnd->format('Y-m-d H:i:sP');

        /*-- Check if user is available in this time slot --*/
        $company_id = $eventObj->organizerCompanyId;
        if($event->organizerId == $admin->id){
            $company_id = $event->companyId;
        }

        /* Check If this client is having meeting at same time. */
        if($event->checkMeetingOnThisTime($event->startTime, $eventObj, $timeMaridiamStart, $timeZone, $attendeesObj)){
            $this->webResponse->setMessage('You have another meeting on same time!');
        }else {
            $event->update();
            $data = [
                'dates' => [
                    'all_day' => false,
                    'date' => $event->startTime,//$date."T".$newStartTime.":".explode(':',$startTime)[1].":00.000Z",
                    'end_date' => $event->endTime,//$date."T".$newEndTime.":".explode(':',$endTime)[1].":00.000Z"
                ]
            ];

            $response = $events->updateEvent('PUT', $event_id, $data);
            $this->webResponse->setData($response);
        }
        echo $this->webResponse->getJSONResponse();
    }

    public function getFreeSlots(){
        $day                    =  $this->f3->get('POST.day');
        $companyId              =  $this->f3->get('POST.companyId');
        $availabilitiesModel    =  new Availibilities();
        $availabilities         =  $availabilitiesModel->getAvailableSlots($companyId, $day);
        $this->webResponse->setData($availabilities);
        echo $this->webResponse->getJSONResponse();
    }

    public function updateSlotStatus(){
        $day                 =  $this->f3->get('POST.day');
        $time                =  $this->f3->get('POST.time');
        $timeZone                =  $this->f3->get('POST.timeZone');
        $availabilitiesModel = new Availibilities();
        $availability        = new Availibilities();
        $availabilities      = $availabilitiesModel->getAllSlotsWithStartTime($this->objCompany->ID, $day, $time);
        if(is_array($availabilities) && count($availabilities)>0){

            $availabilityObj     = $availability->getAvailablityById($availabilities[0]['id']);
            if($availability->status=='busy'){
                $availability->status = 'available';
            }else {
                $availability->status = 'busy';
            }
            $availability->update();

        }else{
            $timeStart                          =   explode(':',$time);
            $timeEnd                            =   (int)$timeStart[0]+1;
            if($timeEnd<10){
                $timeEnd = "0".$timeEnd.":00";
            }else{
                $timeEnd = $timeEnd.":00";
            }
            $availability->companyId            =   $this->objCompany->ID;
            $availability->status               =   'busy';
            $availability->freeSlotStart        =    $time;
            $availability->freeSlotEnd          =    $timeEnd;
            $availability->timeZone             =    $timeZone;
            $availability->day                  =    $day;
            $availability->addAndLoadById();
        }
        $data = ['status'=>ucfirst($availability->status)];

        $this->webResponse->setData($data);
        echo $this->webResponse->getJSONResponse();
    }

    public function makeWholeDayBusy($day){
        $day                 =  $this->f3->get('POST.day');
        $timeZone                =  $this->f3->get('POST.timeZone');
        $availabilitiesModel = new Availibilities();
        $availability        = new Availibilities();

        foreach ($this->timeSlots as $time) {
            $availabilities = $availabilitiesModel->getAllSlotsWithStartTime($this->objCompany->ID, $day, $time);
            if (is_array($availabilities) && count($availabilities) > 0) {

                $availabilityObj = $availability->getAvailablityById($availabilities[0]['id']);
                $availability->status = 'busy';
                $availability->update();

            } else {
                $timeStart = explode(':', $time);
                $timeEnd = (int)$timeStart[0] + 1;
                if ($timeEnd < 10) {
                    $timeEnd = "0" . $timeEnd . ":00";
                } else {
                    $timeEnd = $timeEnd . ":00";
                }
                $availability->companyId = $this->objCompany->ID;
                $availability->status = 'busy';
                $availability->freeSlotStart = $time;
                $availability->freeSlotEnd = $timeEnd;
                $availability->timeZone = $timeZone;
                $availability->day = $day;
                $availability->addAndLoadById();
            }
        }
        $data = ['status'=>'Busy'];

        $this->webResponse->setData($data);
        echo $this->webResponse->getJSONResponse();
    }
}