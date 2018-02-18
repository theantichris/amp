<template>
    <div class="spark-screen container">
        <div class="row">

            <div class="col-md-4">
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">Projects</div>

                    <div class="panel-body">
                        <div class="project-management-tabs">
                            <div class="spark-settings-stacked-tabs">
                                <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                    <li role="presentation" class="active" v-on:click="loadProjects()">
                                        <a href="#list" aria-controls="list" role="tab" data-toggle="tab">
                                            <i class="fa fa-fw fa-btn fa-list"></i>List
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#form" aria-controls="form" role="tab" data-toggle="tab"
                                           v-on:click="initForm(false)">
                                            <i class="fa fa-fw fa-btn fa-plus"></i>Add Project
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
                        <project-list :projects="projects"/>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="form">
                        <project-form :form="form" v-on:formSaved="handleFormSaved"/>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="detail">
                        <project-detail :project="project"
                                        :history="history"
                                        :comments="comments"
                                        v-on:partSaved="handlePartSaved"
                                        v-on:commentSaved="handleCommentSaved"/>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import ProjectList from './ProjectList.vue';
    import ProjectForm from './ProjectForm.vue';
    import ProjectDetail from './ProjectDetail.vue';
    import TabState from '../../../../../vendor/laravel/spark/resources/assets/js/mixins/tab-state';

    export default {
        mixins: [TabState],

        components: {ProjectList, ProjectForm, ProjectDetail},

        data() {
            return {
                projects: [],
                project: {},
                projectId: '',
                comments: [],
                history: [],
                form: {}
            }
        },

        mounted() {
            this.loadProjects();
            this.usePushStateForTabs('.project-management-tabs');
            this.initForm();
        },

        methods: {
            loadProjects() {
                this.initForm();

                axios.get('/api/projects')
                    .then((response) => {
                        this.projects = response.data.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            loadProject(id) {
                if (id)
                    this.projectId = id;

                axios.get('/api/projects/' + id)
                    .then((response) => {
                        this.project = response.data.data;

                        this.loadComments(id);
                        this.loadHistory(id);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            initForm(editProject) {
                if (editProject && this.project) {
                    let project = this.project;
                    this.project = {};

                    this.form = new SparkForm({
                        id: project.id,
                        name: project.name,
                        status: project.status,
                        customer: project.customer,
                        manager: project.manager
                    });
                } else {
                    this.form = new SparkForm({
                        name: '',
                        status: 'New',
                        customer: '',
                        manager: ''
                    });
                }
            },

            handleFormSaved() {
                this.initForm();

                this.form.successful = true;
                setInterval(() => {
                    this.form.successful = false;
                }, 10000);
            },

            handleCommentSaved() {
                this.loadComments(this.projectId)
            },

            handlePartSaved() {
                console.log('Part saved.');
            },

            loadComments(projectId) {
                axios.get('/api/projects/' + projectId + '/comments')
                    .then((response) => {
                        this.comments = response.data.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },

            loadHistory(projectId) {
                axios.get('/api/projects/' + projectId + '/history')
                    .then((response) => {
                        this.history = response.data.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>