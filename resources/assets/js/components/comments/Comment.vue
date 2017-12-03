<template>
    <fieldset>
        <legend>
            Comments

            <a v-on:click="showForm = true"><i class="fa fa-plus-circle text-success"></i> </a>
        </legend>

        <form v-on:submit.prevent="save" v-show="showForm">
            <div class="row">
                <div class="form-group col-xs-12">
                        <textarea title="Comment Body"
                                  class="form-control"
                                  v-model="comment.body"></textarea>
                </div>
            </div>

            <div class="row pull-right">
                <div class="form-group col-xs-12">
                    <button type="submit"
                            class="btn-sm btn-primary">Save
                    </button>

                    <button type="button"
                            class="btn-sm btn-danger"
                            v-on:click="cancelForm()">Cancel</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="detail-group col-xs-12">
                <ul class="list-group">
                    <li class="list-group-item" v-for="comment in comments">
                        <div class="row">
                            <div class="col-xs-12 col-md-10">
                                <div class="row">
                                    <div class="col-xs-12">
                                        {{ comment.body }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <small>
                                            By {{ comment.createdBy }} at {{ comment.updatedAt.date | datetime }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-2">
                                <div class="pull-right">
                                    <a v-on:click="setCommentToEdit(comment.id)"><i class="fa fa-edit"></i> </a>
                                    <a v-on:click="deleteComment(comment.id)"><i class="fa fa-trash text-danger"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </fieldset>
</template>

<script>
    export default {
        data: function () {
            return {
                showForm: false,
                comment: {
                    title: '',
                    body: '',
                    id: '',
                }
            }
        },

        props: ['model', 'projectId', 'comments'],

        methods: {
            save: function () {
                if (this.comment.id)
                    this.editComment();
                else
                    this.createComment();
            },

            cancelForm: function(){
                this.showForm = false;
                this.comment = {
                    body: '',
                    id: ''
                }
            },

            createComment: function () {
                axios.post('/api/' + this.model + '/' + this.projectId + '/comments', this.comment)
                    .then(() => {
                        this.showForm = false;
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },

            editComment: function () {
                axios.put('/api/' + this.model + '/' + this.projectId + '/comments/' + this.comment.id, this.comment)
                    .then(() => {
                        this.comment = {
                            body: '',
                            id: '',
                        };

                        this.getComments();

                        this.showForm = false;
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },

            deleteComment: function (commentId) {
                axios.delete('/api/' + this.model + '/' + this.projectId + '/comments/' + commentId)
                    .then(() => {
                        this.comment = {
                            body: '',
                            id: ''
                        };

                        this.getComments();
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },

            setCommentToEdit: function (commentId) {
                for (let i = 0; i < this.comments.length; i++) {
                    if (this.comments[i].id === commentId) {
                        this.comment.body = this.comments[i].body;
                        this.comment.id = this.comments[i].id;
                    }
                }
            }
        }
    }
</script>