<template>
    <fieldset>
        <legend>Comments</legend>

        <form v-on:submit.prevent="save">
            <div class="row">
                <div class="form-group col-xs-12">
                        <textarea title="Comment Body"
                                  class="form-control"
                                  v-model="comment.body"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button type="submit"
                            class="btn btn-primary"
                            v-show="!edit">Add Comment
                    </button>

                    <button type="submit"
                            class="btn btn-primary"
                            v-show="edit">Edit Comment
                    </button>
                </div>
            </div>
        </form>

        <ul class="list-group">
            <li class="list-group-item" v-for="comment in comments">
                {{ comment.body }}

                <a class="btn btn-default" v-on:click="setCommentToEdit(comment.id)">Edit</a>
                <a class="btn btn-danger" v-on:click="deleteComment(comment.id)">Delete</a>
            </li>
        </ul>
    </fieldset>
</template>

<script>
    export default {
        data: function () {
            return {
                edit: false,
                comments: [],
                comment: {
                    title: '',
                    body: '',
                    id: '',
                }
            }
        },

        props: ['projectId'],

        mounted() {
            if (this.projectId)
                this.getComments();
        },

        methods: {
            getComments: function () {
                axios.get('/api/projects/' + this.projectId + '/comments')
                    .then((response) => {
                        this.comments = response.data.comments;
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },

            createComment: function () {
                axios.post('/api/projects/' + this.projectId + '/comments', this.comment)
                    .then(() => {
                        this.$emit('formSaved');
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },

            editComment: function () {
                axios.put('/api/projects/' + this.projectId + '/comments/' + this.comment.id, this.comment)
                    .then(() => {
                        this.$emit('formSaved');

                        this.comment = {
                            body: '',
                            id: '',
                        };

                        this.getComments();

                        this.edit = false;
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },

            deleteComment: function (commentId) {
                axios.delete('/api/projects/' + this.projectId + '/comments/' + commentId)
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
                        this.edit = true;
                    }
                }
            }
        }
    }
</script>