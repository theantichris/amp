<template>
    <div v-if="showModal" v-on:close="showModal = false">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <h3>{{ part.name }}</h3>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="detail-group col-xs-12 col-md-2">
                                    <div class="detail-label">Quantity</div>
                                    <div>{{ part.quantity }}</div>
                                </div>

                                <div class="detail-group col-xs-12 col-md-10">
                                    <div class="detail-label">Material</div>
                                    <div>{{ part.material.name }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="detail-group col-xs-12">
                                    <div class="detail-label">Requirements</div>
                                    <div>{{ part.requirements }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="detail-group col-xs-12">
                                    <div class="detail-label">Description</div>
                                    <div>{{ part.description }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="modal-default-button" v-on:click="$emit('close')">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {}
        },

        props: ['showModal', 'part'],
    }
</script>