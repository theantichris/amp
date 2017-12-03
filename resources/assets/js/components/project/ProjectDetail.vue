<!--suppress HtmlUnknownAnchorTarget -->
<template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Project
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="detail-group col-xs-12">
                        <div class="detail-label">Status</div>
                        <div>{{ project.status }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Customer</div>
                        <div>{{ project.customer }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Manager</div>
                        <div>{{ project.manager }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Name</div>
                        <div>{{ project.name }}</div>
                    </div>
                </div>

                <comments :model="'projects'" :project-id="project.id" :comments="project.comments"></comments>

                <fieldset>
                    <legend>History</legend>

                    <div class="row" v-for="history in project.history">
                        <div class="detail-group col-xs-12">
                            {{ history }}
                        </div>
                    </div>
                </fieldset>

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
    import Comments from '../comments/Comment';

    export default {
        components: {Comments},
        props: ['project'],
    }
</script>