<?php


class DashboardController extends Controller
{
    function get(){
        if (!$this->f3->ajax()) {
            switch ($this->objUser->roleId) {
                case AuthUser::userRole_Admin:
                    $this->renderLayout("dashboard");
                    break;
                default:
                    $this->rerouteAuth();
                    break;
            }
        } else {
            $this->webResponse->setData(View::instance()->render("dashboard/default.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }
}