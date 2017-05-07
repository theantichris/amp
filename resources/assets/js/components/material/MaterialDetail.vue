<!--suppress HtmlUnknownAnchorTarget -->
<template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Material
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Name</div>
                        <div>{{ material.name }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Cost</div>
                        <div>{{ material.cost }} {{ material.weight_unit }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Density</div>
                        <div>{{ material.density }} {{ material.density_unit }}</div>
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
        props: ['material'],
    }
</script>