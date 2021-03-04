<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;

class AuthController extends Controller
{
    // Define Errors
    const ERROR_USER_NOT_FOUND = 2;
    const ERROR_USER_DISABLED = 3;
    const ERROR_USER_COMPANY_SETUP = 4;
    const ERROR_USER_ALREADY_EXISTS = 5;
    const ERROR_EMAIL_SEND_FAILED = 6;
    const ERROR_USER_OTP = 7;
    const ERROR_AUTH_CODE_FAILED = 8;

    // overwrite beforeroute to make AuthController publicly accessible
    function beforeroute()
    {
    }

    function getHome()
    {
        if ($this->isAuth) {
            $this->rerouteMemberHome();
        } else {
            $this->rerouteAuth();
        }
    }

    function getSignIn()
    {
        if ($this->isAuth) {
            $this->rerouteMemberHome();
        } else {
            $this->f3->set('authScript', 'signin');
            echo View::instance()->render('auth/layout.php');
        }
    }

    function getForgottenPassword()
    {
        if ($this->isAuth) {
            $this->rerouteMemberHome();
        } else {
            $this->f3->set('authScript', 'forgot');
            echo View::instance()->render('auth/layout.php');
        }
    }

    function postSignIn()
    {
        $factory = (new Factory)->withServiceAccount($this->getRootDirectory() . '/config/aumet-internal-products-firebase-adminsdk-ucqk5-4d2e258737.json');

        $auth = $factory->createAuth();

        $idTokenString = $this->f3->get("POST.token");

        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            $uid = $verifiedIdToken->getClaim('sub');
            $objFBuser = $auth->getUser($uid);
            $objUser = (new AuthUser())->getByUID($uid);

            if($objUser) {
                switch ($objUser->statusId){
                    case AuthUser::userStatus_Active:
                        if($this->setSessionData($objUser, $idTokenString)){
                            $this->webResponse->setErrorCode(Constants::ERROR_SUCCESS);
                        }
                        else {
                            $auth->revokeRefreshTokens($uid);
                            $this->webResponse->setErrorCode(AuthController::ERROR_USER_DISABLED);
                            $this->webResponse->setMessage($this->f3->get("ERROR_USER_DISABLED"));
                        }
                        break;
                    default:
                        $auth->revokeRefreshTokens($uid);
                        $this->webResponse->setErrorCode(AuthController::ERROR_USER_DISABLED);
                        $this->webResponse->setMessage($this->f3->get("ERROR_USER_DISABLED"));
                        break;
                }
            }
            else {
                $this->webResponse->setErrorCode(AuthController::ERROR_USER_NOT_FOUND);
                $this->webResponse->setMessage($this->f3->get("ERROR_USER_NOT_FOUND"));
            }
        } catch (\InvalidArgumentException $e) {
            $this->webResponse->setErrorCode(Constants::ERROR_UNKNOWN);
            $this->webResponse->setMessage($e->getMessage());
        } catch (InvalidToken $e) {
            $this->webResponse->setErrorCode(Constants::ERROR_UNKNOWN);
            $this->webResponse->setMessage($e->getMessage());
        }

        echo $this->webResponse->getJSONResponse();
    }

    function getSignOut()
    {
        try {
            $factory = (new Factory)->withServiceAccount($this->getRootDirectory() . '/config/aumet-com-firebase-adminsdk-2nsnx-64efaf5c39.json');

            $auth = $factory->createAuth();

            $idTokenString = $this->f3->get("SESSION.token");

            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            $uid = $verifiedIdToken->getClaim('sub');

            $auth->revokeRefreshTokens($uid);

            $verifiedIdToken = $auth->verifyIdToken($idTokenString, $checkIfRevoked = true);
        } catch (RevokedIdToken $e) {
            //$e->getMessage();
        } catch (Exception $e) {

        }
        $this->clearUserSession();
        $this->rerouteAuth();
    }

    function setSessionData($objSessionUser, $token){

        $this->f3->set('SESSION.token', $token);
        $this->f3->set('SESSION.objUser', $objSessionUser);

        return true;
    }

    function clearUserSession()
    {
        $this->isAuth = false;
        $this->f3->clear('SESSION.objUser');
        $this->f3->clear('SESSION.token');
    }

    function sendResetPasswordEmail($userEmail, $userDisplayName, $authCode)
    {
        global $emailSender;

        $bccEmails = [];
        if((getenv('USE_REAL_EMAILS') == 1) && (getenv('ENV') == 'prod')) {
            $bccEmails = [
                "a.atrash@aumet.com" => "Alaa Al Atrash",
                "m.issa@aumet.com" => "Mohammed Issa",
                "r.abdelhadi@aumet.com" => "Raseel Abdelhadi"
            ];
            if ($this->isAuth) {
                if($this->objCompany->Type == Company::TYPE_DISTRIBUTOR) {
                    if (!array_key_exists('a.verhaeghe@aumet.com',$bccEmails)) {
                        $bccEmails["a.verhaeghe@aumet.com"] = "A.Verhaeghe";
                    }
                }
            }
        }

        $this->f3->set("emailType", "resetOnexUser");
        $this->f3->set("resetCode", $authCode);
        $this->f3->set("authEmail", $userEmail);
        $htmlContent = View::instance()->render('email/layout.php');

        return $emailSender->send("Aumet Account Recovery", $htmlContent, [$userEmail => $userDisplayName], null, $bccEmails);
    }

    function postForgottenPassword()
    {
        $email = $this->f3->get("POST.email");

        $dbUser = new AuthUser();
        $objUser= $dbUser->getByEmail($email);

        if(!$dbUser->dry()) {
            $resetCode = $this->generateRandomString(32);
            $dbUser->resetCode = $resetCode;
            $this->sendResetPasswordEmail($objUser->email, $objUser->firstName, $resetCode );
            $dbUser->update();
            $this->f3->set('authScript', 'resetPasswordSent');
            echo View::instance()->render('auth/layout.php');
        }
        else {
            $this->f3->reroute("/en/auth/signin");
        }
    }

    function getForgottenPasswordReset()
    {
        $resetCode = $this->f3->get("PARAMS.resetCode");
        $this->f3->set('resetCode', $resetCode);
        $this->f3->set('authScript', 'resetPassword');
        echo View::instance()->render('auth/layout.php');
    }

    function postForgottenPasswordReset()
    {
        $resetCode = $this->f3->get("POST.resetCode");

        $dbUser = new AuthUser();
        $objUser= $dbUser->getByResetCode($resetCode);

        if(!$dbUser->dry()) {

            $factory = (new Factory)->withServiceAccount($this->getRootDirectory() . '/config/aumet-internal-products-firebase-adminsdk-ucqk5-4d2e258737.json');

            $auth = $factory->createAuth();

            $updatedUser = $auth->changeUserPassword($objUser->uid, $this->f3->get("POST.password"));

            $dbUser->resetCode = null;
            $dbUser->update();

            $this->f3->set('authScript', 'signin');
            echo View::instance()->render('auth/layout.php');
        }
        else {
            $this->f3->reroute("/en/auth/signin");
        }
    }

    function getEncryptedPassword()
    {
        echo password_hash("atrash", PASSWORD_DEFAULT);
    }
    function postSignUp()
    {
        if(!$this->isBetaAccess) {
            $factory = (new Factory)->withServiceAccount($this->f3->get('firebaseAdminKeyFile'));

            $auth = $factory->createAuth();

            try {
                $idTokenString = $this->f3->get("POST.token");
                $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                $uid = $verifiedIdToken->getClaim('sub');

                $userProperties = [
                    'emailVerified' => true,
                    'displayName' => $this->f3->get("POST.firstName")." ".$this->f3->get("POST.lastName"),
                ];

                $auth->updateUser($uid, $userProperties);

                $objFBuser = $auth->getUser($uid);

                $dbUser = new OnexAuthUser();
                $objSessionUser = $dbUser->getByUID($uid);

                if($dbUser->dry()){
                    $objSessionUser = $dbUser->getByEmail(trim($this->f3->get("POST.email")));
                }

                if($dbUser->dry()){
                    $objInvitation = null;

                    $dbUser->uid = $uid;

                    $dbUser->email = $this->f3->get("POST.email");
                    $dbUser->companyType = $this->f3->get("POST.companyType");
                    $dbUser->statusId = 3;
                    $dbUser->authCode = $this->generateRandomString(16);
                    $dbUser->emailVerified = true;
                    $dbUser->payload = json_encode($objFBuser);
                    switch ($this->f3->get("POST.companyType")){
                        case Company::TYPE_MANUFACTURER:
                            $dbUser->scopeId=2; // OnEx Default
                            break;
                        case Company::TYPE_DISTRIBUTOR:
                            $dbUser->scopeId=2; // OnEx Default
                            break;
                        case Company::TYPE_PHARMACY:
                            $dbUser->scopeId=1;
                            break;
                    }

                    $dbUser->displayName = $this->f3->get("POST.firstName")." ".$this->f3->get("POST.lastName");
                    $dbUser->firstName = $this->f3->get("POST.firstName");
                    $dbUser->lastName = $this->f3->get("POST.lastName");

                    $dbUserContact = new AumetUser();
                    $objUserContact = $dbUserContact->getByEmail($this->f3->get("POST.email"));
                    if(!$objUserContact) {
                        $dbUserContact->FirstName = $this->f3->get("POST.firstName");
                        $dbUserContact->LastName = $this->f3->get("POST.lastName");
                        $dbUserContact->Email = $this->f3->get("POST.email");
                        $objUserContact = $dbUserContact->addAndLoadById('"ID"');
                    }

                    $dbUser->contactId = $objUserContact->ID;

                    $objSessionUser = $dbUser->addAndLoadById();

                    if($objSessionUser->id) {
                        $dbCompanyUser = new CompanyUser();
                        $dbCompanyUser->getByUserId($objSessionUser->id);
                        //If already exists then delete it because it does not have any primary key
                        if(!$dbCompanyUser->dry()){
                            $dbCompanyUser->deleteByUserId($objSessionUser->id);
                        }
                        $dbCompanyUser->userId      = $objSessionUser->id;
                        $dbCompanyUser->companyId   = $this->f3->get("POST.companyId");
                        $dbCompanyUser->accessType  = $this->f3->get("POST.companyType");
                        $dbCompanyUser->add();

                        $auth->revokeRefreshTokens($uid);
                    }
                    $email = $this->f3->get("POST.email");

                    $dbUser = new OnexAuthUser();
                    $objUser= $dbUser->getByEmail($email);

                    if(!$dbUser->dry()) {
                        $resetCode = $this->generateRandomString(32);
                        $dbUser->resetCode = $resetCode;
                        $this->sendResetPasswordEmail($objSessionUser->email, $objSessionUser->firstName, $resetCode );
                        $dbUser->update();
                    } else {
                        $auth->deleteUser($uid);
                        $this->webResponse->setErrorCode(Constants::ERROR_UNKNOWN);
                        $this->webResponse->setMessage($dbUser->getException());
                    }
                    $this->webResponse->setErrorCode(0);
                    $this->webResponse->setMessage('User created successfully');
                    echo $this->webResponse->getJSONResponse();exit;
                }
                else {
                    $auth->revokeRefreshTokens($uid);
                    $this->webResponse->setErrorCode(Constants::ERROR_USER_ALREADY_EXISTS);
                    $this->webResponse->setMessage($this->f3->get("ERROR_USER_DISABLED"));
                }

            } catch (\InvalidArgumentException $e) {
                $this->webResponse->setErrorCode(Constants::ERROR_UNKNOWN);
                $this->webResponse->setMessage($e->getMessage());
            } catch (InvalidToken $e) {
                $this->webResponse->setErrorCode(Constants::ERROR_UNKNOWN);
                $this->webResponse->setMessage($e->getMessage());
            }
        }
        else{
            $this->webResponse->setErrorCode(-1);
        }

        echo $this->webResponse->getJSONResponse();
    }

}
