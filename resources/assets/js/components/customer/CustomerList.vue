<!--suppress HtmlUnknownAnchorTarget -->
<template>
    <sorted-list :items="customers" inline-template>
        <div class="panel panel-default">
            <div class="panel-heading">Customers</div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped sortable-table">
                            <thead>
                            <tr>
                                <th class="sortable-table__heading" v-on:click="sortBy('accountNumber')">Account
                                    <i class="fa" v-bind:class="sortClass('accountNumber')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('companyName')">Company
                                    <i class="fa" v-bind:class="sortClass('companyName')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('contactName')">Contact
                                    <i class="fa" v-bind:class="sortClass('contactName')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('contactEmail')">Email
                                    <i class="fa" v-bind:class="sortClass('contactEmail')"></i>
                                </th>

                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="item in items">
                                <td>
                                    <div class="btn-table-align">{{ item.accountNumber }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">{{ item.companyName }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">{{ item.contactName }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">{{ item.contactEmail }}</div>
                                </td>

                                <td>
                                    <!-- TODO: Refactor click event -->
                                    <a href="#detail" aria-controls="detail" role="tab" data-toggle="tab" v-on:click="$parent.$parent.loadCustomer(item.id)">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </sorted-list>
</template>

<script>
    import SortedList from '../SortedList.vue';

    export default {
        components: {SortedList},

        props: ['customers'],
    }
</script>