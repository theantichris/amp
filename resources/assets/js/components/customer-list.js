Vue.component('customer-list', {
    props: ['user'],

    data (){
        return {
            customers: []
        }
    },

    mounted() {
        this.getCustomerList();
    },

    methods: {
        getCustomerList(){
            let resource = this.$resource('/api/customer');

            resource.get().then((response) => {
                this.customers = response.data;
            }, (error) => {
                console.error(error);
            })
        }
    }
});
