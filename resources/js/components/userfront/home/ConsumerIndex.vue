<template>
    <div class="vue-container">
        <!---Primary hero section-->
        <div class="container hero p-0">
            <div class="row">
                <div class="heroimgholder">
                    <img :src="`${baseURL}images/van.svg`" />
                </div>
                <div class="herotextholder">
                    <h2 class="primaryheavyfont secondarycolor">CONSUMER HOMEPAGE</h2>
                    <hr class="extrabg">
                    <h3 class="primaryboldfont mb-0">ANYWHERE</h3>
                    <h3 class="primarylightfont">Anytime</h3>
                    <p class="mt-4">Loreum Ipsum dolor sit ametLoreum Ipsum dolor sit ametLoreum Ipsum dolor sit ametLoreum Ipsum dolor sit ametLoreum Ipsum dolor sit amet. Loreum Ipsum dolor sit amet.</p>
                    <button class="blackbg quotebtn" data-bs-toggle="modal" href="#ship1" role="button">GET QUOTES</button>
                </div>
            </div>
            <div class="row justify-content-between features">
                <div class="feature">
                    <i class="fas fa-at"></i>
                    <div>
                        <h5 class="primaryboldfont mb-0 fhead">FURNITURE</h5>
                        <p class="mb-0">DELIVERY</p>
                    </div>
                </div>
                <div class="feature">
                    <i class="fas fa-at"></i>
                    <div>
                        <h5 class="primaryboldfont mb-0 fhead">FURNITURE</h5>
                        <p class="mb-0">DELIVERY</p>
                    </div>
                </div>
                <div class="feature">
                    <i class="fas fa-at"></i>
                    <div>
                        <h5 class="primaryboldfont mb-0 fhead">FURNITURE</h5>
                        <p class="mb-0">DELIVERY</p>
                    </div>
                </div>
                <div class="feature">
                    <i class="fas fa-at"></i>
                    <div>
                        <h5 class="primaryboldfont mb-0 fhead">FURNITURE</h5>
                        <p class="mb-0">DELIVERY</p>
                    </div>
                </div>
                <div class="feature">
                    <i class="fas fa-at"></i>
                    <div>
                        <h5 class="primaryboldfont mb-0 fhead">FURNITURE</h5>
                        <p class="mb-0">DELIVERY</p>
                    </div>
                </div>
            </div>
        </div>                 
        <!---Primary hero section-->

        <!---Stats Section-->
        <div class="container-fluid extrabg">
            <div class="container statholder">
                <div class="row justify-content-between">
                    <div class="statbox">
                        <h1 class="primaryheavyfont">1M</h1>
                        <p class="mb-0 primarylightfont">COMPLETED ORDERS </p>
                    </div>
                    <div class="statbox">
                        <h1 class="primaryheavyfont">1M</h1>
                        <p class="mb-0 primarylightfont">COMPLETED ORDERS </p>
                    </div>
                    <div class="statbox">
                        <h1 class="primaryheavyfont">1M</h1>
                        <p class="mb-0 primarylightfont">COMPLETED ORDERS </p>
                    </div>
                    <div class="statbox">
                        <h1 class="primaryheavyfont">1M</h1>
                        <p class="mb-0 primarylightfont">COMPLETED ORDERS </p>
                    </div>
                </div>
            </div>
            
        </div>
        <!---Stats Section-->

        <!--TimeLine-->
        <div class="container timeline">
            <div class="row">
                <div class="headings">
                    <h1 class="primarylightfont mb-0 topheading">SHIPPING WITH</h1>
                    <h1 class="primaryheavyfont">BUSCARGO (5 STEPS)</h1>
                </div>
                <div class="circles d-flex justify-content-between position-relative">
                    <div class="circle">
                        <h1 class="primaryheavyfont">1.</h1>
                        <p class="mb-0">POST JOB</p>
                    </div>
                    <div class="circle">
                        <h1 class="primaryheavyfont">1.</h1>
                        <p class="mb-0">POST JOB</p>
                    </div>
                    <div class="circle">
                        <h1 class="primaryheavyfont">1.</h1>
                        <p class="mb-0">POST JOB</p>
                    </div>
                    <div class="circle">
                        <h1 class="primaryheavyfont">1.</h1>
                        <p class="mb-0">POST JOB</p>
                    </div>
                    <div class="circle">
                        <h1 class="primaryheavyfont">1.</h1>
                        <p class="mb-0">POST JOB</p>
                    </div>
                    <div class="circle">
                        <h1 class="primaryheavyfont">1.</h1>
                        <p class="mb-0">POST JOB</p>
                    </div>
                    <hr class="linethrough">
                </div>
                
            </div>
        </div>
        <!--TimeLine-->

        <!--Information Block-->
            <div class="container-fluid infobox">
                    <div class="row">
                        <div class="information col-sm-5 offset-sm-1 offset-xxl-2">
                            <h1 class="primarylightfont mb-0 topheading">SHIPPING WITH</h1>
                            <h1 class="primaryheavyfont mb-4">BUSCARGO (5 STEPS)</h1>
                            <p class="mb-5">BusCargo provides shipping for business related services at a very less shipping cost. BusCargo provides shipping for business related. Loreum Ipsum dolor sit amet  Loreum Ipsum dolor sit amet  Loreum Ipsum dolor sit amet  Loreum Ipsum dolor sit amet  Loreum Ipsum dolor sit amet.</p>
                            <button class="blackbtn">HOW IT WORKS FOR BUSINESS</button>
                        </div>
                        <div class="imageblock col-sm-6 col-xxl-5">
                            <img :src="`${baseURL}images/information.png`" class="w-100">
                        </div>
                    </div>
            </div>
        <!--Information Block-->

        <!--Delivery Detail box-->
            <div class="container-fluid extrabg delivery">
                <div class="container text-white">
                    <div class="row justify-content-between align-items-center">
                        <div class="info col-sm-7">
                            <h1 class="primarylightfont lineheight2 mb-0">FREE MOVES</h1>
                            <h1 class="primaryheavyfont">FOR GOOD DEEDS</h1>
                            <p>We’ve been asked to help move some amazing charity causes over the past 11 years– and offering free moves for good deeds is an aspect of BusCargo that means a lot to us. </p>
                        </div>
                        <div class="freedelivery">
                            <img :src="`${baseURL}images/delivery.png`" class="w-100" />
                        </div>
                    </div>
                    
                </div>
            </div>
        <!--Delivery Detail box-->

        <!--Information Block-->
        <div class="container-fluid infobox secondarybg text-white ">
            <div class="row align-items-end">
                <div class="imageblock col-sm-6">
                    <img :src="`${baseURL}images/info.png`" class="w-100">
                </div>
                <div class="information col-sm-5 col-xxl-4">
                    <h1 class="primarylightfont mb-0 topheading">SHIPPING WITH</h1>
                    <h1 class="primaryheavyfont mb-4">BUSCARGO (5 STEPS)</h1>
                    <p class="mb-5">BusCargo provides shipping for business related services at a very less shipping cost. BusCargo provides shipping for business related. Loreum Ipsum dolor sit amet  Loreum Ipsum dolor sit amet  Loreum Ipsum dolor sit amet  Loreum Ipsum dolor sit amet  Loreum Ipsum dolor sit amet.</p>
                    <button class="blackbtn">HOW IT WORKS FOR BUSINESS</button>
                </div>
            </div>
        </div>
        <!--Information Block-->

        <!--Our Clients-->
        <div class="container-fluid splash">
            <div class="container">
                <div class="row">
                    <h1 class="primarylightfont lineheight2">OUR</h1>
                    <h1 class="primaryheavyfont mb-5">CLIENTS</h1>
                </div>
                <div class="row mb-5">
                    <div class="logos bg-white d-flex justify-content-between mb-5">
                        <div class="logo">
                            <img :src="`${baseURL}images/times.png`" class="img-fluid">
                        </div>
                        <div class="logo">
                            <img :src="`${baseURL}images/times.png`" class="img-fluid">
                        </div>
                        <div class="logo">
                            <img :src="`${baseURL}images/times.png`" class="img-fluid">
                        </div>
                        <div class="logo">
                            <img :src="`${baseURL}images/times.png`" class="img-fluid">
                        </div>
                        <div class="logo">
                            <img :src="`${baseURL}images/times.png`" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Our Clients-->
        <Shipment :baseURL="baseURL"/>
        <SelectRole />
</div>
</template>

<script>
import Shipment from '../common/Shipment';
import SelectRole from '../common/SelectRole';
export default {
    components:{
        Shipment,
        SelectRole
    },
    data() {
        return {
            baseURL,
        }
    },
    mounted(){
        if(localStorage.getItem('role') !== 'consumer'){
            var myModal = new bootstrap.Modal(document.getElementById('SelectRole'));
            myModal.show();
        } 
    }
}
</script>
<style scoped>

</style>