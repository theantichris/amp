require('spark-bootstrap');
require('./components/bootstrap');

import SortedList from './components/SortedList.vue';

new Vue({
    mixins: [require('spark')],
    components: {SortedList}
});
