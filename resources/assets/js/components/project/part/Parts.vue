<template>
    <fieldset>
        <legend>
            Parts

            <a v-on:click="showForm = true"><i class="fa fa-plus-circle text-success"></i> </a>
        </legend>

        <form v-on:submit.prevent="save" v-show="showForm">
            <div class="row">
                <div class="form-group col-xs-12 col-md-10">
                    <label for="name" class="control-label required">Name</label>
                    <input id="name"
                           class="form-control"
                           v-model="part.name"
                           required>
                </div>

                <div class="form-group col-xs-12 col-md-2">
                    <label for="quantity" class="control-label required">Quantity</label>
                    <input id="quantity"
                           class="form-control"
                           type="number"
                           v-model="part.quantity"
                           required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xs-12">
                    <label for="requirements" class="control-label required">Requirements</label>
                    <textarea id="requirements"
                              class="form-control"
                              rows="5"
                              v-model="part.requirements"
                              required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xs-12">
                    <label for="description" class="control-label required">Description</label>
                    <textarea id="description"
                              class="form-control"
                              rows="5"
                              v-model="part.description"
                              required></textarea>
                </div>
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
        </form>
    </fieldset>
</template>

<script>
    export default {
        data: function () {
            return {
                showForm: false,
                part: {
                    id: '',
                    name: '',
                    quantity: '',
                    requirements: '',
                    description: '',
                }
            }
        },

        props: ['projectId'],

        methods: {
            save: function () {
                this.createPart();
            },

            cancelForm: function () {
                this.showForm = false;
                this.part = {
                    id: '',
                    name: '',
                    quantity: '',
                    requirements: '',
                    description: '',
                }
            },

            createPart: function () {
                axios.post('/api/projects/' + this.projectId + '/parts', this.part)
                    .then(() => {
                        this.showForm = false;

                        this.$emit('commentSaved');
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },
        }
    }
</script>