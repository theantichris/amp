<!--suppress HtmlUnknownAnchorTarget -->
<template>
    <sorted-list :items="machineProfiles" inline-template>
        <div class="panel panel-default">
            <div class="panel-heading">Machine Profiles</div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped sortable-table">
                            <thead>
                            <tr>
                                <th class="sortable-table__heading" v-on:click="sortBy('type')">Type
                                    <i class="fa" v-bind:class="sortClass('type')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('setupFee')">Setup Fee
                                    <i class="fa" v-bind:class="sortClass('setupFee')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('rate')">Rate
                                    <i class="fa" v-bind:class="sortClass('rate')"></i>
                                </th>

                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="item in items">
                                <td>
                                    <div class="btn-table-align">{{ item.type }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">${{ item.setupFee }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">${{ item.rate }}</div>
                                </td>

                                <td>
                                    <!-- TODO: Refactor click event -->
                                    <a href="#detail" aria-controls="detail" role="tab" data-toggle="tab"
                                       v-on:click="$parent.$parent.loadMachineProfile(item.id)">
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

        props: ['machineProfiles'],
    }
</script>