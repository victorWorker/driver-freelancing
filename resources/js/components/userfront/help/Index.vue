<template>
<div class="vue-container">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="white-box modal-body w-auto">
                <div class="row">
                    <div class="col-md-4">
                        <div class="headings">
                            <h2 class="primarylightfont mb-0 topheading uppercase">{{ language.get_our }}</h2> 
                            <h2 class="primaryheavyfont uppercase mb-0 uppercase">{{ language.help }}</h2>
                            <hr class="extrabg">

                            <div class="form mt-5">
                                <div class="inputingroup w-100 bg-white px-3 py-1">
                                    <label class="uppercase">{{ language.name }}</label> 
                                    <input  type="text" v-model="formData.name" :placeholder="language.name_placeholder">
                                </div>

                                <div class="inputingroup w-100 bg-white px-3 py-1">
                                    <label class="uppercase">{{ language.email }}</label> 
                                    <input  type="email" v-model="formData.email" :placeholder="language.email_placeholder">
                                </div>

                                <div class="inputingroup w-100 bg-white px-3 py-1">
                                    <label class="uppercase">{{ language.query }}</label> 
                                    <textarea :placeholder="language.query_placeholder" v-model="formData.queryText" rows="5"></textarea>
                                </div>

                                <div class=" w-100 bg-white px-3 py-1">
                                    <label class="uppercase"><i class="fas fa-phone-volume" aria-hidden="true"></i> 937 982 969</label> 
                                </div>

                                <div class="form-group mt-3 text-right">
                                    <button class="yellowbtn mb-4 uppercase" @click="sendHelpRequest">{{ language.get_help }}</button>
                                </div>
                            </div>
                            </div>
                    </div>

                    <div class="col-md-8">
                        <img :src="`${baseURL}images/contact_img.svg`" alt="" class="contact-img puff-in-center">
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    data(){
        return {
            baseURL,
            formData: {
                namae: '',
                email: '',
                queryText: ''
            },
            language: require(`../language/${$lang}/help.json`),
        }
    },
    methods: {
        ...mapActions('front', ['getHelp']),
        async sendHelpRequest() {
            if(this.formData.name === '' || this.formData.email === '' || this.formData.query === ''){
                Swals.message('ERROR!', 'All Fields are Required', 'error');
                return;
            }else{
                let resp = await this.getHelp(this.formData);
                if(resp === 'success') {
                    Swals.message('SUCCESS', "Your Request Is Received by Us. <br /> You Will be Contacted Shortly", 'success');
                    this.formData = {
                        name: '',
                        email: '',
                        queryText: ''
                    }
                }
            }
        }
    }
}
</script>

<style scoped>
    .white-box{
        width: 100%;
        min-height: 200px !important;
        box-shadow: 1px 1px 8px rgba(0,0,0,0.16);
        border-radius: 10px;
        padding: 30px 35px;
        margin-left: 0px !important;
    }
    .contact-img{
        width: 100%;
    }
    .extrabg {
        width: 70px;
        height: 5px;
    }
    .yellowbtn {
        border: 2px solid #fff;
    }

    .puff-in-center {
	-webkit-animation: puff-in-center 0.6s cubic-bezier(0.470, 0.000, 0.745, 0.715) both;
	        animation: puff-in-center 0.6s cubic-bezier(0.470, 0.000, 0.745, 0.715) both;
}

@-webkit-keyframes puff-in-center {
  0% {
    -webkit-transform: scale(2);
            transform: scale(2);
    -webkit-filter: blur(4px);
            filter: blur(4px);
    opacity: 0;
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
    -webkit-filter: blur(0px);
            filter: blur(0px);
    opacity: 1;
  }
}
@keyframes puff-in-center {
  0% {
    -webkit-transform: scale(2);
            transform: scale(2);
    -webkit-filter: blur(4px);
            filter: blur(4px);
    opacity: 0;
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
    -webkit-filter: blur(0px);
            filter: blur(0px);
    opacity: 1;
  }
}

@media screen and (max-width: 767px){
     .white-box{
        /* margin-top: 100px !important;  */
        background: rgb(255,146,36) !important;
        background: linear-gradient(125deg, rgba(255,146,36,1) 54%, rgba(255,255,255,1) 54%) !important;
     }
     .white-box h2{
         color: white !important;
     }
}
</style>