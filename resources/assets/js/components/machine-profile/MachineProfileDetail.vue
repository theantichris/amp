<!--suppress HtmlUnknownAnchorTarget -->
<template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Machine Profile
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Type</div>
                        <div>{{ machineProfile.type }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Setup Fee</div>
                        <div>${{ machineProfile.setup_fee }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Rate</div>
                        <div>${{ machineProfile.rate }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Time Calculation Method</div>
                        <div>{{ machineProfile.time_calculation_method }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Build Rate</div>
                        <div>{{ machineProfile.build_rate }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <a href="#form"
                           aria-controls="form"
                           role="tab"
                           data-toggle="tab"
                           class="btn btn-primary"
                           title="Edit"
                           v-on:click="$parent.initForm(true)">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['machineProfile'],
    }
</script>