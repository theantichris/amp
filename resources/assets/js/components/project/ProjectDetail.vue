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
                        <div>{{ project.customer ? project.customer.company_name : 'Internal' }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Manager</div>
                        <div>{{ project.manager.name }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Name</div>
                        <div>{{ project.name }}</div>
                    </div>
                </div>

                <fieldset>
                    <legend>History</legend>

                    <div class="row" v-for="audit in project.audits">
                        <div class="detail-group col-xs-12">
                            <div v-if="audit.event === 'created'">
                                {{ audit.user.name }} {{ audit.event }} the project on {{ audit.created_at }}
                            </div>

                            <div v-if="audit.event === 'updated'">
                                {{ audit.user.name }} {{ audit.event }} the following information on {{ audit.created_at
                                }}:
                                <ul>
                                    <li v-for="(item, index) in audit.new_values">
                                        {{ index }} to {{ item }} from {{ audit.old_values[index] }}
                                    </li>
                                </ul>
                            </div>
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
    export default {
        props: ['project'],
    }
</script>