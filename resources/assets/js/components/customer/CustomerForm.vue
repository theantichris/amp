<script>
    import StateSelect from '../form/StateSelect.vue';

    export default {
        components: {StateSelect},

        props: [],

        mounted(){
            this.initForm();
        },

        data(){
            return {
                form: {}
            }
        },

        methods: {
            initForm(){
                this.form = new SparkForm({
                    account_number: '',
                    company_name: '',
                    contact_name: '',
                    contact_email: '',
                    contact_phone: '',
                    address1: '',
                    address2: '',
                    city: '',
                    state: '',
                    zip: '',
                    shipping_account_provider: '',
                    shipping_account_number: ''
                });
            },
            onStateSelection(state) {
                this.form.state = state;
            },
            save() {
                axios.post('/api/customers', this.form)
                    .then(() => {
                        this.initForm();
                        window.location.href = '/customers#/list';
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>