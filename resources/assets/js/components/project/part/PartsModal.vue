<template>
    <div v-if="showModal" v-on:close="showModal = false">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                Part Header
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                                Part Body
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <button class="modal-default-button" v-on:click="$emit('close')">
                                    OK
                                </button>
                            </slot>
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

        props: ['showModal'],
    }
</script>