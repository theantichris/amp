<!--suppress HtmlUnknownTarget -->
<template xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <form v-on:submit.prevent="save">
        <div class="row">
            <div class="form-group col-xs-12 col-md-6 required">
                <label for="accountNumber" class="control-label">Account Number</label>
                <input id="accountNumber" name="accountNumber" type="text" class="form-control" v-model="form.accountNumber" required>
            </div>

            <div class="form-group col-xs-12 col-md-6 required">
                <label for="companyName" class="control-label">Company Name</label>
                <input id="companyName" name="companyName" type="text" class="form-control" v-model="form.companyName" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12 required">
                <label for="contactName" class="control-label">Contact Name</label>
                <input id="contactName" name="contactName" type="text" class="form-control" v-model="form.contactName" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12 required">
                <label for="contactEmail" class="control-label">Contact Email</label>
                <input id="contactEmail" name="contactEmail" type="email" class="form-control" v-model="form.contactEmail" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12">
                <label for="contactPhone" class="control-label">Contact Phone</label>
                <input id="contactPhone" name="contactPhone" type="tel" class="form-control" v-model="form.contactPhone">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12">
                <label for="address1" class="control-label">Address</label>
                <input id="address1" name="address1" type="text" class="form-control" v-model="form.address1">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12">
                <label for="address2" class="control-label">Address Line 2</label>
                <input id="address2" name="address2" type="text" class="form-control" v-model="form.address2">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12 col-xs-4">
                <label for="city" class="control-label">City</label>
                <input id="city" name="city" type="text" class="form-control" v-model="form.city">
            </div>

            <div class="form-group col-xs-12 col-xs-4">
                <state-select :select-state="onStateSelection"></state-select>
            </div>

            <div class="form-group col-xs-12 col-xs-4">
                <label for="zip" class="control-label">Zip</label>
                <input id="zip" name="zip" type="text" class="form-control" v-model="form.zip">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12 col-md-6">
                <label for="shippingAccountProvider" class="control-label">Shipping Account Provider</label>
                <input id="shippingAccountProvider" name="shippingAccountProvider" type="text" class="form-control" v-model="form.shippingAccountProvider">
            </div>

            <div class="form-group col-xs-12 col-md-6">
                <label for="shippingAccountNumber" class="control-label">Shipping Account Number</label>
                <input id="shippingAccountNumber" name="shippingAccountNumber" type="text" class="form-control" v-model="form.shippingAccountNumber">
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <a href="/customers" class="btn btn-danger" title="Cancel">Cancel</a>
                <button type="submit" class="btn btn-primary" v-bind:disabled="form.busy" title="Save">Save</button>
            </div>
        </div>
    </form>
</template>

<script>
    import StateSelect from '../form/StateSelect.vue';

    export default {
        components: {StateSelect},

        props: ['customerId'],

        data (){
            return {
                butts: {},
                form: new SparkForm({
                    accountNumber: '',
                    companyName: '',
                    contactName: '',
                    contactEmail: '',
                    contactPhone: '',
                    address1: '',
                    address2: '',
                    city: '',
                    state: '',
                    zip: '',
                    shippingAccountProvider: '',
                    shippingAccountNumber: ''
                })
            }
        },

        methods: {
            onStateSelection: function (state) {
                this.form.state = state;
            },
            save() {
                axios.post('/api/customers', this.form)
                    .then(response => {
                        window.location = '/customers'; // TODO Redirect to details page.
                    })
                    .catch(error => {
                        console.error(error);
            })
            }
        }
    }
</script>