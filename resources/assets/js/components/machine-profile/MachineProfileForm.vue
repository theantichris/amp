<template>
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Machine Profile
            </div>

            <div class="panel-body">
                <div class="alert alert-success" v-if="form.successful">
                    Your machine profile information has been updated!
                </div>

                <form v-on:submit.prevent="save">
                    <div class="row">
                        <div class="form-group col-xs-12 required">
                            <label for="type" class="control-label">Type</label>
                            <input id="type" name="type" type="text" class="form-control" v-model="form.type" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6 required">
                            <label for="setupFee" class="control-label">Setup Fee</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>

                                <input id="setupFee"
                                       name="setupFee"
                                       type="number"
                                       min="0"
                                       step="0.01"
                                       class="form-control"
                                       v-model="form.setup_fee"
                                       required>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-md-6 required">
                            <label for="rate" class="control-label">Rate</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>

                                <input id="rate"
                                       name="rate"
                                       type="number"
                                       min="0"
                                       step="0.01"
                                       class="form-control"
                                       v-model="form.rate"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="timeCalculationMethod" class="control-label">Time Calculation Method</label>
                            <input id="timeCalculationMethod"
                                   name="timeCalculationMethod"
                                   type="text"
                                   class="form-control"
                                   v-model="form.time_calculation_method"
                                   readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6 required">
                            <label for="buildRate" class="control-label">Build Rate</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>

                                <input id="buildRate"
                                       name="buildRate"
                                       type="number"
                                       min="0"
                                       step="0.01"
                                       class="form-control"
                                       v-model="form.build_rate"
                                       required>
                            </div>
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

        methods: {
            save() {
                if (this.form.id) {
                    axios.put('/api/machine-profiles/' + this.form.id, this.form)
                        .then(() => {
                            this.$emit('formSaved');
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                } else {
                    axios.post('/api/machine-profiles', this.form)
                        .then(() => {
                            this.$emit('formSaved');
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                }
            }
        }
    }
</script>