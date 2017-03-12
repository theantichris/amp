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
                    accountNumber: '',
                    companyName: '',
                    contactName: '',
                    contactEmail: '',
                    contactPhone: '',
                    address1: '',
                    address2: '',
                    city: '',
                    state: '',
                    zip: '',
                    shippingAccountProvider: '',
                    shippingAccountNumber: ''
                });
            },
            onStateSelection(state) {
                this.form.state = state;
            },
            save() {
                axios.post('/api/customers', this.form)
                    .then(() => {
                        this.initForm();
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>