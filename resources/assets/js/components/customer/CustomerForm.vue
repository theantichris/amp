<!--suppress HtmlUnknownTarget -->
<template xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <form v-on:submit.prevent="save">
        <div class="row">
            <div class="form-group col-xs-12 required">
                <label for="accountNumber" class="control-label">Account Number</label>
                <input id="accountNumber" name="accountNumber" type="text" class="form-control" v-model="form.accountNumber" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-12 required">
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
            <div class="col-xs-12">
                <a href="/customers" class="btn btn-danger" title="Cancel">Cancel</a>
                <button type="submit" class="btn btn-primary" v-bind:disabled="form.busy" title="Save">Save</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['customerId'],

        data (){
            return {
                butts: {},
                form: new SparkForm({
                    accountNumber: '',
                    companyName: '',
                    contactName: '',
                    contactEmail: ''
                })
            }
        },

        methods: {
            save() {
                axios.post('/api/customers', this.form)
                // TODO: Handle response
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }
</script>