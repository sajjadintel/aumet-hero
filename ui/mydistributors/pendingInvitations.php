<div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
        <h3 class="card-title align-items-start flex-column">
            <span class="font-weight-bolder text-dark">Pending Invitations</span>
            <span class="text-muted mt-3 font-weight-bold font-size-base"><?php echo count($arrPendingInvitations) ?> invitations</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-4" >
        <!--begin::Timeline-->
        <div class="timeline timeline-6 mt-3" id="pendingInvitationsTimeline">
            <?php foreach ($arrPendingInvitations as $item): ?>
                <div class="timeline-item align-items-start">
                    <!--begin::Label-->
                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg" style="width: 100px !important;">
                        <?php $t = strtotime($item->createdAt);
                        echo date('d/m H:i',$t); ?></div>
                    <!--end::Label-->
                    <!--begin::Badge-->
                    <div class="timeline-badge">
                        <i class="fa fa-genderless text-primary icon-xl"></i>
                    </div>
                    <!--end::Badge-->
                    <!--begin::Text-->
                    <div class="font-weight-mormal font-size-lg timeline-content text-dark-50 pl-3"><?= $item->name ?> at <?= $item->email ?></div>
                    <!--end::Text-->
                </div>
            <?php endforeach; ?>
        </div>
        <!--end::Timeline-->
    </div>
    <!--end: Card Body-->
</div>