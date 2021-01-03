<?php


class AdminController extends Controller
{
    // Define Errors
    const error_unknown = 1;

    function beforeroute()
    {
        parent::beforeroute();

        if(!$this->objUser->isAdmin) {
            $this->f3->error(400);
        }
    }

    function getBetaCustomers()
    {
        if (!$this->f3->ajax()) {
            $this->renderLayout("admin/betacustomers");
        } else {
            $arrBetaCustomers = (new BetaCompany())->all();
            $this->f3->set('arrBetaCustomers', $arrBetaCustomers);
            $this->webResponse->setData(View::instance()->render("beta/list.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getImpersonateCompany(){
        $companyId = $this->f3->get("PARAMS.companyId");
        if($this->updateSessionDataForAdmin($companyId)){
            $this->rerouteMemberHome();
        }
    }

    function updateSessionDataForAdmin($companyId){
        $objSessionUser = $this->f3->get('SESSION.objUser');

        $objAumetCompany = new AumetCompany();
        if($objAumetCompany->loadById($companyId)){
            $objAumetCompany->syncSession();
            return true;
        }
        else {
            return false;
        }
    }
}