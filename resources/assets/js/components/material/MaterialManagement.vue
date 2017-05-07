<template>
    <div class="spark-screen container">
        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">Materials</div>

                    <div class="panel-body">
                        <div class="material-management-tabs">
                            <div class="spark-settings-stacked-tabs">
                                <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                    <li role="presentation" class="active" v-on:click="loadMaterials()">
                                        <a href="#list" aria-controls="list" role="tab" data-toggle="tab">
                                            <i class="fa fa-fw fa-btn fa-list"></i>List
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#form" aria-controls="form" role="tab" data-toggle="tab"
                                           v-on:click="initForm(false)">
                                            <i class="fa fa-fw fa-btn fa-plus"></i>Add Material
                                        </a>
                                    </li>

                                    <li role="presentation" v-show="false">
                                        <a href="#detail" aria-controls="detail" role="tab" data-toggle="tab"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="list">
                        <material-list :materials="materials"></material-list>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="form">
                        <material-form :form="form" v-on:formSaved="handleFormSaved"></material-form>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="detail">
                        <material-detail :material="material"></material-detail>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import MaterialList from './MaterialList.vue';
    import MaterialForm from './MaterialForm.vue';
    import MaterialDetail from './MaterialDetail.vue';
    import TabState from '../../../../../vendor/laravel/spark/resources/assets/js/mixins/tab-state';

    export default {
        mixins: [TabState],

        components: {MaterialList, MaterialForm, MaterialDetail},

        data() {
            return {
                materials: [],
                material: {},
                form: {}
            }
        },

        mounted() {
            this.loadMaterials();
            this.usePushStateForTabs('.material-management-tabs');
            this.initForm();
        },

        methods: {
            loadMaterials() {
                this.initForm();

                axios.get('/api/materials')
                    .then((response) => {
                        this.materials = response.data.materials;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            loadMaterial(id) {
                if (id)
                    axios.get('/api/materials/' + id)
                        .then((response) => {
                            this.material = response.data.material;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
            },

            initForm(editMaterial) {
                if (editMaterial && this.material) {
                    let material = this.material;
                    this.material = {};

                    this.form = new SparkForm({
                        id: material.id,
                        name: material.name,
                        cost: material.cost,
                        weight_unit: material.weight_unit,
                        density: material.density,
                        density_unit: material.density_unit,
                    });
                } else {
                    this.form = new SparkForm({
                        name: '',
                        cost: 0,
                        weight_unit: '',
                        density: 0,
                        density_unit: '',
                    });
                }
            },

            handleFormSaved(){
                this.initForm();

                this.form.successful = true;
                setInterval(() => {
                    this.form.successful = false;
                }, 10000);
            }
        }
    }
</script>