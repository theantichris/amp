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
                            v-on:click="cancelForm()">Cancel
                    </button>
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
                                            By {{ comment.createdBy }} at {{ comment.updatedAt | datetime }}
                                        </small>
                                    </div>
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
                    body: '',
                    id: '',
                }
            }
        },

        props: ['model', 'modelId', 'comments'],

        methods: {
            save: function () {
                this.createComment();
            },

            cancelForm: function () {
                this.showForm = false;
                this.comment = {
                    body: '',
                    id: ''
                }
            },

            createComment: function () {
                axios.post('/api/' + this.model + '/' + this.modelId + '/comments', this.comment)
                    .then(() => {
                        this.showForm = false;

                        this.$emit('commentSaved');
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },
        }
    }
</script>