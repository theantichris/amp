<!--suppress HtmlUnknownAnchorTarget -->
<template>
    <sorted-list :items="materials" inline-template>
        <div class="panel panel-default">
            <div class="panel-heading">Materials</div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped sortable-table">
                            <thead>
                            <tr>
                                <th class="sortable-table__heading" v-on:click="sortBy('name')">Name
                                    <i class="fa" v-bind:class="sortClass('name')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('cost')">Cost
                                    <i class="fa" v-bind:class="sortClass('cost')"></i>
                                </th>
                                <th class="sortable-table__heading" v-on:click="sortBy('density')">Density
                                    <i class="fa" v-bind:class="sortClass('density')"></i>
                                </th>

                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="item in items">
                                <td>
                                    <div class="btn-table-align">{{ item.name }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">{{ item.cost }}</div>
                                </td>
                                <td>
                                    <div class="btn-table-align">{{ item.density }}</div>
                                </td>

                                <td>
                                    <!-- TODO: Refactor click event -->
                                    <a href="#detail" aria-controls="detail" role="tab" data-toggle="tab"
                                       v-on:click="$parent.$parent.loadMaterial(item.id)">
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

        props: ['materials'],
    }
</script>