require('spark-bootstrap');
require('./components/bootstrap');

import CustomerList from './components/CustomerList.vue';

new Vue({
    mixins: [require('spark')],
    components: {CustomerList}
});
