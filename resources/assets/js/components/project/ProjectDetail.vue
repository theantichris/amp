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
                        <div>
                            {{ project.customer && project.customer.company_name ? project.customer.company_name :
                            'Internal' }}
                        </div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-4">
                        <div class="detail-label">Manager</div>
                        <div>{{ project.manager ? project.manager.name : '' }}</div>
                    </div>
                </div>

                <div class="row" v-show="project.status !== 'New'">
                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Production Cost</div>
                        <div>{{ project.production_cost | currency }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-6">
                        <div class="detail-label">Production Cost</div>
                        <div>{{ project.sales_price | currency }}</div>
                    </div>
                </div>

                <parts :project-id="project.id"
                       :parts="parts"
                       v-on:partSaved="handlePartSaved"/>

                <comments :model="'projects'"
                          :model-id="project.id"
                          :comments="comments"
                          v-on:commentSaved="handleCommentSaved"/>

                <!-- TODO: Pull into component -->
                <fieldset>
                    <legend>History</legend>

                    <div class="row">
                        <div class="detail-group col-xs-12">
                            <ul class="list-group">
                                <li class="list-group-item" v-for="item in history">
                                    {{ item.user.name }} {{ item.event }} on {{ item.created_at.date | datetime }}.
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
                           v-on:click="$parent.initForm(true, null)">
                            <i class="fa fa-edit"></i> Edit
                        </a>

                        <a href="#form"
                           aria-controls="form"
                           role="tab"
                           data-toggle="tab"
                           class="btn btn-success"
                           title="Ready To Quote"
                           v-show="project.status === 'New' && parts.length > 0"
                           v-on:click="$parent.initForm(true, 'Ready To Quote')">
                            <i class="fa fa-arrow-circle-right"></i> Ready To Quote
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Comments from '../comments/Comments';
    import Parts from './part/Parts';

    export default {
        components: {Comments, Parts},

        props: ['project', 'parts', 'comments', 'history'],

        methods: {
            handleCommentSaved: function () {
                this.$emit('commentSaved');
            },

            handlePartSaved: function () {
                this.$emit('partSaved');
            }
        }
    }
</script>