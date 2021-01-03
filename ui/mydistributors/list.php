<div class="subheader subheader-transparent" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">

                <div class="d-flex flex-column text-dark-75">
                    <h2 class="text-dark font-weight-bolder mr-5 line-height-xl">
                    <span class="svg-icon svg-icon-xxl mr-1">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"/>
                                <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
					</span>
                        My Distributors
                    </h2>

                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:;" class="btn btn-primary font-weight-bold font-size-base" onclick="WebApp.showModal('#modalInviteDistributor')">Add My Distributors</a>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInviteDistributor"   data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="frmInviteDistributor" class="form">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Invite My Distributor</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bold text-dark">Distributor country</label>
                        <select class="form-control select2" id="kt_selectCountry" name="countryId">
                            <option label="Label"></option>
                            <?php foreach ($arrCountries as $objCountry): ?>
                                <option value="<?php echo $objCountry->ID?>"><?php echo $objCountry->Name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bold text-dark">Distributor name</label>
                        <input class="form-control h-auto py-3 px-6" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bold text-dark">Distributor email address</label>
                        <input class="form-control h-auto py-3 px-6" type="text" name="email">
                    </div>

                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bold text-dark">Invitation message</label>
                        <textarea class="form-control" rows="4" name="message">Join my network at Aumet OnEx</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send Invitation</button>
                    <button type="button" class="btn btn-secondary" onclick="WebApp.hideModal('#modalInviteDistributor')">Cancel</button>
                </div>
            </form>

        </div>

    </div>
</div>
<script>

    $('#kt_selectCountry').select2({
        placeholder: "Select a country"
    });

    function fnCallbackInviteDistributor(webReponse){
        WebApp.hideModal('#modalInviteDistributor');
        webReponse.errorCode == 0 ? WebApp.alertSuccess(webReponse.message) : WebApp.alertError(webReponse.message);

        WebApp.loadPartialPage('#pendingInvitationsTimelineContainer', 'mydistributors/pendinginvitations');
    }

    $( '#frmInviteDistributor' ).submit(function ( e ) {
        e.preventDefault();
        WebApp.postFormData('#frmInviteDistributor','mydistributors/invite', (new FormData(this)), fnCallbackInviteDistributor)
    });


</script>

<style>
    #pendingInvitationsTimeline::before {
        left: 100.05px;
        width: 0 !important;
    }
</style>

<?php if(count($arrManufacturerDistributors) == 0): ?>
<div class="d-flex flex-column-fluid pt-10">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="text-center pt-15">
                    <h1 class="h1 font-weight-bold text-dark mb-15">You didn't add any of your distributors yet</h1>
                    <div class="h3 text-dark-50 font-weight-normal mb-20">
                        <a href="javascript:;" class="btn btn-lg btn-primary  h3 py-2 px-6" onclick="WebApp.showModal('#modalInviteDistributor')">Start inviting your distributors</a>
                    </div>
                    <div class="row text-center">
                        <div class="offset-lg-4 offset-md-3 col-lg-4 col-md-5 justify-content-center ">
                            <span class="svg-icon svg-icon-full">
                                <svg id="a0aa7367-9b86-4056-8781-911de8774112" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="804.11422" height="578.06338" viewBox="0 0 804.11422 578.06338"><path d="M539.19287,430.71826h-325a16.51867,16.51867,0,0,1-16.5-16.5v-237a16.51868,16.51868,0,0,1,16.5-16.5h325a16.51867,16.51867,0,0,1,16.5,16.5v237A16.51866,16.51866,0,0,1,539.19287,430.71826Z" transform="translate(-197.69287 -160.71826)" fill="#e6e6e6"/><polygon points="318.63 269.5 316.4 269.5 281.96 200.12 280.96 198.12 255.49 146.8 212.33 59.85 211.34 57.85 182.87 0.5 185.11 0.5 213.57 57.85 214.57 59.85 256.63 144.59 257.62 146.59 283.08 197.87 318.63 269.5" fill="#fff"/><rect x="0.50004" y="57.85459" width="357" height="2" fill="#fff"/><rect x="255.91899" y="144.59482" width="101.58105" height="2" fill="#fff"/><rect x="95.51579" y="0.50009" width="2" height="270" fill="#fff"/><rect x="96.51579" y="198.11728" width="186.06213" height="2" fill="#fff"/><path d="M410.6929,266.71837c0,17.04569-25.068,65.11393-34.48306,82.56633a3.99424,3.99424,0,0,1-7.03387,0c-9.41507-17.4524-34.48307-65.52064-34.48307-82.56633a38,38,0,0,1,76,0Z" transform="translate(-197.69287 -160.71826)" fill="#00bfa6"/><circle cx="175.00003" cy="106.0001" r="17" fill="#e6e6e6"/><circle cx="175.00003" cy="200.0001" r="7" fill="#00bfa6"/><path d="M372.96293,465.57834a38.735,38.735,0,1,0,38.73,38.73A38.775,38.775,0,0,0,372.96293,465.57834Zm0,75.33a36.595,36.595,0,1,1,36.58985-36.6A36.64309,36.64309,0,0,1,372.96293,540.90836Z" transform="translate(-197.69287 -160.71826)" fill="#e6e6e6"/><path d="M392.023,485.73837a5.01621,5.01621,0,0,0-7.03027.93l-17.27979,22.53-7.31006-5.6a5.01432,5.01432,0,1,0-6.10009,7.96l11.29,8.64.05029.04a4.984,4.984,0,0,0,3,1,5.03645,5.03645,0,0,0,3.98974-1.96l20.31983-26.51A5.01658,5.01658,0,0,0,392.023,485.73837Z" transform="translate(-197.69287 -160.71826)" fill="#00bfa6"/><path d="M748.44291,582.09836l-9.6499-22.88-8.28027-19.63-6.77-16.06a11.69417,11.69417,0,0,0-15.29981-6.22l-92.04,38.83a11.7217,11.7217,0,0,0-6.21972,15.29l24.71,58.57a11.66915,11.66915,0,0,0,15.29,6.22l92.04-38.82A11.69385,11.69385,0,0,0,748.44291,582.09836Zm-7.23,12.91-92.02978,38.82a9.08778,9.08778,0,0,1-11.90039-4.83l-24.71-58.57a8.98934,8.98934,0,0,1-.40967-5.79,8.71015,8.71015,0,0,1,1.02-2.44,9.06342,9.06342,0,0,1,4.23-3.67l92.03955-38.82a9.04553,9.04553,0,0,1,5.92041-.39,8.63506,8.63506,0,0,1,2.40967,1.06,8.98486,8.98486,0,0,1,3.56006,4.16l7.08007,16.79v.01l7.66993,18.17,9.96,23.6A9.08642,9.08642,0,0,1,741.21293,595.00833Z" transform="translate(-197.69287 -160.71826)" fill="#ccc"/><path d="M678.598,576.44641a13.02518,13.02518,0,0,1-7.78743.75018L611.00716,564.3891l.54357-2.53654,59.80346,12.80749a10.49372,10.49372,0,0,0,10.92819-4.50948l33.98391-52.19736,2.17448,1.41611-33.98391,52.19736A13.0239,13.0239,0,0,1,678.598,576.44641Z" transform="translate(-197.69287 -160.71826)" fill="#ccc"/><circle cx="480.77191" cy="415.70393" r="15.56757" fill="#00bfa6"/><path d="M849.97334,424.53821s-20.2536-12.79174-39.44121,2.132L797.74038,559.9175s47.969,37.30926,59.69481,2.132Z" transform="translate(-197.69287 -160.71826)" fill="#00bfa6"/><polygon points="657.225 566.679 669.485 566.679 673.568 519.563 657.223 519.391 657.225 566.679" fill="#ffb8b8"/><path d="M852.29122,723.89389h38.53072a0,0,0,0,1,0,0v14.88687a0,0,0,0,1,0,0H867.1781a14.88688,14.88688,0,0,1-14.88688-14.88688v0A0,0,0,0,1,852.29122,723.89389Z" transform="translate(1545.45366 1301.91661) rotate(179.99738)" fill="#2f2e41"/><polygon points="612.912 566.679 600.652 566.679 594.819 519.391 612.914 519.391 612.912 566.679" fill="#ffb8b8"/><path d="M591.89469,563.17563h23.64384a0,0,0,0,1,0,0V578.0625a0,0,0,0,1,0,0H577.00781a0,0,0,0,1,0,0v0A14.88688,14.88688,0,0,1,591.89469,563.17563Z" fill="#2f2e41"/><path d="M881.41971,560.45049,870.75992,719.28132l-16.52267-.533L832.38469,591.36388l-20.2536,125.78548-19.18761,1.066-5.3299-164.16072S868.628,535.933,881.41971,560.45049Z" transform="translate(-197.69287 -160.71826)" fill="#2f2e41"/><circle cx="633.4267" cy="225.77566" r="24.56103" fill="#ffb8b8"/><path d="M846.24241,419.74131l6.39588,4.26391s26.64946,0,28.78142,15.98968,7.99484,125.2525,1.599,125.2525-7.46185-8.52783-7.46185-8.52783-4.26392,1.066-12.79175,9.59381-13.85772,8.52783-17.05566-4.26392S821.19191,451.18768,841.44551,433.066Z" transform="translate(-197.69287 -160.71826)" fill="#2f2e41"/><path d="M815.329,419.74131l-6.39587,4.26391s-26.64947,0-28.78143,15.98968-7.99484,125.2525-1.599,125.2525,7.46185-8.52783,7.46185-8.52783,4.26391,1.066,12.79174,9.59381,13.85772,8.52783,17.05566-4.26392,24.51751-110.86178,4.26391-128.98342Z" transform="translate(-197.69287 -160.71826)" fill="#2f2e41"/><path d="M851.04779,401.46987a13.36948,13.36948,0,0,0-10.14531-22.56406c-3.39627.11351-6.59648,1.50343-9.83795,2.52344a32.53459,32.53459,0,0,1-15.28491,1.37639A20.40973,20.40973,0,0,1,802.7632,375.12c-3.03878-4.17652-3.98636-9.9694-1.83961-14.66717,2.47835-5.42343,8.26757-8.41183,13.71368-10.83993a25.06262,25.06262,0,0,1,6.9624-2.28755,8.92877,8.92877,0,0,1,6.92635,1.746c1.53041,1.31629,2.42737,3.29482,4.09275,4.43555,1.87468,1.28409,4.3099,1.25039,6.57089,1.47672a25.20452,25.20452,0,0,1,12.20761,45.54Z" transform="translate(-197.69287 -160.71826)" fill="#2f2e41"/><path d="M725.74994,550.93014a10.74267,10.74267,0,0,1,10.10408-13.0098l16.31829-22.98459,10.51809,10.71349-15.57357,23.38007a10.80091,10.80091,0,0,1-21.36689,1.90083Z" transform="translate(-197.69287 -160.71826)" fill="#ffb8b8"/><path d="M870.38525,571.91211a10.7427,10.7427,0,0,1,.87606-16.44932l.28893-28.18678,14.75058,2.79812.54832,28.08671a10.80091,10.80091,0,0,1-16.46389,13.75127Z" transform="translate(-197.69287 -160.71826)" fill="#ffb8b8"/><path d="M788.07944,505.33736l-4.19678-66.94143-1.18975-4.67757s-42.4316,54.563-42.53086,95.6105c0,0,20.78659,10.12679,23.98452,2.66494,1.256-2.93071,5.54634-7.27544,23.93287-26.65644Z" transform="translate(-197.69287 -160.71826)" fill="#2f2e41"/><path d="M877.68878,438.39593l3.83519,2.4302s13.73734,60.45519,10.02254,100.96974c0,0-21.85257,10.12679-25.0505,2.66494S877.68878,438.39593,877.68878,438.39593Z" transform="translate(-197.69287 -160.71826)" fill="#2f2e41"/><path d="M1000.80709,738.71836h-381a1,1,0,0,1,0-2h381a1,1,0,0,1,0,2Z" transform="translate(-197.69287 -160.71826)" fill="#3f3d56"/></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4" id="pendingInvitationsTimelineContainer">

            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="d-flex flex-column-fluid pt-10">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <?php foreach ($arrManufacturerDistributors as $objManufacturerDistributor): ?>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="card card-custom gutter-b card-stretch">
                                    <div class="card-body pt-4">

                                        <div class="d-flex align-items-end mb-7">

                                            <div class="d-flex align-items-center">

                                                <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                                    <div class="symbol symbol-circle symbol-lg-75">
                                                        <img src="<?php echo $objManufacturerDistributor->logo != null ? $objManufacturerDistributor->logo : '/assets/img/company.svg' ?>" alt="<?php echo $objManufacturerDistributor->name ?>">
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:;" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0" onclick="WebApp.loadPage('browse/distributor/<?php echo $objManufacturerDistributor->distributorCompanyId ?>')"><?php echo $objManufacturerDistributor->name ?></a>
                                                    <span class="text-muted font-weight-bold"><?php echo $objManufacturerDistributor->regionName ?>, <?php echo $objManufacturerDistributor->countryName ?></span>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="mb-7">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-dark font-weight-bolder mr-2">Email:</span>
                                                <a href="#" class="text-dark text-hover-primary"><?php echo $objManufacturerDistributor->objUser->Email ?></a>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-cente my-1">
                                                <span class="text-dark font-weight-bolder mr-2">Position:</span>
                                                <a href="#" class="text-dark text-hover-primary"><?php echo $objManufacturerDistributor->objUser->JobTitle ?></a>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="card-footer justify-content-end align-content-end">
                                        <a href="javascript:;" class="btn btn-primary font-weight-bolder py-4 mr-5" onclick="WebApp.loadPage('inbox')">View Inquiries</a>
                                        <a href="javascript:;" class="btn btn-primary font-weight-bolder py-4" onclick="WebApp.loadPage('inbox')">Schedule a Call</a>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-4" id="pendingInvitationsTimelineContainer">

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    WebApp.loadPartialPage('#pendingInvitationsTimelineContainer', 'mydistributors/pendinginvitations');
</script>
