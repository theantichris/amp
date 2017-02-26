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
        <tr v-for="item in sortedItems">
            <td>{{ item[columns[0]] }}</td>
            <td>{{ item[columns[1]] }}</td>
            <td>{{ item[columns[2]] }}</td>
            <td>{{ item[columns[3]] }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['columns', 'url', 'defaultSortKey'],

        data (){
            return {
                items: [],
                sortedItems: [],
                sortKey: null
            }
        },

        mounted() {
            this.getCustomerList();
            this.sortKey = this.defaultSortKey;
        },

        methods: {
            getCustomerList(){
                axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
                        this.sortBy(this.sortKey);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            sortBy(column){
                this.sortedItems = this.items;

                if (this.sortKey == column) {
                    this.sortedItems.reverse();

                    if (this.reversed == null)
                        this.reversed = false;
                    else
                        this.reversed = !this.reversed;
                }
                else {
                    this.sortedItems = this.items.sort((a, b) => {
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