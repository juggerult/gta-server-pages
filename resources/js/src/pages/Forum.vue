<template>
    <main class="main">
        Forum
    </main>


</template>

<script lang="ts">
import { defineComponent } from 'vue';
import MainHeader from '../MainHeader.vue';

export default defineComponent({
    components: {
        MainHeader
        },

        setup(){
        return {
        };
    },
});

</script>

<style>
.main{
    width: 992px;
    margin: 0;
    background-color: rgb(167, 167, 32);
}

</style>
