<template>
    <div class="spark-screen container">
        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        Customers





                    </div>

                    <div class="panel-body">
                        <div class="customer-management-tabs">
                            <div class="spark-settings-stacked-tabs">
                                <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                    <li role="presentation" class="active" v-on:click="loadCustomers()">
                                        <a href="#list" aria-controls="list" role="tab" data-toggle="tab">
                                            <i class="fa fa-fw fa-btn fa-list"></i>List
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#form" aria-controls="form" role="tab" data-toggle="tab" v-on:click="initForm()">
                                            <i class="fa fa-fw fa-btn fa-plus"></i>Add Customer
                                        </a>
                                    </li>

                                    <li role="presentation" v-show="false">
                                        <a href="#detail" aria-controls="detail" role="tab" data-toggle="tab"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="list">
                        <customer-list :customers="customers"></customer-list>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="form">
                        <customer-form :form="form" v-on:formSaved="handleFormSaved"></customer-form>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="detail">
                        <customer-detail :customer="customer"></customer-detail>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import CustomerList from './CustomerList.vue';
    import CustomerForm from './CustomerForm.vue';
    import CustomerDetail from './CustomerDetail.vue';
    import TabState from '../../../../../vendor/laravel/spark/resources/assets/js/mixins/tab-state';

    export default {
        mixins: [TabState],

        components: {CustomerList, CustomerForm, CustomerDetail},

        data() {
            return {
                customers: [],
                customer: {},
                form: {}
            }
        },

        mounted() {
            this.loadCustomers();
            this.usePushStateForTabs('.customer-management-tabs');
            this.initForm();
        },

        methods: {
            loadCustomers() {
                this.initForm();

                axios.get('/api/customers')
                    .then((response) => {
                        this.customers = response.data.customers;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            loadCustomer(id) {
                if (id)
                    axios.get('/api/customers/' + id)
                        .then((response) => {
                            this.customer = response.data.customer;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
            },

            initForm() {
                if (this.customer) {
                    let customer = this.customer;
                    this.customer = {};

                    this.form = new SparkForm({
                        id: customer.id,
                        account_number: customer.account_number,
                        company_name: customer.company_name,
                        contact_name: customer.contact_name,
                        contact_email: customer.contact_email,
                        contact_phone: customer.contact_phone,
                        address1: customer.address1,
                        address2: customer.address2,
                        city: customer.city,
                        state: customer.state || '',
                        zip: customer.zip,
                        shipping_account_provider: customer.shipping_account_provider,
                        shipping_account_number: customer.shipping_account_number
                    });
                } else {
                    this.form = new SparkForm({
                        account_number: '',
                        company_name: '',
                        contact_name: '',
                        contact_email: '',
                        contact_phone: '',
                        address1: '',
                        address2: '',
                        city: '',
                        state: '',
                        zip: '',
                        shipping_account_provider: '',
                        shipping_account_number: ''
                    });
                }
            },

            handleFormSaved(){
                this.initForm();

                this.form.successful = true;
                setInterval(() => {
                    this.form.successful = false;
                }, 10000);
            }
        }
    }
</script>