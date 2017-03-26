<script>
    import StateSelect from '../form/StateSelect.vue';

    export default {
        components: {StateSelect},

        props: ['form'],

        methods: {
            save() {
                axios.post('/api/customers', this.form)
                    .then(() => {
                        this.form.successful = true;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>