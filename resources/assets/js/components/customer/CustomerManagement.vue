<script>
    import SortedList from '../SortedList.vue';
    import CustomerForm from './CustomerForm.vue';

    export default {
        mixins: [require('../../../../../vendor/laravel/spark/resources/assets/js/mixins/tab-state')],
        components: {SortedList, CustomerForm},
        data() {
            return {
                customers: []
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
            }
        }
    }
</script>