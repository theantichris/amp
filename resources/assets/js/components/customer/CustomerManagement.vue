<script>
    import SortedList from '../SortedList.vue';
    import CustomerForm from './CustomerForm.vue';

    export default {
        components: {SortedList, CustomerForm},
        data() {
            return {
                customers: []
            }
        },
        mounted() {
            this.loadCustomers();
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