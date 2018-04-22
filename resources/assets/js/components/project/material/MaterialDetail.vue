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

                        <button v-if="!material.deleted_at"
                                type="button"
                                class="btn btn-danger"
                                title="Delete"
                                v-on:click="deleteMaterial()">
                            <i class="fa fa-trash"></i> Delete
                        </button>

                        <button v-if="material.deleted_at"
                                type="button"
                                class="btn btn-success"
                                title="Restore"
                                v-on:click="restoreMaterial()">
                            <i class="fa fa-plus"></i> Restore
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['material'],
        methods: {
            deleteMaterial() {
                axios.delete('/api/projects/materials/' + this.material.id).then(() => {
                    this.$emit('materialDeleted');
                }).catch((error) => {
                    console.error(error);
                });
            },

            restoreMaterial() {
                axios.put('/api/deleted/projects/materials/' + this.material.id).then(() => {
                    this.$emit('materialRestored');
                }).catch((error) => {
                    console.error(error);
                });
            }
        }
    }
</script>