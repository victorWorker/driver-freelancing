<template>
    <div class="vue-container">
        <div class="container-fluid find p-0 secondarybg mobilemargin">
            <div class="container yellobigbox paddedcontainer">
                <div class="row">
                    <div class="col-md-6 d-flex searchinfo text-white">
                        <div class="d-flex flex-column">
                            <h1 class="primaryheavyfont">{{ language.how_buscargo_works }}</h1>
                            <hr class="w-25 borderedhr">
                            <p class="primaryregularfont">{{ language.works_1 }}</p>
                            <p class="primaryregularfont">{{ language.works_2 }}</p>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <img :src="baseURL+'images/review.svg'" class="w-100 roll-in-blurred-left" />
                    </div>
                </div>
            </div> 
        </div>
        <!--- Find Box -->
        <div class="container-fluid p-0">
            <div class="container yellobigbox paddedcontainer mobilepadding">
                <div class="row">
                    <!-- Divider-->
                    <div class="divider text-center my-5">
                        <h1 class="primaryheavyfont">{{ language.ship_with_buscargo }}</h1>
                        <p class="primarylightfont">{{ language.in_three_steps }}</p>
                    </div>
                    <!-- Divider-->
                </div>
                <div class="row">
                    <div class="col-md-6 d-flex searchinfo ">
                        <div class="d-flex flex-column">
                            <h1 class="primaryheavyfont">{{ language.three_simple_steps }}</h1>
                            <hr class="w-25 borderedhr2">
                            <p class="primaryregularfont">{{ language.step_p_1 }}</p>
                            <p class="primaryregularfont">{{ language.step_p_1 }}</p>
                            <ul class="list-unstyled">
                                <li><a class="markings primaryheavyfont text-decoration-none fs-1" href="#request"><i class="fas fa-check checkmark"></i> {{ language.step_1 }}</a></li>
                                <li><a class="markings primaryheavyfont text-decoration-none fs-1" href="#compare"><i class="fas fa-check checkmark"></i> {{ language.step_2 }}</a></li>
                                <li><a class="markings primaryheavyfont text-decoration-none fs-1" href="#done"><i class="fas fa-check checkmark"></i> {{ language.step_3 }}</a></li>
                            </ul>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <img :src="baseURL+'images/three.png'" class="w-100" />
                    </div>
                </div>
                <!-- full ctbox -->
                <div class="row" id="request">
                    <!-- Divider-->
                    <div class="divider2 text-center">
                        <h1 class="primaryheavyfont">{{ language.tell_about_delivery }}</h1>
                        <hr class="w-25 borderedhr2 mx-auto">
                    </div>
                    <!-- Divider-->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img :src="baseURL+'images/delivery.svg'" class="w-100" />
                    </div>
                    <div class="col-md-6 d-flex searchinfo ">
                        <div class="d-flex flex-column">
                            <p class="primaryregularfont mt-5 mt-sm-0">{{ language.about_delivery_p_1 }}</p>
                            <ul class="list-unstyled">
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.about_delivery_point_1 }}</li>
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.about_delivery_point_2 }}</li>
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.about_delivery_point_3 }}</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <!-- full ctbox -->
                
                <!-- full ctbox -->
                <div class="row" id="compare">
                    <!-- Divider-->
                    <div class="divider2 text-center">
                        <h1 class="primaryheavyfont">{{ language.compare_quotes }}</h1>
                        <hr class="w-25 borderedhr2 mx-auto">
                    </div>
                    <!-- Divider-->
                </div>
                <div class="row">
                    <div class="col-md-6 d-flex searchinfo ">
                        <div class="d-flex flex-column">
                            <p class="primaryregularfont">{{ language.compare_quotes_p }}</p>
                            <ul class="list-unstyled">
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.compare_quotes_point_1 }}</li>
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.compare_quotes_point_2 }}</li>
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.compare_quotes_point_3 }}</li>
                            </ul>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <img :src="baseURL+'images/compare.svg'" class="w-100" />
                    </div>
                </div>
                <!-- full ctbox -->

                <!-- full ctbox -->
                <div class="row" id="done">
                    <!-- Divider-->
                    <div class="divider2 text-center">
                        <h1 class="primaryheavyfont">{{ language.safe_delivery }}</h1>
                        <hr class="w-25 borderedhr2 mx-auto">
                    </div>
                    <!-- Divider-->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img :src="baseURL+'images/complete.svg'" class="w-100" />
                    </div>
                    <div class="col-md-6 d-flex searchinfo ">
                        <div class="d-flex flex-column">
                            <p class="primaryregularfont mt-5 mt-sm-0">{{ language.safe_delivery_p }}</p>
                            <ul class="list-unstyled">
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.safe_delivery_point_1 }}</li>
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.safe_delivery_point_2 }}</li>
                                <li class="bullets"><i class="fas fa-check checkmark me-3"></i> {{ language.safe_delivery_point_3 }}</li>
                            </ul>
                        </div>
                        
                    </div>
                    
                </div>
                <!-- full ctbox -->
            </div> 
        </div>
        
    </div>
</template>

<script>
export default {
    data(){
        return {
            baseURL,
            language: require(`../language/${$lang}/works.json`),
        }
    }
}
</script>
<style lang="css">
    .borderedhr{
        height:10px !important;
        background: #fff;
        opacity:0.5;
    }
    .borderedhr2{
        height:10px !important;
        background: #FF9224;
        opacity:1;
    }
    .checkmark{
        color:#FF9224 !important;
        font-size: 1.5rem !important;
    }
    .markings{
        color: #212529;
    }
    .bullets{
        color: #212529;
        font-size: 1rem !important;
        margin: 45px 0px;
    }
    .divider2{
        margin-top:8rem;
        margin-bottom: 8rem;
    }
    .roll-in-blurred-left {
	-webkit-animation: roll-in-blurred-left 0.65s cubic-bezier(0.230, 1.000, 0.320, 1.000) both;
	        animation: roll-in-blurred-left 0.65s cubic-bezier(0.230, 1.000, 0.320, 1.000) both;
    }
   
    @-webkit-keyframes roll-in-blurred-left {
    0% {
        -webkit-transform: translateX(-1000px) rotate(-720deg);
                transform: translateX(-1000px) rotate(-720deg);
        -webkit-filter: blur(50px);
                filter: blur(50px);
        opacity: 0;
    }
    100% {
        -webkit-transform: translateX(0) rotate(0deg);
                transform: translateX(0) rotate(0deg);
        -webkit-filter: blur(0);
                filter: blur(0);
        opacity: 1;
    }
    }
    @keyframes roll-in-blurred-left {
    0% {
        -webkit-transform: translateX(-1000px) rotate(-720deg);
                transform: translateX(-1000px) rotate(-720deg);
        -webkit-filter: blur(50px);
                filter: blur(50px);
        opacity: 0;
    }
    100% {
        -webkit-transform: translateX(0) rotate(0deg);
                transform: translateX(0) rotate(0deg);
        -webkit-filter: blur(0);
                filter: blur(0);
        opacity: 1;
    }
    }
    @media (max-width: 500px){
        .mobilemargin{
            /* margin-top: 4rem; */
        }
        .divider2{
            margin-top: 4rem;
            margin-bottom: 2rem;
        }
    }

    
</style>