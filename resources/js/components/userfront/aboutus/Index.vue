<template>
<div class="vue-container">
    <div class="container-fluid main py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="heading">
                                    <h3 class="primarylightfont mb-0 uppercase">{{ language.facts }}</h3>
                                    <h3 class="primaryheavyfont mb-0 uppercase">{{ language.about_us }}</h3>
                                    <hr class="extrabg">
                                </div>

                                <p class="mt-3 primarylightfont" v-html="language.about_hero"></p>

                                <div class="form-group mt-3 text-right mt-5 mb-3">
                                    <router-link to="/help" class="yellowbtn mb-4 uppercase text-decoration-none text-white">{{ language.know_more  }}</router-link>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <img :src="`${baseURL}images/truck-driver.jpeg`" alt="" class="img-fluid puff-in-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="section mobilepadding">
        <div class="divider text-center my-5">
            <h1 class="primaryheavyfont">{{ language.how_buscargo }}</h1> 
            <p class="primarylightfont">{{ language.values_more }}</p>
        </div>
        <div class="container">
            <div class="row">           
                <div class="col-md-6">
                    <img :src="`${baseURL}images/carriage.jpg`" alt="" class="img-fluid">
                </div>

                <div class="col-md-6">
                    <div class="heading">
                        <h1 class="primaryheavyfont">{{ language.all_hefty_work }}</h1>
                        <hr class="w-25 bg-warning">
                    </div>
                    <p class="primarylightfont mt-4">
                        {{ language.hefty_work_desc }}
                    </p>
                    <div class="form-group mt-3 text-right mt-5 mb-3">
                        <router-link to="/search" class="yellowbtn bg-primary mb-4 uppercase text-decoration-none text-white uppercase">{{ language.start_making_money }}</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section-search mobilepadding">
        <div class="container">
            <div class="divider d-flex flex-column justify-content-center align-items-center my-5">
                <h1 class="primaryheavyfont">{{ language.search_help }}</h1> 
                <hr class="w-25 bg-warning">
            </div>
            <div class="row">           
                <div class="col-md-6">
                   <div class="d-flex flex-column">
                       <ul class="list-unstyled">
                           <li class="bullets"><i class="fas fa-check checkmark me-3" aria-hidden="true"></i> {{ language.search_help_1 }} </li> 
                           <li class="bullets"><i class="fas fa-check checkmark me-3" aria-hidden="true"></i> {{ language.search_help_2 }} </li> 
                           <li class="bullets"><i class="fas fa-check checkmark me-3" aria-hidden="true"></i> {{ language.search_help_3 }} </li>
                           <li class="bullets"><i class="fas fa-check checkmark me-3" aria-hidden="true"></i> {{ language.search_help_4 }} </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <img :src="`${baseURL}images/search_cat.svg`" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>


    <div class="mobilepadding secondarybg contact-strip container-fluid text-white py-4 mt-5">
        <div class="container d-flex justify-content-between">
            <div class="contact d-flex align-items-center">
                <div class="icon me-5">
                    <i class="fas fa-phone-volume bigicon"></i>
                </div>

                <div class="content">
                    <h4 class="primaryheavyfont mb-0 uppercase">{{ language.you_can_contact }}</h4>
                    <p class="primarylightfont mb-3 uppercase">{{ language.anytime }}</p>
                    <h5 class="primaryheavyfont"><a href="mailto:info@buscargo.pt" class="text-white text-decoration-none">info@buscargo.pt</a></h5>
                    <h5 class="primarylightfont"><a href="tel:963249313" class="text-white text-decoration-none">963249313</a></h5>
                </div>
            </div>

            <div class="timing d-flex align-items-center">
                <div class="icon me-5">
                    <i class="fas fa-clock bigicon"></i>
                </div>

                <div class="content">
                    <h4 class="primaryheavyfont mb-0 uppercase">{{ language.our_team_is_available }}</h4>
                    <p class="primarylightfont mb-2">9 AM to 9 PM</p>
                    <h4 class="primaryheavyfont uppercase">SUN - MON</h4>
                </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
export default {
    data() {
        return {
            baseURL,
            language: require(`../language/${$lang}/about.json`),
        }
    }
}
</script>

<style scoped>
.contact .bigicon {
    font-size: 5.45rem !important;
}
.bigicon{
    font-size: 4.45rem !important;
    opacity: 0.8;
}

.extrabg {
    width: 90px;
    height: 5px;
}
.main{
    background: #94bce1;
}
.main img{
    border-radius: 25px;
    margin-top: 70px;
}
.section-search{
    margin-top: 100px;
}
hr{ height: 7px; }
.white-box{
    background: white;
    width: 100%;
    min-height: 200px !important;
    box-shadow: 1px 1px 8px rgba(0,0,0,0.16);
    border-radius: 10px;
    padding: 30px 35px;
    margin-left: 0px !important;
    background: rgb(255,146,36) !important;
    background: linear-gradient(125deg, rgba(255,255,255,1) 54%, #FFE1C2 54%) !important;
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
     .main{
         /* margin-top: 70px !important;  */
     }
     .contact-strip .container{
         flex-direction: column !important;
    }
    .contact-strip{
        padding-top: 40px !important;
        padding-bottom: 40px !important;
    }
    .contact-strip .contact{
        margin-bottom: 40px;
    }
}
</style>