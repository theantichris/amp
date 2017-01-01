require('spark-bootstrap');
require('./components/bootstrap');

var app = new Vue({
    mixins: [require('spark')]
});
