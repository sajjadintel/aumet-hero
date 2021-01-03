<?php

class LandingController extends Controller
{
    function beforeroute()
    {
        if($this->isAuth){
            $this->rerouteMemberHome();
        }
        elseif($this->isBetaAccess){
            $this->rerouteAuth();
        }
    }

    function getHome(){
        $this->f3->set('publicPageTitle', "Aumet Inc");
        $this->f3->set('pageCodeName', "home");
        echo View::instance()->render("public/layout.php");
    }

    function getManufacturer()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Manufacturer");
        $this->f3->set('pageCodeName', "manufacturer");
        echo View::instance()->render("public/layout.php");
    }

    function getDistributor()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Distributor");
        $this->f3->set('pageCodeName', "distributor");
        echo View::instance()->render("public/layout.php");
    }

    function getAbout()
    {
        $this->f3->set('publicPageTitle', "About Aumet Inc");
        $this->f3->set('pageCodeName', "about");
        echo View::instance()->render("public/layout.php");
    }

    function getAcceptableUsePolicy()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Acceptable Use Policy");
        $this->f3->set('pageCodeName', "acceptableusepolicy");
        echo View::instance()->render("public/layout.php");
    }

    function getContact()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Contact");
        $this->f3->set('pageCodeName', "contact");
        echo View::instance()->render("public/layout.php");
    }

    function getCore()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Core");
        $this->f3->set('pageCodeName', "core");
        echo View::instance()->render("public/layout.php");
    }

    function getJobs()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Jobs");
        $this->f3->set('pageCodeName', "jobs");
        echo View::instance()->render("public/layout.php");
    }

    function getOnex()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Online Exhibition");
        $this->f3->set('pageCodeName', "onex");
        echo View::instance()->render("public/layout.php");
    }

    function getVex()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Virtual Exhibition");
        $this->f3->set('pageCodeName', "vex");
        echo View::instance()->render("public/layout.php");
    }

    function getPrivacy()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Privacy");
        $this->f3->set('pageCodeName', "privacy");
        echo View::instance()->render("public/layout.php");
    }

    function getTermsOfUse()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Terms of Use");
        $this->f3->set('pageCodeName', "termsofuse");
        echo View::instance()->render("public/layout.php");
    }

    function getWebsiteTermsOfUse()
    {
        $this->f3->set('publicPageTitle', "Aumet Inc - Website Terms of Use");
        $this->f3->set('pageCodeName', "websitetermsofuse");
        echo View::instance()->render("public/layout.php");
    }
}
