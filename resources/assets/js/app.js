require('spark-bootstrap');
require('./components/bootstrap');

import SortedList from "./components/SortedList.vue";
import CustomerForm from "./components/customer/CustomerForm.vue";

new Vue({
    mixins: [require('spark')],
    components: {SortedList, CustomerForm}
});
