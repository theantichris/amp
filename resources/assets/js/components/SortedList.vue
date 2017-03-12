<script>
    export default {
        props: ['items'],

        data (){
            return {
                sortedItems: [],
                sortKey: null,
                reversed: false
            }
        },

        methods: {
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