<template>
<div v-if="condition" class="loading-backdrop d-flex align-items-center justify-content-center">
    <div class="loading d-flex flex-column align-items-center justify-content-center">
        <img :src="`${baseURL}images/infinity.gif`" class="rounded-pill">
        <h3 class="font-weight-light mt-3">{{ text }}</h3>
    </div> 
</div>

</template>

<script>
export default {
    props: [ 'text', 'condition' ],
    data() {
        return {
            baseURL
        }
    }
}
</script>

<style>
.loading-backdrop {
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    position: fixed;
    top: 0px;left: 0px;
    z-index: 2;
}
.loading{
    width: 80%;
    background: white;
    box-shadow: 1px 1px 6px rgba(0,0,0,0.16);
    border-radius: 10px;
    padding: 30px 15px;
    position: absolute;
    max-width: 400px !important;
}
.loading img{
    max-width: 150px;
    
}
</style>