<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Account Number</th>
            <th>Company Name</th>
            <th>Contact Name</th>
            <th>Contact Email</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="customer in customers">
            <td>{{ customer.accountNumber }}</td>
            <td>{{ customer.companyName }}</td>
            <td>{{ customer.contactName }}</td>
            <td>{{ customer.contactEmail }}</td>
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