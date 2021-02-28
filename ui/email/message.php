<!-- hero-primary-icon-outline -->
<table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
    <tbody>
    <tr>
        <td class="o_bg-light o_px-xs" align="center" style="padding-left: 8px;padding-right: 8px;">
            <!--[if mso]><table width="800" cellspacing="0" cellpadding="0" border="0" role="presentation"><tbody><tr><td><![endif]-->
            <table class="o_block-lg" width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="max-width: 800px;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="o_bg-primary o_px-md o_py-xl o_xs-py-md" align="center" style="background-color: #04BBA5;padding-left: 24px;padding-right: 24px;padding-top: 64px;padding-bottom: 64px;">
                        <!--[if mso]><table width="584" cellspacing="0" cellpadding="0" border="0" role="presentation"><tbody><tr><td align="center"><![endif]-->
                        <div class="o_col-6s o_center o_sans o_text-md o_text-white" style="font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 19px;line-height: 28px;max-width: 584px;text-align: center;">
                            <table class="o_center" cellspacing="0" cellpadding="0" border="0" role="presentation" style="text-align: center;margin-left: auto;margin-right: auto;">
                                <tbody>
                                <tr>
                                    <td class="o_sans o_text o_text-white o_b-white o_px o_py o_br-max" align="center" style="font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;color: #ffffff;border: 2px solid #ffffff;border-radius: 96px;padding-left: 16px;padding-right: 16px;padding-top: 16px;padding-bottom: 16px;">
                                        <img src="https://res.cloudinary.com/dztx993tt/image/upload/v1610873806/message-48-white_rxgcdv.png" width="48" height="48" alt="" style="max-width: 48px;-ms-interpolation-mode: bicubic;vertical-align: middle;border: 0;line-height: 100%;height: auto;outline: none;text-decoration: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 24px; line-height: 24px; height: 24px;">&nbsp; </td>
                                </tr>
                                </tbody>
                            </table>
                            <h2 class="o_heading o_mb-xxs" style="font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 4px;font-size: 30px;line-height: 39px; color: white;">You Have a New Message</h2>
                            <p style="margin-top: 0px;margin-bottom: 0px; color: white;">From a <?php echo $companyType ?> <!--in --><?php /*echo $countryName */?></p>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                    </td>
                </tr>
                </tbody>
            </table>
            <!--[if mso]></td></tr></table><![endif]-->
        </td>
    </tr>
    </tbody>
</table>
<!-- message_images -->
<table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
    <tbody>
    <tr>
        <td class="o_bg-light o_px-xs" align="left" style="background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;">
            <!--[if mso]><table width="800" cellspacing="0" cellpadding="0" border="0" role="presentation"><tbody><tr><td><![endif]-->
            <table class="o_block-lg" width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="max-width: 800px;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="o_bg-white o_px-md o_py-md" align="center" style="background-color: #ffffff;padding-left: 24px;padding-right: 24px;padding-top: 24px;padding-bottom: 24px;">
                        <!--[if mso]><table width="584" cellspacing="0" cellpadding="0" border="0" role="presentation"><tbody><tr><td align="left"><![endif]-->
                        <div class="o_col-6s o_left o_sans o_text o_text-secondary" style="font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;max-width: 584px;color: #424651;text-align: left;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                <tbody>
                                <tr>
                                    <td width="48" class="o_bb-light o_text-md o_text-secondary o_sans o_py" align="right" style="vertical-align: top;font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 19px;line-height: 28px;color: #424651;border-bottom: 1px solid #d3dce0;padding-top: 16px;padding-bottom: 16px;">
                                        <img class="o_br-max" src="<?php echo $userPic; ?>" width="48" height="48" alt="" style="max-width: 48px;-ms-interpolation-mode: bicubic;vertical-align: middle;border: 0;line-height: 100%;max-height: 48px;outline: none;text-decoration: none;border-radius: 96px;">
                                    </td>
                                    <td class="o_bb-light o_text o_text-secondary o_sans o_px o_py" align="left" style="vertical-align: top;font-family: Helvetica, Arial, sans-serif;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;color: #424651;border-bottom: 1px solid #d3dce0;padding-left: 16px;padding-right: 16px;padding-top: 16px;padding-bottom: 16px;">
                                        <p style="margin-top: 0px;margin-bottom: 0px;"><strong class="o_text-dark" style="color: #242b3d;"><?php echo $fromName ?></strong></p>
                                        <?php
                                        $day = date('l', strtotime($objMessage->createdAt));
                                        $d = date('d', strtotime($objMessage->createdAt));
                                        $month = date('j M ', strtotime($objMessage->createdAt));
                                        $year = date('Y', strtotime($objMessage->createdAt));
                                        ?>
                                        <p class="o_text-xxs o_text-light" style="font-size: 12px;line-height: 19px;color: #82899a;margin-top: 0px;margin-bottom: 0px;"><?php echo date('h:i A', strtotime($objMessage->createdAt)); ?> <?php echo $day; ?>, <?php $month ?> <?php echo $d; ?> <?php echo $year; ?></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="font-size: 24px; line-height: 24px; height: 24px;">&nbsp; </div>
                            <p class="o_mb-xs" style="margin-top: 0px;margin-bottom: 8px;"><?php echo $objMessage->subject ? $objMessage->subject : 'Hello,'; ?></p>
                            <p class="o_mb-xs" style="margin-top: 0px;margin-bottom: 8px;"><?php echo ($objMessage->content ? html_entity_decode($objMessage->content) : ''); ?></p>
                            <div style="font-size: 16px; line-height: 16px; height: 16px;">&nbsp; </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                    </td>
                </tr>
                </tbody>
            </table>
            <!--[if mso]></td></tr></table><![endif]-->
        </td>
    </tr>
    </tbody>
</table>
<!-- buttons -->
<table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
    <tbody>
    <tr>
        <td class="o_bg-light o_px-xs" align="center" style="background-color: #dbe5ea;padding-left: 8px;padding-right: 8px;">
            <!--[if mso]><table width="800" cellspacing="0" cellpadding="0" border="0" role="presentation"><tbody><tr><td><![endif]-->
            <table class="o_block-lg" width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="max-width: 800px;margin: 0 auto;">
                <tbody>
                <tr>
                    <td class="o_bg-white o_px o_pb-md" align="center" style="background-color: #ffffff;padding-left: 16px;padding-right: 16px;padding-bottom: 24px;">
                        <!--[if mso]><table cellspacing="0" cellpadding="0" border="0" role="presentation"><tbody><tr><td align="center" valign="top" style="padding:0px 8px;"><![endif]-->
                        <div class="o_col_i" style="display: inline-block;vertical-align: top;">
                            <div style="font-size: 24px; line-height: 24px; height: 24px;">&nbsp; </div>
                            <div class="o_px-xs" style="padding-left: 8px;padding-right: 8px;">
                                <table align="center" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                    <tbody>
                                    <tr>
                                        <td class="o_btn o_bg-primary o_br o_heading o_text" align="center" style="font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;mso-padding-alt: 12px 24px;background-color: #242b3d;border-radius: 4px;">
                                            <a class="o_text-white" href="<?php echo $rootDomainUrl ?>/<?php echo $LANGUAGE ?>/<?php echo ($companySlug ? $companySlug : 'browse/distributor/'.$objMessage->fromCompanyId); ?>" style="text-decoration: none;outline: none;color: #ffffff;display: block;padding: 12px 24px;mso-text-raise: 3px;">View Company</a>
                                            <a class="o_text-white" href="<?php echo $rootDomainUrl ?>/browse/distributor/<?php echo $objMessage->fromCompanyId ?>" style="text-decoration: none;outline: none;color: #ffffff;display: block;padding: 12px 24px;mso-text-raise: 3px;">View Company</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--[if mso]></td><td align="center" valign="top" style="padding:0px 8px;"><![endif]-->
                        <div class="o_col_i" style="display: inline-block;vertical-align: top;">
                            <div style="font-size: 24px; line-height: 24px; height: 24px;">&nbsp; </div>
                            <div class="o_px-xs" style="padding-left: 8px;padding-right: 8px;">
                                <table align="center" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                    <tbody>
                                    <tr>
                                        <td class="o_btn o_bg-dark o_br o_heading o_text" align="center" style="font-family: Helvetica, Arial, sans-serif;font-weight: bold;margin-top: 0px;margin-bottom: 0px;font-size: 16px;line-height: 24px;mso-padding-alt: 12px 24px;background-color: #04BBA5;border-radius: 4px;">
                                            <a class="o_text-white" href="<?php echo $rootDomainUrl ?>/<?php echo $LANGUAGE ?>/inbox/<?php echo $objMessage->id ?>" style="text-decoration: none;outline: none;color: #ffffff;display: block;padding: 12px 24px;mso-text-raise: 3px;">Reply to Message</a>
                                            <a class="o_text-white" href="<?php echo $rootDomainUrl ?>/en/inbox" style="text-decoration: none;outline: none;color: #ffffff;display: block;padding: 12px 24px;mso-text-raise: 3px;">Reply to Message</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--[if mso]></td></tr></table><![endif]-->
                    </td>
                </tr>
                </tbody>
            </table>
            <!--[if mso]></td></tr></table><![endif]-->
        </td>
    </tr>
    </tbody>
</table>