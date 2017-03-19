<script>
    import SortedList from '../SortedList.vue';
    import CustomerForm from './CustomerForm.vue';
    import CustomerDetail from './CustomerDetail.vue';

    export default {
        mixins: [require('../../../../../vendor/laravel/spark/resources/assets/js/mixins/tab-state')],

        components: {SortedList, CustomerForm, CustomerDetail},

        data() {
            return {
                customers: [],
                customer: {}
            }
        },

        mounted() {
            this.loadCustomers();
            this.usePushStateForTabs('.customer-management-tabs');
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
                if (!id)
                    return;

                axios.get('/api/customers/' + id)
                    .then((response) => {
                        this.customer = response.data.customer;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>