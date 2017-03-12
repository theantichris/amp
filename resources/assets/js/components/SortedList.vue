<script>
    export default {
        props: ['apiUrl', 'defaultSortKey'],

        data (){
            return {
                items: [],
                sortedItems: [],
                sortKey: null,
                reversed: false
            }
        },

        mounted() {
            this.getItems();
            this.sortKey = this.defaultSortKey
        },

        methods: {
            getItems(){
                axios.get(this.apiUrl)
                    .then((response) => {
                        this.items = response.data.customers;
                    })
                    .catch((error) => {
                        console.error(error);
                    })
            },
            sortBy(column){
                this.sortedItems = this.items;

                if (this.sortKey == column) {
                    this.sortedItems.reverse();

                    this.reversed = !this.reversed;
                } else {
                    this.sortedItems = this.items.sort((a, b) => {
                        return a[column] == b[column] ? 0 : +(a[column] > b[column] || -1);
                    });

                    this.reversed = false;
                }

                this.sortKey = column;
            },
            sortClass(column){
                if (this.sortKey == column && !this.reversed)
                    return 'fa-chevron-up';

                if (this.sortKey == column && this.reversed)
                    return 'fa-chevron-down';

                return 'fa-sort';
            }
        }
    }
</script>