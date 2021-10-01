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
                                <div class="card-body" v-if="authUser.documents === null">
                                    <p>
                                        <span class="font-weight-bold">UPLOAD </span> <span class="font-weight-light">PASSPORT/LICENSE</span>
                                    </p>    
                                    <div class="row">
                                        <div class="col-md-6 d-flex">
                                            <div class="file-holder">
                                                <span class="small light">FRONT</span>
                                                <div class="file-container d-flex align-items-center justify-content-center">
                                                    <span>+</span>
                                                    <input type="file" id="Front" accept="image/jpeg, image/png" @change="uploadFile('#Front')">
                                                </div>
                                            </div>

                                            <div class="result d-flex justify-content-center align-items-center">
                                                 <div class="progress my-4" v-if="frontbarstart">
                                                    <div class="progress-bar" role="progressbar" :style="'width: '+progress+'%'" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
                                                </div>
                                                <img :src="`${baseURL}/trans/documents/${formData.frontImage}`" v-if="formData.frontImage != undefined" alt="" class="img-fluid mb-3">
                                            </div>
                                        </div>

                                         <div class="col-md-6 d-flex">
                                            <div class="file-holder">
                                                <span class="small light">BACK</span>
                                                <div class="file-container d-flex align-items-center justify-content-center">
                                                    <span>+</span>
                                                    <input type="file" id="Back" accept="image/jpeg, image/png" @change="uploadFile('#Back')">
                                                </div>
                                            </div>

                                            <div class="result justify-content-center align-items-center">
                                                <div class="progress my-4" v-if="backbarstart">
                                                    <div class="progress-bar" role="progressbar" :style="'width: '+progress+'%'" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
                                                </div>
                                                <img :src="`${baseURL}/trans/documents/${formData.backImage}`" v-if="formData.backImage != undefined" alt="" class="img-fluid mb-3">
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <p class="mt-5">
                                        <span class="font-weight-bold">UPLOAD </span> <span class="font-weight-light">FACIAL VIDEO</span>
                                    </p> 

                                    <div class="file-holder">
                                        <span class="small light">VIDEO</span>
                                        <div class="file-container d-flex align-items-center justify-content-center">
                                            <span>+</span>
                                            <input type="file" id="Video" accept="video/mp4" @change="uploadFile('#Video')">
                                        </div>
                                    </div>

                                    <div class="result justify-content-center align-items-center">
                                        <div class="progress my-4" v-if="videobarstart">
                                            <div class="progress-bar" role="progressbar" :style="'width: '+progress+'%'" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
                                        </div>
                                        <span class="badge badge-success" v-if="formData.video != undefined">Video Uploaded</span>
                                    </div>

                                    <div class="form-group mt-4 text-right">
                                        <button class="btn btn-sm btn-success" @click.prevent="submitDocs">SUBMIT</button>
                                    </div>

                                </div>

                                <div class="card-body" v-if="authUser.documents != undefined && authUser.documents !== null">
                                    <h4>
                                        <span class="font-weight-bold">UPLOADED </span> <span class="font-weight-light">DOCUMENTS</span>
                                    </h4> 
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <span class="small d-block mb-2">FRONT SIDE</span>
                                            <img :src="`${baseURL}trans/documents/${authUser.documents.frontImage}`" alt="" class="img-fluid">
                                        </div>
                                         <div class="col-md-6">
                                         <span class="small d-block mb-2">BACK SIDE</span>
                                            <img :src="`${baseURL}trans/documents/${authUser.documents.backImage}`" alt="" class="img-fluid">
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-12 mt-3">
                                            <span class="small d-block mb-2">FACIAL RECOGNITION VIDEO</span>
                                            <video controls width="100%">
                                                <source :src="`${baseURL}trans/documents/${authUser.documents.video}`"
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
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            edit: false,
            formData: {},
            moment,
            frontbarstart: false,
            backbarstart: false,
            videobarstart: false,
            baseURL
        }
    },
    computed: {
        ...mapGetters("user", ['errors', 'progress', 'authUser']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", ["uploadVerificationDocs", 'addVerificationDocs']),
        async init() {
            
        },
        uploadFile(id) {
            let file = document.querySelector(id).files[0];
            if((file.size/1000000) > 17){
                Swals.message("Error", "File size should be less that 15 MB", "error");
                return;
            }
            if(file.type.includes('jpg') || file.type.includes('jpeg') || file.type.includes('png') || file.type.includes('mp4')){
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = () => {
                    if(id === '#Front'){
                        this.frontbarstart = true;
                    }else if(id === "#Back") {
                        this.backbarstart = true;
                    }else if(id === "#Video"){
                        this.videobarstart = true;
                    }
                    this.uploadVerificationDocs(reader.result).then((response) => {
                        if(id === '#Front'){
                            this.formData.frontImage = response;
                            this.frontbarstart = false;
                        }else if(id === "#Back") {
                            this.formData.backImage = response;
                            this.backbarstart = false;
                        }else if(id === "#Video"){
                            this.formData.video = response;
                            this.videobarstart = false;
                        }
                    }).catch(
                        () => {
                            
                        }
                    );
                }; 
            }else{
                alert('only image file is allowed')
            } 
        },
        async submitDocs() {
            let resp = await this.addVerificationDocs(this.formData);
            console.log(resp);
            if(resp === 'error'){
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swals.message('Error', errors, 'error');
            }else if(resp === 'success') {
                Swals.toast('Documents Submitted Successfully', 'success');
                // this.$router.push('/transporter/dashboard');
            }
        }
    }
}
</script>

<style>
.date{
    color: #b7b7b7;
}
.file-container {
    position: relative;
    width: 70px;
    height: 80px;
    border: 1px solid #dedede;
    font-size: 50px;
    color: #bbbbbb;
    cursor: pointer;
}
.file-container input{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px; left: 0px;
    z-index: 1;
    cursor: pointer;
    opacity: 0;
}
.result {
    min-width: 150px !important;
}
</style>