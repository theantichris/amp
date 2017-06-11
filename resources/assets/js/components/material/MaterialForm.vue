<template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Material
            </div>

            <div class="panel-body">
                <div class="alert alert-success" v-if="form.successful">
                    Your material information has been updated!
                </div>

                <form v-on:submit.prevent="save">
                    <div class="row">
                        <div class="form-group col-xs-12 required">
                            <label for="name" class="control-label">Name</label>
                            <input id="name" name="name" type="text" class="form-control" v-model="form.name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-6 required">
                            <label for="cost" class="control-label">Cost</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input id="cost"
                                       name="cost"
                                       type="number"
                                       min="0.01"
                                       step="0.01"
                                       class="form-control"
                                       v-model="form.cost"
                                       required>
                            </div>
                        </div>

                        <div class="form-group col-xs-6 required">
                            <label for="weightUnit" class="control-label">Per</label>
                            <select id="weightUnit" class="form-control" v-model="form.weight_unit">
                                <option value="">Unit</option>
                                <option v-for="weight in weights" :value="weight">{{ weight }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-6 required">
                            <label for="density" class="control-label">Density</label>
                            <input id="density"
                                   name="density"
                                   type="number"
                                   min="0.01"
                                   step="0.01"
                                   class="form-control"
                                   v-model="form.density"
                                   required>
                        </div>

                        <div class="form-group col-xs-6 required">
                            <label for="densityUnit" class="control-label">Unit</label>
                            <select id="densityUnit" class="form-control" v-model="form.density_unit" required>
                                <option value="">Unit</option>
                                <option v-for="density in densities" :value="density">{{ density }}</option>
                            </select>
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
                weights: [],
                densities: []
            }
        },

        mounted() {
            this.getWeights();
            this.getDensities();
        },

        methods: {
            save() {
                if (this.form.id) {
                    axios.put('/api/materials/' + this.form.id, this.form)
                        .then(() => {
                            this.$emit('formSaved');
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                } else {
                    axios.post('/api/materials', this.form)
                        .then(() => {
                            this.$emit('formSaved');
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                }
            },

            getWeights() {
                axios.get('/api/weights')
                    .then((response) => {
                        this.weights = response.data.weights;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            getDensities() {
                axios.get('/api/densities')
                    .then((response) => {
                        this.densities = response.data.densities;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>