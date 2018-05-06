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
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="customer" class="control-label">Customer</label>
                            <select id="customer" class="form-control" v-model="form.customer">
                                <option value="">Internal</option>
                                <option v-for="customer in customers" :value="customer" :key="customer.id">
                                    {{ customer.company_name }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-xs-12 col-md-6 required">
                            <label for="manager" class="control-label">Manager</label>
                            <select id="manager" class="form-control" v-model="form.manager" required>
                                <option value="">Manager</option>
                                <option v-for="user in users" :value="user" :key="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row" v-show="form.status !== 'New'">
                        <div class="form-group col-xs-12 col-md-6 required">
                            <label for="productionCost" class="control-label">Production Cost</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input id="productionCost"
                                       class="form-control"
                                       type="number"
                                       step="0.01"
                                       min="1"
                                       v-model="form.production_cost"
                                       v-bind:required="form.status !== 'New'">
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-md-6 required">
                            <label for="salesPrice" class="control-label">Production Cost</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input id="salesPrice"
                                       class="form-control"
                                       type="number"
                                       step="0.01"
                                       min="1"
                                       v-model="form.sales_price"
                                       v-bind:required="form.status !== 'New'">
                            </div>
                        </div>
                    </div>

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
                customers: [],
                users: []
            }
        },

        mounted() {
            this.getCustomers();
            this.getUsers();
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

            getCustomers() {
                axios.get('/api/customers')
                    .then((response) => {
                        this.customers = response.data.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            getUsers() {
                axios.get('/api/users')
                    .then((response) => {
                        this.users = response.data.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
        }
    }
</script>