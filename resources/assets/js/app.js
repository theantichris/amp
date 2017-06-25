require('spark-bootstrap');
require('./components/bootstrap');

import CustomerManagement from "./components/customer/CustomerManagement.vue";
import MachineProfileManagement from "./components/machine-profile/MachineProfileManagement.vue";
import MaterialManagement from "./components/project/MaterialManagement.vue";

new Vue({
    mixins: [require('spark')],
    components: {
        CustomerManagement,
        MachineProfileManagement,
        MaterialManagement
    }
});
