<?php


class ProfileController extends Controller
{
    function getTargetedCountries()
    {
        if(!$this->isBetaAccess) {
            $arrCountries = (new Country())->all("Name asc");
            $this->f3->set('arrCountries', $arrCountries);

            $arrTargetedCountries = (new CompanyTargetCountry())->getByCompanyId($this->objCompany->ID);
            $this->f3->set('SESSION.arrTargetedCountries', $arrTargetedCountries);
            $this->f3->set('arrTargetCountries', $arrTargetedCountries);
            $this->webResponse->setData(View::instance()->render("popups/targetedCountries.php"));
        }
        echo $this->webResponse->getJSONResponse();
    }

    function postTargetedCountries()
    {
        if(!$this->isBetaAccess) {
            $arrTargetCountries = $this->f3->get("POST.targetCountries");

            (new CompanyTargetCountry())->deleteByCompanyId($this->objCompany->ID);

            if(is_array($arrTargetCountries)){
                foreach ($arrTargetCountries as $targetCountryId) {
                    $objTargetCountry = new CompanyTargetCountry();
                    $objTargetCountry->getByPKId($this->objCompany->ID, $targetCountryId);
                    if($objTargetCountry->dry()) {
                        $objTargetCountry->companyId = $this->objCompany->ID;
                        $objTargetCountry->countryId = $targetCountryId;
                        $objTargetCountry->add();
                    }
                }
            }
            elseif ($arrTargetCountries) {
                $targetCountryId = $arrTargetCountries;
                $objTargetCountry = new CompanyTargetCountry();
                $objTargetCountry->getByPKId($this->objCompany->ID, $targetCountryId);
                if($objTargetCountry->dry()) {
                    $objTargetCountry->companyId = $this->objCompany->ID;
                    $objTargetCountry->countryId = $targetCountryId;
                    $objTargetCountry->add();
                }
            }

            $this->arrTargetedCountries = (new CompanyTargetCountry())->getByCompanyId($this->objCompany->ID);
            $this->f3->set('SESSION.arrTargetedCountries', $this->arrTargetedCountries);
        }

        echo $this->webResponse->getJSONResponse();
    }

    function postRemoveTargetedCountry(){
        if(!$this->isBetaAccess) {
            $targetCountryId = $this->f3->get("PARAMS.countryId");
            $objTargetCountry = new CompanyTargetCountry();
            $objTargetCountry->getByPKId($this->objCompany->ID, $targetCountryId);
            $objTargetCountry->delete();
            $this->webResponse->setData($targetCountryId);
        }
        echo $this->webResponse->getJSONResponse();
    }
}