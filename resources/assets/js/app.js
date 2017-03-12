require('spark-bootstrap');
require('./components/bootstrap');

import CustomerManagement from "./components/customer/CustomerManagement.vue";

new Vue({
    mixins: [require('spark')],
    components: {CustomerManagement}
});
