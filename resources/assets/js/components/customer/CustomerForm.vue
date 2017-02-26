<template>

</template>

<script>
    export default {
        props: ['customerId'],

        data (){
            return {}
        },

        mounted() {
            if (this.customerId)
                this.getCustomer();
            else
                console.log('butts');
        },

        methods: {
            getCustomer: function () {
                console.log(this.customerId);
            }
        }
    }
</script>