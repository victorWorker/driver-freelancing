<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.verify}}</span>  {{ language.profile }}</h4>
                <span class="clearfix"></span>
                    <div class="row mt-4">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-body" v-if="user.details != undefined && user.details.documents !== null">
                                    <h4>
                                        <span class="font-weight-bold">UPLOADED </span> <span class="font-weight-light">DOCUMENTS</span>
                                    </h4> 
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <span class="small d-block mb-2">FRONT SIDE</span>
                                            <img :src="`${baseURL}trans/documents/${user.details.documents.frontImage}`" alt="" class="img-fluid">
                                        </div>
                                         <div class="col-md-6">
                                         <span class="small d-block mb-2">BACK SIDE</span>
                                            <img :src="`${baseURL}trans/documents/${user.details.documents.backImage}`" alt="" class="img-fluid">
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-12 mt-3">
                                            <span class="small d-block mb-2">FACIAL RECOGNITION VIDEO</span>
                                            <video controls width="100%">
                                                <source :src="`${baseURL}trans/documents/${user.details.documents.video}`"
                                                        type="video/mp4">

                                               Sorry, your browser doesn't support embedded videos.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
        </div>

        
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';

export default {
    data() {
        return {
            language: require(`../language/${$lang}/verify.json`),
            moment,
            baseURL
        }
    },
    computed: {
        ...mapGetters("user", ['errors', 'user']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", [ 'getUser']),
        async init() {
            let resp = await this.getUser(this.$route.params.id);
        },
      
    }
}
</script>

<style>
.date{
    color: #b7b7b7;
}

</style>