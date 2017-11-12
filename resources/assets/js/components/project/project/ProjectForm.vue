<template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Project
            </div>

            <div class="panel-body">
                <div class="alert alert-success" v-if="form.successful">
                    Your project information has been updated!
                </div>

                <form v-on:submit.prevent="save">
                    <div class="row">
                        <div class="form-group col-xs-12 required">
                            <label for="name" class="control-label">Name</label>
                            <input id="name" name="name" type="text" class="form-control" v-model="form.name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary" v-bind:disabled="form.busy" title="Save">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components: {},

        props: ['form'],

        data() {
            return {
//                weights: [],
//                densities: []
            }
        },

        mounted() {
//            this.getWeights();
//            this.getDensities();
        },

        methods: {
            save() {
                if (this.form.id) {
                    axios.put('/api/projects/' + this.form.id, this.form)
                        .then(() => {
                            this.$emit('formSaved');
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                } else {
                    axios.post('/api/projects', this.form)
                        .then(() => {
                            this.$emit('formSaved');
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                }
            },

//            getWeights() {
//                axios.get('/api/weights')
//                    .then((response) => {
//                        this.weights = response.data.weights;
//                    })
//                    .catch((error) => {
//                        console.error(error);
//                    });
//            },
//
//            getDensities() {
//                axios.get('/api/densities')
//                    .then((response) => {
//                        this.densities = response.data.densities;
//                    })
//                    .catch((error) => {
//                        console.error(error);
//                    });
//            }
        }
    }
</script>