<template xmlns:v-bind="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <table class="table table-striped sortable-table">
        <thead>
        <tr>
            <th class="sortable-table__heading" v-for="column in columns" v-on:click="sortBy(column)" v-bind:class="{ active: sortKey == column }">
                <span>{{ column.replace( /([A-Z])/g, " $1" ) | capitalize }}</span>
                <i class="fa" v-bind:class="sortClass(column)"></i>
            </th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="customer in sortedCustomers">
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
                sortedCustomers: [],
                columns: [
                    'accountNumber',
                    'companyName',
                    'contactName',
                    'contactEmail'
                ],
                sortKey: 'accountNumber',
                reversed: null
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
                    this.sortBy(this.sortKey);
                }, (error) => {
                    console.error(error);
                })
            },
            sortBy(column){
                this.sortedCustomers = this.customers;

                if (this.sortKey == column) {
                    this.sortedCustomers.reverse();

                    if (this.reversed == null)
                        this.reversed = false;
                    else
                        this.reversed = !this.reversed;
                }
                else {
                    this.sortedCustomers = this.customers.sort(function (a, b) {
                        return a[column] == b[column] ? 0 : +(a[column] > b[column] || -1);
                    });

                    this.reversed = false;
                }

                this.sortKey = column;
            },
            sortClass(column){
                if (this.sortKey == column && !this.reversed)
                    return 'fa-chevron-up';

                if (this.sortKey == column && this.reversed)
                    return 'fa-chevron-down';

                return 'fa-sort';
            }
        }
    }
</script>