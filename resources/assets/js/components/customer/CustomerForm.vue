<script>
    import StateSelect from '../form/StateSelect.vue';

    export default {
        components: {StateSelect},

        props: ['customer'],

        mounted(){
        },

        data(){
            return {
                form: this.initForm()
            }
        },

        methods: {
            initForm(){
                return new SparkForm({
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

            save() {
                axios.post('/api/customers', this.form)
                    .then(() => {
                        this.form = this.initForm();
                        this.form.successful = true;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>