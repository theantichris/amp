<template>
    <div class="spark-screen container">
        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">Machine Profiles</div>

                    <div class="panel-body">
                        <div class="machine-profile-management-tabs">
                            <div class="spark-settings-stacked-tabs">
                                <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                    <li role="presentation" class="active" v-on:click="loadMachineProfiles()">
                                        <a href="#list" aria-controls="list" role="tab" data-toggle="tab">
                                            <i class="fa fa-fw fa-btn fa-list"></i>List
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#form" aria-controls="form" role="tab" data-toggle="tab"
                                           v-on:click="initForm(false)">
                                            <i class="fa fa-fw fa-btn fa-plus"></i>Add Machine Profile
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
                        <machine-profile-list :machineProfiles="machineProfiles"></machine-profile-list>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="form">
                        <machine-profile-form :form="form" v-on:formSaved="handleFormSaved"></machine-profile-form>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="detail">
                        <machine-profile-detail :machineProfile="machineProfile"></machine-profile-detail>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import MachineProfileList from './MachineProfileList.vue';
    import MachineProfileForm from './MachineProfileForm.vue';
    import MachineProfileDetail from './MachineProfileDetail.vue';
    import TabState from '../../../../../vendor/laravel/spark/resources/assets/js/mixins/tab-state';

    export default {
        mixins: [TabState],

        components: {MachineProfileList, MachineProfileForm, MachineProfileDetail},

        data() {
            return {
                machineProfiles: [],
                machineProfile: {},
                form: {}
            }
        },

        mounted() {
            this.loadMachineProfiles();
            this.usePushStateForTabs('.machine-profile-management-tabs');
            this.initForm();
        },

        methods: {
            loadMachineProfiles() {
                this.initForm();

                axios.get('/api/machine-profiles')
                    .then((response) => {
                        this.machineProfiles = response.data.machineProfiles;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            loadMachineProfile(id) {
                if (id)
                    axios.get('/api/machine-profiles/' + id)
                        .then((response) => {
                            this.machineProfile = response.data.machineProfile;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
            },

            initForm(editMachineProfile) {
                if (editMachineProfile && this.machineProfile) {
                    let machineProfile = this.machineProfile;
                    this.machineProfile = {};

                    this.form = new SparkForm({
                        id: machineProfile.id,
                        type: machineProfile.type,
                        setup_fee: machineProfile.setup_fee,
                        rate: machineProfile.rate,
                        time_calculation_method: machineProfile.time_calculation_method,
                        build_rate: machineProfile.build_rate,
                    });
                } else {
                    this.form = new SparkForm({
                        type: '',
                        setup_fee: 0,
                        rate: 0,
                        time_calculation_method: 'Volumetric (cc/hr)',
                        build_rate: 0,
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