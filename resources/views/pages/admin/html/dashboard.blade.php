<div class="row">
    <h2 class="mb-2">Dashboard</h2>
    <div class="overview-card-body col-md-12">
        <div class="row">
            <div class="podcast-container">
                <p><span>{{ getTodayJob() }}</span> Today Apply Job</p>
            </div>
            <div class="podcast-container dashboard-total-user">
                <p><span>{{ getTotalUser() }}</span> Total Users</p>
            </div>
            <div class="webminar-container">
                <p><span>{{ getJobByStatus(1) }}</span> Total Applied Job</p>
            </div>
            <div class="webminar-container mt-2">
                <p><span>{{ getJobByStatus(7) }}</span> Total Rejected Job</p>
            </div>
            <div class="podcast-container mt-2">
                <p><span>{{ getJobByStatus(2) }}</span> Total Selected Job</p>
            </div>            
            <div class="podcast-container dashboard-total-user mt-2">
                <p><span>{{ getJobByStatus(3) }}</span> Total Screening Job</p>
            </div>
            <div class="podcast-container mt-2">
                <p><span>{{ getJobByStatus(4) }}</span> Total Offered Job</p>
            </div>
            <div class="podcast-container dashboard-total-user mt-2">
                <p><span>{{ getJobByStatus(6) }}</span> Total Joined Job</p>
            </div>
        </div>
    </div>
</div>
