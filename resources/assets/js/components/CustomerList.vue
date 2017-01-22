<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th v-for="column in columns">
                {{ column.replace( /([A-Z])/g, " $1" ) | capitalize }}
            </th>
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
                customers: [],
                columns: [
                    'accountNumber',
                    'companyName',
                    'contactName',
                    'contactEmail',
                ]
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