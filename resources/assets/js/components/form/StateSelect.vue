<template>
    <div>
        <label for="state" class="control-label">State</label>
        <select id="state" class="form-control" v-model="$parent.form.state">
            <option value="">State</option>
            <option v-for="state in states" :value="state">{{ state }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: [],

        data (){
            return {
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
                        this.states = response.data.states;
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        }
    }
</script>