<template>
    <div v-if="showModal" v-on:close="showModal = false">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <h3>{{ part.name }}</h3>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="detail-group col-xs-12 col-md-2">
                                    <div class="detail-label">Quantity</div>
                                    <div>{{ part.quantity }}</div>
                                </div>

                                <div class="detail-group col-xs-12 col-md-10">
                                    <div class="detail-label">Material</div>
                                    <div>{{ part.material.name }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="detail-group col-xs-12">
                                    <div class="detail-label">Requirements</div>
                                    <div>{{ part.requirements }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="detail-group col-xs-12">
                                    <div class="detail-label">Description</div>
                                    <div>{{ part.description }}</div>
                                </div>
                            </div>

                            <fieldset>
                                <legend>
                                    Resources

                                    <a v-on:click="showForm = true; url = ''"><i class="fa fa-plus-circle text-success"></i> </a>
                                </legend>

                                <form v-on:submit.prevent="save" v-show="showForm">
                                    <div class="row">
                                        <div class="form-group col-xs-12 required">
                                            <label for="name" class="control-label">URL</label>
                                            <input id="name"
                                                   type="url"
                                                   class="form-control"
                                                   v-model="url"
                                                   required>
                                        </div>

                                        <div class="row pull-right">
                                            <div class="form-group col-xs-12">
                                                <button type="submit"
                                                        class="btn-sm btn-primary">Save
                                                </button>

                                                <button type="button"
                                                        class="btn-sm btn-danger"
                                                        v-on:click="cancelForm()">Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="row" v-for="url in part.urls">
                                    <div class="detail-group col-xs-12">
                                        <a :href="url" target="_blank">{{ url }} <i class="fa fa-external-link"></i></a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="modal-footer">
                            <button class="modal-default-button" v-on:click="$emit('close')">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                showForm: false,
                url: ''
            }
        },

        props: ['showModal', 'part', 'projectId'],

        methods: {
            save: function () {
                axios.post('/api/projects/' + this.projectId + '/parts/' + this.part.id + '/urls', this.url)
                    .then(() => {
                        this.showForm = false;
                        this.part.urls.push(this.url);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            cancelForm: function () {
                this.showForm = false;
                this.url = '';
            }
        }
    }
</script>