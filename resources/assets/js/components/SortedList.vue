<script>
    export default {
        props: ['apiUrl'],

        data (){
            return {
                items: []
            }
        },

        mounted() {
            this.getItems();
        },

        methods: {
            getItems(){
                axios.get(this.apiUrl)
                    .then((response) => {
                        this.items = response.data.customers;
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            }
        }
    }
</script>