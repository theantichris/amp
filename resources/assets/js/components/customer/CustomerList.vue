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
                                <th class="sortable-table__heading" v-on:click="sortBy('account_number')">Account
                                    <i class="fa" v-bind:class="sortClass('account_number')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('company_name')">Company
                                    <i class="fa" v-bind:class="sortClass('company_name')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('contact_name')">Contact
                                    <i class="fa" v-bind:class="sortClass('contact_name')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('contact_email')">Email
                                    <i class="fa" v-bind:class="sortClass('contact_email')"></i>
                                </th>

                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="item in items">
                                <td>
                                    <div class="btn-table-align">{{ item.account_number }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">{{ item.company_name }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">{{ item.contact_name }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">{{ item.contact_email }}</div>
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