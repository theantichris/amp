<template xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div>
        <label for="state" class="control-label">State</label>
        <select id="state" class="form-control" v-model="selectedState" v-on:change="onSelection">
            <option value="">State</option>
            <option v-for="state in states" :value="state">{{ state }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['select-state'],

        data (){
            return {
                selectedState: '',
                states: []
            }
        },

        mounted() {
            this.getStates();
        },

        methods: {
            getStates(){
                axios.get('/api/states')
                    .then((response) => {
                        this.states = response.data;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            onSelection: function () {
                this.selectState(this.selectedState);
            }
        }
    }
</script>