<?php
$f3->route('GET /@language/auth/signin', 'AuthController->getSignIn');
$f3->route('POST /@language/auth/signin', 'AuthController->postSignIn');

$f3->route('GET /@language/auth/forgot', 'AuthController->getForgottenPassword');
$f3->route('POST /@language/auth/forgot', 'AuthController->postForgottenPassword');
$f3->route('GET /@language/auth/reset/@resetCode', 'AuthController->getForgottenPasswordReset');
$f3->route('POST /@language/auth/reset', 'AuthController->postForgottenPasswordReset');

$f3->route('GET /@language/settings/email/unsubscribe/@email', 'UserController->getUnsubEmail');

$f3->route('GET /@language/auth/signout', 'AuthController->getSignOut');

$f3->route('GET /@language/admin/betacustomers', 'AdminController->getBetaCustomers');
$f3->route('GET /@language/admin/impersonate/@companyId', 'AdminController->getImpersonateCompany');

$f3->route('GET /', 'AuthController->getHome');
$f3->route('GET /@language', 'AuthController->getHome');

$f3->route('GET /@language/database/compare', 'ITController->getComparePage');

$f3->route('GET /@language/dashboard', 'DashboardController->get');

$f3->route('GET /@language/manufacturers', 'CompanyController->getManufacturersPage');
$f3->route('POST /@language/manufacturers/datatable', 'CompanyController->getManufacturersRecords');
$f3->route('GET /@language/manufacturers/@companyId', 'CompanyController->getManufacturerCompanyProfile');

$f3->route('GET /@language/distributors', 'CompanyController->getDistributorsPage');
$f3->route('POST /@language/distributors/datatable', 'CompanyController->getDistributorsRecords');
$f3->route('GET /@language/distributors/@companyId', 'CompanyController->getDistributorCompanyProfile');

$f3->route('POST /pipedrive/api/organization', 'PipedriveWebHooksController->processWebhookOrganization');
$f3->route('POST /pipedrive/api/user', 'PipedriveWebHooksController->processWebhookUser');
$f3->route('POST /pipedrive/api/deal', 'PipedriveWebHooksController->processWebhookDeal');
$f3->route('POST /pipedrive/api/activity', 'PipedriveWebHooksController->processWebhookActivity');
$f3->route('POST /pipedrive/api/activityType', 'PipedriveWebHooksController->processWebhookActivityType');
$f3->route('POST /pipedrive/api/note', 'PipedriveWebHooksController->processWebhookNote');
$f3->route('POST /pipedrive/api/person', 'PipedriveWebHooksController->processWebhookPerson');
$f3->route('POST /pipedrive/api/pipeline', 'PipedriveWebHooksController->processWebhookPipline');
$f3->route('POST /pipedrive/api/product', 'PipedriveWebHooksController->processWebhookProduct');
$f3->route('POST /pipedrive/api/stage', 'PipedriveWebHooksController->processWebhookStage');

$f3->route('GET /airtable/api/record', 'AirtableScriptsController->processCall');















$f3->route('GET /@language/mysalesnetwork/region/@regionId/distributors', 'DemoController->get_mysalesnetwork_region_distributors');
$f3->route('GET /@language/mysalesnetwork/region/@regionId/targetedcountries', 'DemoController->get_mysalesnetwork_region_targetedcountries');

$f3->route('GET /@language/mysalesnetwork/region/@regionId/country/@countryId', 'DemoController->get_mysalesnetwork_region_country');

$f3->route('GET /@language/demo/start', 'DemoController->getStartDemo');
$f3->route('GET /@language/demo/set/@companyId', 'DemoController->getSetDemoCompany');
$f3->route('POST /@language/demo/setup', 'DemoController->postSetupDemoCompany');

$f3->route('GET /@language/profile/countries/targeted', 'ProfileController->getTargetedCountries');
$f3->route('POST /@language/profile/countries/targeted', 'ProfileController->postTargetedCountries');
$f3->route('POST /@language/profile/countries/targeted/@countryId/remove', 'ProfileController->postRemoveTargetedCountry');

// Calls
$f3->route('GET /@language/calls', 'CallController->get');
$f3->route('GET /@language/potentialdistributors', 'PotentialDistributorController->getWorkspace');
$f3->route('GET /@language/potentialdistributors/list', 'PotentialDistributorController->getList');
$f3->route('POST /@language/potentialdistributors/addSuggestedToTargetedCountries', 'PotentialDistributorController->postAddSuggestedToTargetedCountries');

$f3->route('GET /@language/potentialdistributors/country/@countryId', 'PotentialDistributorController->getPotentialDistributorsByCountry');

$f3->route('GET /@language/potentialdistributors/country/@countryId/sendintroduction/@companyId', 'IntroductionController->getSendPotentialDistributorIntroduction');
$f3->route('POST /@language/potentialdistributors/country/@countryId/sendintroduction/@companyId', 'IntroductionController->postSendPotentialDistributorIntroduction');

$f3->route('GET /@language/potentialdistributors/country/@countryId/sendintroduction/@companyId/products', 'IntroductionController->getSendPotentialDistributorIntroductionProducts');
$f3->route('POST /@language/potentialdistributors/country/@countryId/sendintroduction/@companyId/products/update', 'IntroductionController->postSendPotentialDistributorIntroductionUpdateProducts');

$f3->route('GET /@language/introductions/@introductionId', 'IntroductionController->getViewIntroduction');
$f3->route('GET /@language/view-introduction/@introductionId', 'IntroductionController->getNewViewIntroduction');
$f3->route('GET /@language/introductions', 'IntroductionController->getSentIntroductions');

$f3->route('GET /@language/mydistributors', 'DistributorController->getMyDistributors');
$f3->route('POST /@language/mydistributors/invite', 'DistributorController->postInviteMyDistributor');
$f3->route('GET /@language/mydistributors/pendinginvitations', 'DistributorController->getMyPendingInvitations');


$f3->route('GET /@language/mycompanyprofile', 'CompanyController->getMyCompanyProfile');
$f3->route('GET /@language/mycompanyprofile/edit', 'CompanyController->getEditMyCompanyProfile');
$f3->route('GET /@language/mycompanyprofile/edit/companyinformation', 'CompanyController->getEditMyCompanyProfileSection_CompanyInformation');
$f3->route('POST /@language/mycompanyprofile/edit/companyinformation', 'CompanyController->postEditMyCompanyProfileSection_CompanyInformation');
$f3->route('GET /@language/mycompanyprofile/edit/personalinformation', 'CompanyController->getEditMyCompanyProfileSection_PersonalInformation');
$f3->route('POST /@language/mycompanyprofile/edit/personalinformation', 'CompanyController->postEditMyCompanyProfileSection_PersonalInformation');
$f3->route('GET /@language/mycompanyprofile/edit/businessinformation', 'CompanyController->getEditMyCompanyProfileSection_BusinessInformation');
$f3->route('POST /@language/mycompanyprofile/edit/businessinformation', 'CompanyController->postEditMyCompanyProfileSection_BusinessInformation');
$f3->route('GET /@language/mycompanyprofile/edit/documents', 'CompanyController->getEditMyCompanyProfileSection_Documents');
$f3->route('POST /@language/mycompanyprofile/edit/documents', 'CompanyController->getEditMyCompanyProfileSection_Documents');
$f3->route('POST /@language/mycompanyprofile/edit/documents/@documentTypeId/upload', 'CompanyController->postEditMyCompanyProfileSection_UploadDocument');
$f3->route('GET /@language/mycompanyprofile/edit/pictures', 'CompanyController->getEditMyCompanyProfileSection_pictures');
$f3->route('GET /@language/mycompanyprofile/edit/pictures/list', 'CompanyController->getMyCompanyProfileSection_PicturesList');
$f3->route('POST /@language/mycompanyprofile/edit/pictures/upload', 'CompanyController->postMyCompanyProfileSection_UploadPictures');
$f3->route('GET /@language/mycompanyprofile/edit/documents/@fileId/remove', 'CompanyController->postMyCompanyProfileSection_RemoveFile');
$f3->route('POST /@language/mycompanyprofile/edit/pictures/@photoId/remove', 'CompanyController->postMyCompanyProfileSection_RemoveFile');
$f3->route('POST /@language/mycompanyprofile/edit/banner/upload', 'CompanyController->postMyCompanyProfileSection_UploadBanner');
$f3->route('GET /@language/manufacturer-products/@pagelimit/@totalProducts/@manuId', 'CompanyController->getMyCompanyProducts');
$f3->route('GET /@language/distributor-products/@pagelimit/@totalProducts/@manuId', 'CompanyController->getMyDistributroCompanyProducts');



//routes list for calls/meetings
$f3->route('GET /@language/meetings', 'SchedulemeetingController->getMyMeetings');
$f3->route('POST /@language/meetings/createAMeeting', 'SchedulemeetingController->createAMeeting');
$f3->route('POST /@language/meetings/updateAMeeting', 'SchedulemeetingController->updateAMeeting');
$f3->route('POST /@language/meetings/cancelMeeting', 'SchedulemeetingController->cancelMeeting');
$f3->route('POST /@language/meetings/getFreeSlots', 'SchedulemeetingController->getFreeSlots');
$f3->route('POST /@language/meetings/updateSlotStatus', 'SchedulemeetingController->updateSlotStatus');
$f3->route('POST /@language/meetings/makeWholeDayBusy', 'SchedulemeetingController->makeWholeDayBusy');

//routers list for message
$f3->route('GET /@language/inbox/view/@messageId', 'InboxController->getView');
$f3->route('GET /@language/inbox/list', 'InboxController->getList');
$f3->route('GET /@language/inbox/list/@page', 'InboxController->getList');

$f3->route('GET /@language/inbox/getMark', 'InboxController->getMark');
$f3->route('GET /@language/inbox/getMark/@page', 'InboxController->getMark');

$f3->route('GET /@language/inbox', 'InboxController->getInbox');

$f3->route('GET /@language/inbox/trash', 'InboxController->getTrash');
$f3->route('GET /@language/inbox/trash/@page', 'InboxController->getTrash');

$f3->route('GET /@language/inbox/sent', 'InboxController->getSent');
$f3->route('GET /@language/inbox/sent/@page', 'InboxController->getSent');

$f3->route('GET /@language/inbox/api/contacts', 'InboxController->getInboxContacts');
$f3->route('POST /@language/inbox/post', 'InboxController->postMessage');
$f3->route('POST /@language/inbox/reply', 'InboxController->replyMessage');
$f3->route('POST /@language/inbox/postMark', 'InboxController->postMark');
$f3->route('POST /@language/inbox/delMessage', 'InboxController->deleteMessage');
$f3->route('POST /@language/inbox/readMessage', 'InboxController->readMessage');

$f3->route('POST /@language/api/message/send', 'InboxController->postSendMessageDialogue');

$f3->route('GET /@language/myinterests', 'InterestController->getMyInterests');
$f3->route('POST /@language/myinterests/data', 'InterestController->postGetMyInterestsData');
$f3->route('GET /@language/myinterests/add-products', 'InterestController->getAddProducts');
$f3->route('POST /@language/myinterests/attach-new-products', 'InterestController->attachNewProducts');
$f3->route('GET /@language/myinterests/deattach-product/@distributorInterestId', 'InterestController->deattachProduct');
$f3->route('GET /@language/myinterests/edit-list/@distributorInterestId', 'InterestController->editProductsView');
$f3->route('GET /@language/myinterests/load-selected-scientific-names/@distributorInterestId', 'InterestController->loadSelectedScientificNamesNyDistributorInterestID');

$f3->route('GET /@language/getSpecialitiesByMedicalId/@medicalLineId', 'SpecialityController->getSpecialityByMedicalId');


$f3->route('GET /@language/explore', 'ExploreController->getSections');
$f3->route('GET /@language/explore/section/speciality/@specialityId/products', 'ExploreController->getSectionSpecialityProducts');
$f3->route('GET /@language/explore/speciality/@specialityId/products', 'ExploreController->getSpecialityPage');

$f3->route('GET /@language/businessopportunities', 'BusinessOpportunitiesController->getBusinessOpportunities');

$f3->route('GET /@language/matching', 'MatchingController->getMatchingRules');
$f3->route('GET /@language/matching/results/@ruleId/@scientificNameID', 'MatchingController->getApplyMatchingRule');

$f3->route('GET /@language/myproducts', 'ProductController->getMyProducts');
$f3->route('GET /@language/myproducts/@productId', 'ProductController->getViewProduct');
$f3->route('POST /@language/myproducts/list', 'ProductController->getMyProductsList');

$f3->route('GET /@language/myproducts/add', 'ProductController->getAddProduct');
$f3->route('POST /@language/myproducts/add', 'ProductController->postAddProduct');
$f3->route('POST /@language/myproducts/add/gallery/upload', 'ProductController->postAddProductImageGallery');

$f3->route('GET /@language/myproducts/@productId/edit', 'ProductController->getEditProduct');
$f3->route('GET /@language/myproducts/@productId/images', 'ProductController->getProductImages');
$f3->route('POST /@language/myproducts/@productId/edit', 'ProductController->postEditProduct');
$f3->route('POST /@language/myproducts/@productId/gallery/upload', 'ProductController->postEditProductImageGallery');

$f3->route('POST /@language/myproducts/@productId/delete', 'ProductController->postDeleteProduct');

$f3->route('GET /@language/myproducts/add-product', 'ProductController->getAddProduct');
$f3->route('POST /@language/myproducts/add-product', 'ProductController->postProduct');
$f3->route('POST /@language/myproducts/product/@productId', 'ProductController->editProduct');
$f3->route('POST /@language/myproducts/uploadfile', 'ProductController->uploadFile');

$f3->route('GET /@language/myproducts/@productId/inline', 'ProductController->getInlineProductProfile');


// Sample Module Routes
$f3->route('GET /@language/sample-module', 'SampleController->getList');

$f3->route('GET /@language/getScientificNameBySpecialityId/@spcialityId', 'ScientificNameController->getScientificNameBySpecialityId');

$f3->route('GET /@language/browse/product/@id', 'PublicAccessController->getProductProfileById');
$f3->route('GET /@productSlug/@manufacturerSlug/@midicalLineSlug/@specilitySlug/@id', 'PublicAccessController->getProductProfileById');


$f3->route('GET /@language/browse/manufacturer/@companyId', 'CompanyController->getManufacturerCompanyProfile');
$f3->route('GET /@language/browse/distributor/@companyId', 'CompanyController->getDistributorCompanyProfile');

$f3->route('GET /@language/api/select/search/scientificnames', 'ScientificNameController->getListPage');
$f3->route('GET /@language/medicalLine/getAll', 'MedicalLineController->getAll');

$f3->route('GET /@language/search', 'SearchController->getHome');
$f3->route('GET /@language/search/products', 'SearchController->getSearchProduct');

//Get inquiries
$f3->route('GET /@language/inquiries', 'InquiryController->getInquiriesPage');
$f3->route('POST /@language/inquiries/datatable', 'InquiryController->getInquiries');
$f3->route('GET /@language/inquiry/@inquiryId', 'InquiryController->getInquiry');
