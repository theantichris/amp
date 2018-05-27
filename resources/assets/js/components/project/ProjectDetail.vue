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

                <div class="row">
                    <div class="detail-group col-xs-12 col-md-6" v-show="project.production_cost">
                        <div class="detail-label">Production Cost</div>
                        <div>{{ project.production_cost | currency }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-6" v-show="project.sales_price">
                        <div class="detail-label">Sales Price</div>
                        <div>{{ project.sales_price | currency }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12 col-md-4" v-show="project.production_due_date">
                        <div class="detail-label">Production Due Date</div>
                        <div>{{ project.production_due_date | date }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-4" v-show="project.post_production_due_date">
                        <div class="detail-label">Post-Production Due Date</div>
                        <div>{{ project.post_production_due_date | date }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-4" v-show="project.quality_control_due_date">
                        <div class="detail-label">Quality Control Due Date</div>
                        <div>{{ project.quality_control_due_date | date }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="detail-group col-xs-12 col-md-4" v-show="project.shipped_due_date">
                        <div class="detail-label">Shipped Due Date</div>
                        <div>{{ project.shipped_due_date | date }}</div>
                    </div>

                    <div class="detail-group col-xs-12 col-md-4" v-show="project.delivered_due_date">
                        <div class="detail-label">Delivered Due Date</div>
                        <div>{{ project.delivered_due_date | date }}</div>
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
                           v-show="(project.status === 'New' || project.status === 'Quote Rejected') && parts.length > 0"
                           v-on:click="$parent.initForm(true, 'Ready To Quote')">
                            <i class="fa fa-arrow-circle-right"></i> Ready To Quote
                        </a>

                        <button type="button"
                                class="btn btn-success"
                                title="Quote Generated"
                                v-show="project.status === 'Ready To Quote'"
                                v-on:click="changeProjectStatus('Quote Generated')">
                            <i class="fa fa-arrow-circle-right"></i> Quote Generated
                        </button>

                        <button type="button"
                                class="btn btn-success"
                                title="Quote Sent"
                                v-show="project.status === 'Quote Generated'"
                                v-on:click="changeProjectStatus('Quote Sent')">
                            <i class="fa fa-arrow-circle-right"></i> Quote Sent
                        </button>

                        <button type="button"
                                class="btn btn-success"
                                title="Quote Accepted"
                                v-show="project.status === 'Quote Sent'"
                                v-on:click="changeProjectStatus('Quote Accepted')">
                            <i class="fa fa-arrow-circle-right"></i> Quote Accepted
                        </button>

                        <button type="button"
                                class="btn btn-danger"
                                title="Quote Rejected"
                                v-show="project.status === 'Quote Sent'"
                                v-on:click="changeProjectStatus('Quote Rejected')">
                            <i class="fa fa-arrow-circle-right"></i> Quote Rejected
                        </button>

                        <a href="#form"
                           aria-controls="form"
                           role="tab"
                           data-toggle="tab"
                           class="btn btn-success"
                           title="Pre-Production"
                           v-show="project.status === 'Quote Accepted'"
                           v-on:click="$parent.initForm(true, 'Pre-Production')">
                            <i class="fa fa-arrow-circle-right"></i> Pre-Production
                        </a>

                        <button type="button"
                                class="btn btn-success"
                                title="Production"
                                v-show="project.status === 'Pre-Production'"
                                v-on:click="changeProjectStatus('Production')">
                            <i class="fa fa-arrow-circle-right"></i> Production
                        </button>

                        <button type="button"
                                class="btn btn-success"
                                title="Post-Production"
                                v-show="project.status === 'Production'"
                                v-on:click="changeProjectStatus('Post-Production')">
                            <i class="fa fa-arrow-circle-right"></i> Post-Production
                        </button>

                        <button type="button"
                                class="btn btn-success"
                                title="Quality Control"
                                v-show="project.status === 'Post-Production'"
                                v-on:click="changeProjectStatus('Quality Control')">
                            <i class="fa fa-arrow-circle-right"></i> Quality Control
                        </button>

                        <button type="button"
                                class="btn btn-success"
                                title="Shipping"
                                v-show="project.status === 'Quality Control'"
                                v-on:click="changeProjectStatus('Shipping')">
                            <i class="fa fa-arrow-circle-right"></i> Shipping
                        </button>
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
            },

            changeProjectStatus: function (newStatus) {
                this.project.status = newStatus;
                axios.put('/api/projects/' + this.project.id, this.project)
                    .then(() => {
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>