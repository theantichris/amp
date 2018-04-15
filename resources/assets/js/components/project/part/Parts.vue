<template>
    <fieldset>
        <legend>
            Parts

            <a v-on:click="showForm = true"><i class="fa fa-plus-circle text-success"></i> </a>
        </legend>

        <form v-on:submit.prevent="save" v-show="showForm">
            <div class="row">
                <div class="form-group col-xs-12 col-md-10 required">
                    <label for="name" class="control-label">Name</label>
                    <input id="name"
                           class="form-control"
                           v-model="part.name"
                           required>
                </div>

                <div class="form-group col-xs-12 col-md-2 required">
                    <label for="quantity" class="control-label">Quantity</label>
                    <input id="quantity"
                           class="form-control"
                           type="number"
                           v-model="part.quantity"
                           required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xs-12 required">
                    <label for="material" class="control-label">Material</label>
                    <select id="material"
                            class="form-control"
                            v-model="part.material"
                            required>
                        <option value="">Material</option>
                        <option v-for="material in materials" :value="material" :key="material.id">
                            {{ material.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xs-12 required">
                    <label for="requirements" class="control-label">Requirements</label>
                    <textarea id="requirements"
                              class="form-control"
                              rows="5"
                              v-model="part.requirements"
                              required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xs-12 required">
                    <label for="description" class="control-label">Description</label>
                    <textarea id="description"
                              class="form-control"
                              rows="5"
                              v-model="part.description"
                              required></textarea>
                </div>
            </div>

            <div class="row pull-right">
                <div class="form-group col-xs-12">
                    <button type="submit"
                            class="btn-sm btn-primary">Save
                    </button>

                    <button type="button"
                            class="btn-sm btn-danger"
                            v-on:click="cancelForm()">Cancel
                    </button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
            <tr>
                <th class="sortable-table__heading">Name</th>
                <th class="sortable-table__heading">Quantity</th>
                <th class="sortable-table__heading">Material</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="part in parts">
                <td>
                    <div class="btn-table-align">{{ part.name }}</div>
                </td>
                <td>
                    <div class="btn-table-align">{{ part.quantity }}</div>
                </td>
                <td>
                    <div class="btn-table-align">{{ part.material.name }}</div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" v-on:click="showDetails(part)">
                        <i class="fa fa-eye"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <parts-modal :show-modal="showModal"
                     :part="part"
                     :project-id="projectId"
                     :part-history="partHistory"
                     v-on:close="handleClose"/>
    </fieldset>
</template>

<script>
    import PartsModal from './PartsModal';

    export default {
        components: {PartsModal},

        data: function () {
            return {
                showForm: false,
                showModal: false,
                materials: [],
                part: {
                    id: '',
                    name: '',
                    quantity: '',
                    requirements: '',
                    description: '',
                },
                partHistory: {}
            }
        },

        props: ['projectId', 'parts'],

        mounted() {
            this.loadMaterials();
        },

        methods: {
            save: function () {
                this.createPart();
            },

            cancelForm: function () {
                this.showForm = false;
                this.part = {
                    id: '',
                    name: '',
                    quantity: '',
                    requirements: '',
                    description: '',
                }
            },

            createPart: function () {
                axios.post('/api/projects/' + this.projectId + '/parts', this.part)
                    .then(() => {
                        this.showForm = false;

                        this.$emit('partSaved');
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },

            loadMaterials() {
                axios.get('/api/projects/materials')
                    .then((response) => {
                        this.materials = response.data.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            showDetails: function (part) {
                this.showModal = true;
                this.part = part;

                axios.get('/api/projects/' + this.projectId + '/parts/' + this.part.id + '/history')
                    .then((response) => {
                        this.partHistory = response.data.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            handleClose: function () {
                this.showModal = false;
                this.part = {};
            }
        }
    }
</script>