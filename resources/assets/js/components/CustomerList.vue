<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Account Number</th>
            <th>Company Name</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="customer in customers">
            <td>{{ customer.account_number }}</td>
            <td>{{ customer.company_name }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
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
    }
</script>