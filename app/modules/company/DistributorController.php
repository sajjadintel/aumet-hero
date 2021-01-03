<?php


class DistributorController extends Controller
{
    function getMyDistributors(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("mydistributors");
        } else {

            global $dbConnectionAumet;

            $objSubscription = (new Subscription())->getByCompany($this->objCompany->ID);
            $this->f3->set('objSubscription', $objSubscription);

            $dbManufacturerDistributors = new BaseModel($dbConnectionAumet, 'onex.vwManufacturerDistributors');
            $arrManufacturerDistributors = $dbManufacturerDistributors->getWhere('"manufacturerCompanyId"='.$this->objCompany->ID);
            foreach ($arrManufacturerDistributors as $objManufacturerDistributor){
                $objManufacturerDistributor->objUser = (new AumetUser())->getInchargePerson($objManufacturerDistributor->distributorCompanyId);
            }

            $this->f3->set('arrManufacturerDistributors', $arrManufacturerDistributors);

            $this->f3->set('arrCountries', (new Country())->all("Name asc"));

            $this->f3->set('arrPendingInvitations', (new Invitation())->getPendingByCompany($this->objCompany->ID));

            $this->webResponse->setData(View::instance()->render("mydistributors/list.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function postInviteMyDistributor(){
        $dbInvitation = new Invitation();
        $dbInvitation->copyfrom("POST");
        $dbInvitation->companyId = $this->objCompany->ID;
        $dbInvitation->userId = $this->objUser->id;
        $dbInvitation->statusId = 1;
        $dbInvitation->code = $this->generateRandomString(32);
        $objInvitation = $dbInvitation->addAndLoadById();

        $this->sendInvitationEmail($objInvitation);
        $this->webResponse->setMessage("Invitation Has Been Send Successfully.");
        echo $this->webResponse->getJSONResponse();
    }

    function sendInvitationEmail($objInvitation)
    {
        global $emailSender;

        $bccEmails = [
            "a.atrash@aumet.com" => "Alaa Al Atrash"
        ];

        $toEmails = [
            $objInvitation->email => $objInvitation->name
        ];

        $this->f3->set("emailType", "invite");
        $this->f3->set('objInvitation', $objInvitation);
        $htmlContent = View::instance()->render('email/layout.php');

        return $emailSender->send($this->objCompany->Name . " invited you to connect at Aumet", $htmlContent, $toEmails, null, $bccEmails);
    }

    function getMyPendingInvitations(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("mydistributors");
        } else {

            $this->f3->set('arrPendingInvitations', (new Invitation())->getPendingByCompany($this->objCompany->ID));

            $this->webResponse->setData(View::instance()->render("mydistributors/pendingInvitations.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }
}