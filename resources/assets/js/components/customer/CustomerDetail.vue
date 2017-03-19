<script>
    export default {
        props: ['customerId'],

        mounted(){
            this.loadCustomer();
        },

        data(){
            return {
                customer: {}
            }
        },

        methods: {
            loadCustomer() {
                axios.get('/api/customers/' + this.customerId)
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