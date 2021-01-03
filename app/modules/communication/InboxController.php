<?php


class InboxController extends Controller
{
    function getInbox()
    {
    	   	    	
        if (!$this->f3->ajax()) {
        	$this->renderLayout("inbox");
        } else 
        {
            $this->webResponse->setData(View::instance()->render("inbox/inbox.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }
    function getView()
    {
                    
        if (!$this->f3->ajax()) {
            $this->renderLayout("inbox");
        } else 
        {
            $message_id = $this->f3->get("PARAMS.messageId");
            
            global $dbConnectionAumet;
            
            $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');

            $objMessage = $dbMessage->getByField('"id"', $message_id);
          
            $arrmessage = array();
            
            $arrmessage["toUserId"] = $objMessage->toUserId;
            $arrmessage["fromUserId"] = $objMessage->fromUserId;
            $arrmessage["id"] = $objMessage->id;
            $arrmessage["createdAt"] = $objMessage->createdAt;
            $arrmessage["toemail"] = (new AuthUser())->getById($objMessage->toUserId)->email;
            $arrmessage["fromemail"] = (new AuthUser())->getById($objMessage->fromUserId)->email;
            $arrmessage["toname"] = (new AuthUser())->getById($objMessage->toUserId)->displayName;
            $arrmessage["fromname"] = (new AuthUser())->getById($objMessage->fromUserId)->displayName;

            $arrmessage["subject"] = $objMessage->subject;
            $arrmessage["content"] = $objMessage->content;
            $arrmessage["readstatus"] = $objMessage->readstatus;
            $arrmessage["markstatus"] = $objMessage->markstatus;
            
            $this->f3->set('objmessage', $arrmessage);

            if($objMessage->readstatus =='0')
            {
                $dbMessage->readstatus= 1;

                if (!$dbMessage->update()) {
                    
                }
            }

            
            $where = '"parentId"='.$message_id;
            $where .='  and "status" = 0';
            $replymessage = $this->getData($where,'"createdAt"');

            $this->f3->set('objreplymessage', $replymessage);
            $this->webResponse->setData(View::instance()->render("inbox/view.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getList()
    {
            
        $page = $this->f3->get("PARAMS.page") ? $this->f3->get("PARAMS.page"):'0';
        if (!$this->f3->ajax()) 
        {
            $this->renderLayout("inbox");
        } 
        else 
        {
            $where = '"toCompanyId"='.$this->objCompany->ID;
            $where .=' and "status" = 0 and "parentId" = 0';
                        
            $arrmessage = $this->getData($where,'"createdAt"',$page);
            $this->f3->set('objmessage', $arrmessage);
            $this->f3->set('page', $page);
            
            $this->webResponse->setMessage(
                count($arrmessage)."_inbox");
            $this->webResponse->setData(View::instance()->render("inbox/list.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }
    function getMark()
    {
        $page = $this->f3->get("PARAMS.page") ? $this->f3->get("PARAMS.page"):'0';
        if (!$this->f3->ajax()) {
            $this->renderLayout("inbox");
        } 
        else 
        {
        
            $where = '("toCompanyId"='.$this->objCountry->ID;
            $where .= ' or "fromCompanyId"='.$this->objCountry->ID;
            $where .=' ) and markstatus = 1';
            
            $arrmessage = $this->getData($where,'"createdAt"',$page);
            
            $this->f3->set('objmessage', $arrmessage);
            $this->f3->set('page', $page);
            $this->webResponse->setMessage(count($arrmessage)."_mark");
            $this->webResponse->setData(View::instance()->render("inbox/list.php"));

            echo $this->webResponse->getJSONResponse();
        }

    }
    function getTrash()
    {
        $page = $this->f3->get("PARAMS.page") ? $this->f3->get("PARAMS.page"):'0';
    	if (!$this->f3->ajax()) 
        {
            $this->renderLayout("inbox");
        } else {

            $where = '("toCompanyId"='.$this->objCountry->ID;
            $where .= ' or "fromCompanyId"='.$this->objCountry->ID;
            $where .=' ) and "status" = 1';
            
            $arrmessage = $this->getData($where,'"createdAt"',$page);
            
            $this->f3->set('objmessage', $arrmessage);
            $this->f3->set('page', $page);

            $this->webResponse->setMessage(count($arrmessage)."_trash");
            $this->webResponse->setData(View::instance()->render("inbox/list.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }
    function getSent()
    {
        $page = $this->f3->get("PARAMS.page") ? $this->f3->get("PARAMS.page"):'0';
        if (!$this->f3->ajax()) {
            $this->renderLayout("inbox");
        } else {
         
            $where = '"fromCompanyId"='.$this->objCompany->ID;
            $where .=' and "status" = 0 and "parentId" = 0';
            
            $arrmessage = $this->getData($where,'"createdAt"',$page);
            
            $this->f3->set('objmessage', $arrmessage);
            $this->f3->set('page', $page);

            $this->webResponse->setMessage(count($arrmessage)."_sent");
            $this->webResponse->setData(View::instance()->render("inbox/list.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getByFieldData($field,$value)
    {
        global $dbConnectionAumet;
        
        $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');

        $objMessage = $dbMessage->getByField($field,$value);
        return $objMessage;

    }
    function getData($where,$order,$page = '',$pageSize ='10')
    {
        global $dbConnectionAumet;
        
        $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');

        if($page == '')
        {
            $objMessage = $dbMessage->getWhere($where,$order);
        }
        else
        {
          $objMessage = $dbMessage->getWhere($where,$order,($page+1) * $pageSize, $page*$pageSize);
        }

        $arr = [];
      
        foreach ($objMessage as $obj)
        {
            $arr[$obj->id]["toUserId"] = $obj->toUserId;
            $arr[$obj->id]["fromUserId"] = $obj->fromUserId;
            $arr[$obj->id]["id"] = $obj->id;
            $arr[$obj->id]["createdAt"] = $obj->createdAt;
            
            $arr[$obj->id]["toname"] = (new AuthUser())->getById($obj->toUserId)->displayName;
            $arr[$obj->id]["fromname"] = (new AuthUser())->getById($obj->fromUserId)->displayName;

            $where = '"parentId"='.$obj->id;
            $where .='  and "status" = 0';
            $replymessage = $this->getData($where,'"createdAt"');
           
            $arr[$obj->id]["replycount"] = count($replymessage);
            $arr[$obj->id]["subject"] = $obj->subject;
            $arr[$obj->id]["content"] = $obj->content;
            $arr[$obj->id]["readstatus"] = $obj->readstatus;
            $arr[$obj->id]["markstatus"] = $obj->markstatus;
                    
        }

        return $arr;
    }
    function getPage()
    {
        $page = $this->f3->get('PARAMS.page');
        
        if (!$this->f3->ajax()) {
            $this->renderLayout($page);
        } else {
            
            if (isset($page) && $page != "" && $page != null && is_numeric($page)) {
                $page = $page - 1;
            } else {
                $page = 0;
            }

            $pageSize = 10;

            $select2Result = new stdClass();
            $select2Result->results = [];
            $select2Result->pagination = false;

            global $dbConnectionAumet;
            
            $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');
       
            $where = '"toUserId"='.$this->objUser->id;
            $dbMessage->getWhere($where, '', $pageSize, $page * $pageSize);
            $resultsCount = 0;
            while (!$dbMessage->dry()) {
                $resultsCount++;
                $select2ResultItem = new stdClass();
                $select2ResultItem->id = $dbMessage["id"];
                $select2ResultItem->subject = $dbMessage["subject"];
                $select2Result->results[] = $select2ResultItem;
                $dbMessage->next();
            }

            if ($resultsCount >= $pageSize) 
            {
                $select2Result->pagination = true;
            }

            
            $this->f3->set('objmessage', $select2Result);

            //$this->f3->set('status', $status);
            
            $this->webResponse->setData(View::instance()->render("inbox/inbox.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }
    function postMark()
    {
        
        $message_id = $this->f3->get("POST.id");
        $status = $this->f3->get("POST.status");

        global $dbConnectionAumet;
            
        $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');

        $dbMessage->getById($message_id);
        
        $dbMessage->markstatus= $status;

        if (!$dbMessage->update()) {
            
        }
        $this->webResponse->setMessage($status);
        $this->webResponse->setData($message_id);
        
        echo $this->webResponse->getJSONResponse();
    }
    function postMessage()
    {
        $arruser = json_decode($this->f3->get("POST.compose_to"));
        $subject = $this->f3->get("POST.compose_subject");
        $content = $this->f3->get("POST.compose_content");

        if($arruser)
        {
            foreach($arruser as $user)
            {

                global $dbConnectionAumet;

                $objCompanyUser = (new CompanyUser())->getByUserId($user->id);
                $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');
                if($dbMessage->dry()) 
                {
                    $dbMessage->fromUserId = $this->objUser->id;
                    $dbMessage->toUserId = $user->id;
                    $dbMessage->fromCompanyId = $this->objUser->companyId;
                    $dbMessage->toCompanyId = $objCompanyUser->companyId;
                    $dbMessage->subject = $subject;
                    $dbMessage->content = $content;
                    $dbMessage->createdAt = date("Y-m-d H:i:s");
                    $dbMessage->add();
                    
                }

            }
            

        }
        
        echo $this->webResponse->getJSONResponse();

    }
    function DeleteMessage()
    {   

        $messageData = $this->f3->get("POST.messagedata");
        if($messageData)
        {
            foreach($messageData as $message_id)
            {
                global $dbConnectionAumet;
                
                $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');
                $objMessage =$dbMessage->getById($message_id);
                if($objMessage->status =='0')
                {
                    $dbMessage->status= 1;

                    if (!$dbMessage->update()) 
                    {
                        
                    }
                }
                else if($objMessage->status =='1')
                {
                    if (!$dbMessage->delete()) 
                    {
                        
                    }
                }
            }

        }
               
        $this->webResponse->setData($messageData);
        
        echo $this->webResponse->getJSONResponse();
    }
    function readMessage()
    {   

        $messageData = $this->f3->get("POST.messagedata");
        if($messageData)
        {
            foreach($messageData as $message_id)
            {
                global $dbConnectionAumet;
                
                $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');
                $objMessage =$dbMessage->getById($message_id);
                if($objMessage->readstatus =='0')
                {
                    $dbMessage->readstatus= 1;

                    if (!$dbMessage->update()) 
                    {
                        
                    }
                }
                else 
                {
                   $dbMessage->readstatus= 0;

                    if (!$dbMessage->update()) 
                    {
                        
                    }
                }
            }

        }
        
        
        $this->webResponse->setData($messageData);
        
        echo $this->webResponse->getJSONResponse();
    }
    function ReplyMessage()
    {
        $arruser = json_decode($this->f3->get("POST.compose_to"));
        $subject = $this->f3->get("POST.compose_subject");
        $content = $this->f3->get("POST.compose_content");
        $parent_id = $this->f3->get("POST.parent_id");

        if($arruser)
        {
            foreach($arruser as $user)
            {

                global $dbConnectionAumet;

                $objCompanyUser = (new CompanyUser())->getByUserId($user->id);
                $dbMessage = new BaseModel($dbConnectionAumet, 'onex.message');
                if($dbMessage->dry()) 
                {
                    $dbMessage->fromUserId = $this->objUser->id;
                    $dbMessage->toUserId = $user->id;
                    $dbMessage->fromCompanyId = $this->objUser->companyId;
                    $dbMessage->toCompanyId = $objCompanyUser->companyId;
                    $dbMessage->subject = $subject;
                    $dbMessage->content = $content;
                    $dbMessage->createdAt = date("Y-m-d H:i:s");
                    $dbMessage->parentId = $parent_id;
                    $dbMessage->add();
                    
                }

            }
            

        }
        $this->webResponse->setData($parent_id);
        echo $this->webResponse->getJSONResponse();

    }

    function getInboxContacts()
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec('select * from onex."getInboxContactsByCompanyId"('.$this->objCompany->ID.')');

        $arr = array_map(function ($item)
        {
            return array("value" =>strip_tags($item['displayName']),"email" =>$item['email'],"id" => $item['id'], "photoUrl" =>$item['photoUrl']);
        }, $arr);

        echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        
    }

    function postSendMessageDialogue(){
        if ($this->f3->ajax() && $this->isAuth) {
            $subject = $this->f3->get("POST.subject");
            $content = $this->f3->get("POST.message");
            $toCompanyId = $this->f3->get("POST.cid");
            $toUserId = $this->f3->get("POST.toUserId");
            
            $dbMessage = new Message();
            $dbMessage->fromUserId = $this->objUser->id;
            $dbMessage->toUserId = $toUserId;
            $dbMessage->fromCompanyId = $this->objCompany->ID;
            $dbMessage->toCompanyId = $toCompanyId;
            $dbMessage->subject = $subject;
            $dbMessage->content = $content;
            $dbMessage->createdAt = date("Y-m-d H:i:s");
            $objMessage = $dbMessage->addAndLoadById();

            $this->sendMessageEmail($objMessage);

            $this->webResponse->setMessage("Message Send Successfully!. ".$objMessage->subject);
        } else {
            $this->webResponse->setErrorCode(401);
        }
        echo $this->webResponse->getJSONResponse();
    }

    function sendMessageEmail($objMessage)
    {
        global $emailSender;

        $bccEmails = [
            "a.atrash@aumet.com" => "Alaa Al Atrash"
        ];

        $arrContacts = (new AumetUser())->getEmailListByCompanyId($objMessage->toCompanyId);

        $this->f3->set("emailType", "message");
        $this->f3->set('objMessage', $objMessage);
        $this->f3->set('fromName', $this->objUser->displayName);
        $htmlContent = View::instance()->render('email/layout.php');

        return $emailSender->send("New message @ Aumet from Alaa", $htmlContent, $arrContacts, null, $bccEmails);
    }
}