<!--suppress HtmlUnknownAnchorTarget -->
<template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ project.name }}
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="detail-group col-xs-12 col-md-4">
                        <div class="detail-label">Status</div>
                        <div>{{ project.status }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-4">
                        <div class="detail-label">Customer</div>
                        <div>{{ project.customer }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-4">
                        <div class="detail-label">Manager</div>
                        <div>{{ project.manager }}</div>
                    </div>
                </div>

                <comments :model="'projects'"
                          :model-id="project.id"
                          :comments="comments"
                          v-on:commentSaved="handleCommentSaved"></comments>

                <!-- TODO: Pull into component -->
                <fieldset>
                    <legend>History</legend>

                    <div class="row">
                        <div class="detail-group col-xs-12">
                            <ul class="list-group">
                                <li class="list-group-item" v-for="history in project.history">
                                    {{ history }}
                                </li>
                            </ul>
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
    import Comments from '../comments/Comments';

    export default {
        components: {Comments},
        props: ['project', 'comments'],
        methods: {
            handleCommentSaved: function () {
                this.$emit('commentSaved');
            }
        }
    }
</script>