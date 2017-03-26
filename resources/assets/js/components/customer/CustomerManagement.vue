<script>
    import SortedList from '../SortedList.vue';
    import CustomerForm from './CustomerForm.vue';
    import CustomerDetail from './CustomerDetail.vue';
    import TabState from '../../../../../vendor/laravel/spark/resources/assets/js/mixins/tab-state';

    export default {
        mixins: [TabState],

        components: {SortedList, CustomerForm, CustomerDetail},

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
        }
    }
</script>