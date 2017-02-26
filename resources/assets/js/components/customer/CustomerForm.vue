<template xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <form v-on:submit="save($event)">
        <div class="row">
            <div class="form-group col-xs-12 required" v-bind:class="{'has-error': form.errors.has('accountNumber')}">
                <label for="accountNumber" class="control-label">Account Number</label>
                <input id="accountNumber" name="accountNumber" type="text" class="form-control" v-model="form.accountNumber" required>

                <span class="help-block" v-show="form.errors.has('accountNumber')">
                    {{ form.errors.get('accountNumber')}}
                </span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12 required" v-bind:class="{'has-error': form.errors.has('companyName')}">
                <label for="companyName" class="control-label">Company Name</label>
                <input id="companyName" name="companyName" type="text" class="form-control" v-model="form.companyName" required>

                <span class="help-block" v-show="form.errors.has('companyName')">
                    {{ form.errors.get('name')}}
                </span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12 required" v-bind:class="{'has-error': form.errors.has('contactName')}">
                <label for="contactName" class="control-label">Contact Name</label>
                <input id="contactName" name="contactName" type="text" class="form-control" v-model="form.contactName" required>

                <span class="help-block" v-show="form.errors.has('contactName')">
                    {{ form.errors.get('companyName')}}
                </span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12 required" v-bind:class="{'has-error': form.errors.has('contactEmail')}">
                <label for="contactEmail" class="control-label">Contact Email</label>
                <input id="contactEmail" name="contactEmail" type="email" class="form-control" v-model="form.contactEmail" required>

                <span class="help-block" v-show="form.errors.has('contactEmail')">
                    {{ form.errors.get('contactEmail')}}
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary" v-bind:disabled="form.busy">Save</button>
            </div>
        </div>

        <div class="alert alert-success" v-if="form.successful">
            Customer information has been updated!
        </div>
    </form>
</template>

<script>
    export default {
        props: ['customerId'],

        data (){
            return {
                form: new SparkForm({
                    accountNumber: '',
                    companyName: '',
                    contactName: '',
                    contactEmail: ''
                })
            }
        },

        mounted() {

        },

        methods: {
            save(event) {
                if (event)
                    event.preventDefault();

                Spark.post('/customers', this.form).then(response => {
                    console.log(response);
                });
            }
        }
    }
</script>