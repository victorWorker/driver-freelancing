<template>
   <section class="section my_sec">
               <div class="container">
                  <div class="row  flex-xl-row align-items-end">
                     <div class="col-xl-6 top-50 top-xl-0">
                        <div class="promo-tabs tabs horizontal-tabs">
                           <div class="heading bottom-20">
                              <h3 class="heading__title" style="font-size: 30px; color: #93bbe1">Shipper Meet Carrier</h3>
                               <h3 class="heading__title" style="font-size: 30px;">Carrier Meet Shippers</h3>
                           </div>
                           <p class="bottom-0">Choice of Customers</p>
                           <ul style="display: none;" class="horizontal-tabs__header r-tabs-nav">
                              <li class="r-tabs-tab r-tabs-state-active"><a href="#horizontal-tabs__item-1" class="r-tabs-anchor"></a></li>
                              </ul>
                               
                              <div class="horizontal-tabs__content">

                                 <div class="horizontal-tabs__item" id="horizontal-tabs__item-1">

                                    <form class="form promo-form promo-form--f5" method="post" action="" autocomplete="off">
                                       <div class="row offset-20">
                                          <div class="col-md-12">
                                             <select required class="form__select" name="transport" id="transport">
                                                <option data-display="Choose Transport">Where are you moving?</option>
                                                
                                             </select>
                                          </div>
                                          <div class="col-sm-6">
                                             <label>
                                                <svg class="icon">
                                                   <use xlink:href="#pin">
                                                     <svg viewBox="0 0 512 512" id="pin" xmlns="http://www.w3.org/2000/svg">
                                                       <path d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 469.729c-55.847-66.338-152.035-197.217-152.035-284.301 0-83.834 68.202-152.036 152.035-152.036s152.035 68.202 152.035 152.035C408.034 272.515 311.861 403.37 256 469.729z"></path>
                                                       <path d="M256 92.134c-51.442 0-93.292 41.851-93.292 93.293S204.559 278.72 256 278.72s93.291-41.851 93.291-93.293S307.441 92.134 256 92.134zm0 153.194c-33.03 0-59.9-26.871-59.9-59.901s26.871-59.901 59.9-59.901 59.9 26.871 59.9 59.901-26.871 59.901-59.9 59.901z"></path>
                                                    </svg>
                                                   </use>
                                                </svg>
                                                <input required class="form__field " type="text" id="collection" name="from" placeholder="Collection Location"/>
                                             </label>
                                          </div>
                                          <div class="col-sm-6">
                                             <label>
                                                <svg class="icon">
                                                   <use xlink:href="#pin">
                                                     <svg viewBox="0 0 512 512" id="pin" xmlns="http://www.w3.org/2000/svg">
                                                     <path d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 469.729c-55.847-66.338-152.035-197.217-152.035-284.301 0-83.834 68.202-152.036 152.035-152.036s152.035 68.202 152.035 152.035C408.034 272.515 311.861 403.37 256 469.729z"></path>
                                                     <path d="M256 92.134c-51.442 0-93.292 41.851-93.292 93.293S204.559 278.72 256 278.72s93.291-41.851 93.291-93.293S307.441 92.134 256 92.134zm0 153.194c-33.03 0-59.9-26.871-59.9-59.901s26.871-59.901 59.9-59.901 59.9 26.871 59.9 59.901-26.871 59.901-59.9 59.901z"></path>
                                                  </svg>
                                                   </use>
                                                </svg>
                                                <input required class="form__field mapfield" id="delivery" type="text" name="To" placeholder="Delivery Location" />
                                             </label>
                                          </div>
                                              <div id="map"></div>
                                       <div class="col-sm-6 col-md-3">
                                          <button class="button button--green" style="background: #0d6efd;color: white;font-size: 15px;" type="submit">
                                             <span>Post Label</span> 
                                             <svg class="icon">
                                                <use xlink:href="#arrow">
                                                  <svg viewBox="0 0 150 78.6" id="arrow" xmlns="http://www.w3.org/2000/svg">
                                                     <path d="M0 31.5h150v12.7H0V31.5zM112.8-.1l30.9 31.5-8.8 9L104 8.9l8.8-9zm18.1 51l-18.4 18.8 8.9 9 18.4-18.8-8.9-9z"></path>
                                                  </svg>
                                                </use>
                                             </svg>
                                          </button>
                                       </div>
                                    </div>
                                 </form>

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 text-center text-xl-left"><img class="truck-img" src="`${baseURL}images/truck.jpg`" alt="img">
                        Want to Register Here

                     </div>
                  </div>
               </div>
            </section>
     
      
</template>


<script>


import {mapGetters,mapActions} from 'vuex';
import moment from 'moment';
export default{
    data(){
        return {
            moment,
            baseURL,
            userType,
            token: localStorage.getItem('token'),
            language: require(`../language/${$lang}/listing.json`),
        
        }
    },
    computed:{
       
    },
    methods:{
        
      
    },
    mounted(){
      
    }
}
</script>



<style scoped>

	.icon-item__img img {
    max-height: 270px;
    width: auto;
}

	.icon-item {
    margin-bottom: 30px;
}
	.my_border
	{ 
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    text-align: center;
	 }

	 .my_border1
	{ 
    border-right: 1px solid #ccc;
    border-bottom: 0px solid #ccc;
    padding-top: 20px;
    text-align: center;
	 }

	.quote_my
	{
		color: white;
    font-size: 17px;
    padding: 10px 25px;
    background: #0d6efd;
	}

   .logos-slider__item::before {
    
    background: #d1d1d1;}
   .form .nice-select.open {
     position: relative;
  }
  .form .nice-select.open:before {
     border-left: 10px solid #9e676700;
     border-right: 10px solid #9e676700;
     border-bottom: 12px solid;
     border-bottom-color: inherit;
     content: "" !important;
     position: absolute;
     left: 45px;
     opacity: 1;
     z-index: 999999;
     bottom: -5px;
  }
  .form .nice-select,.form .nice-select .list {
   border: 3px solid #e2e2e2 !important;
     box-shadow: 1px 1px 6px rgb(0 0 0 / 15%);
    border-radius: 10px;
}
.form__field {
   border: 3px solid #e2e2e2 !important;
     box-shadow: 1px 1px 6px rgb(0 0 0 / 15%);
    border-radius: 10px;
 }

   .promo-tabs .horizontal-tabs__content {
      padding: 40px 0px;
   }
   .advantages-item__title {
      font-size: 22px;
   }
   .my_sec
   { 
      padding: 100px 0 !important; 
   }
   a {
      color: #000000;
      text-decoration: none;
   }
   ul.list li[data-value="What are you moving?"]:before {
    content: "\f4df";
    font-family: "FontAwesome";
    margin-right: 15px;
} 
ul.list li[data-value="value"]:before {
    content: "\f6c0";
    font-family: "FontAwesome";
    margin-right: 15px;
} 
ul.list li[data-value="value2"]:before {
    content: "\f015";
    font-family: "FontAwesome";
    margin-right: 15px;
} 
ul.list li[data-value="value3"]:before {
    content: "\f1b9";
    font-family: "FontAwesome";
    margin-right: 15px;
}  
ul.list li[data-value="value4"]:before {
    content: "\f49e";
    font-family: "FontAwesome";
    margin-right: 15px;
}
   .page-header_3 {
      position: relative;}
      .promo-tabs {
         box-shadow: none !important;}
         .align-items-center {
            align-items: center !important;
         }
         .topmenu .infoblock .fas {
            font-size: 1.5rem;
            margin-right: 10px;
         }
         .fa-phone-volume:before {
            content: "\f2a0";
         }
         .topmenu .infoblock .biginfo {
            font-family: "GalanoGrotesqueBold";
         }
         .topmenu .infoblock .smallinfo {
            font-size: 0.7rem;
            font-family: 'GalanoGrotesqueLight';
         }
         .mt-4 {
            margin-top: 1.5rem !important;
         }
         .mb-0 {
            margin-bottom: 0 !important;
         }
         .topmenu .infoblock .fas {
            font-size: 1.5rem;
            margin-right: 10px;
         }
         .fa-at:before {
            content: "\f1fa";
         }
         .topmenu .infoblock .biginfo {
            
            font-family: "GalanoGrotesqueBold";
         }
         .topmenu .infoblock .smallinfo {
            font-size: 0.7rem;
            font-family: 'GalanoGrotesqueLight';
         }
         .flex-column {
            flex-direction: column !important;
         }
         .d-flex {
            display: flex !important;
         }
         .justify-content-end {
            justify-content: flex-end !important;
         }
         .topmenu .registermodal {
            background: #FFE1C2;
            border-radius: 0px 0px 10px 10px;
            padding: 5px 20px;
            align-items: center;
         }
         .topmenu .registermodal .fas {
            margin-right: 10px;
            color: #5D5D5D;
         }
         .topmenu .registermodal .registertext {
            font-size: 1.2rem;
            margin-bottom: 0px;
            color: #5D5D5D;
            font-family: "GalanoGrotesqueBold";
         }
         .uppercase {
            text-transform: uppercase !important;
         }
         .topmenu .registermodal .registertext a {
            text-decoration: none;
            color: inherit;
         }
         .fa-user:before {
            content: "\f007";
         }
         .topmenu .infoblock {
            background: #FF9224;
            color: white;
            
         }
         .ms-5 {
            margin-left: 3rem !important;
         }
         .justify-content-evenly {
            justify-content: space-evenly !important; 
         }
         .w-50 {
            width: 50% !important;
         }
         .roundedborderbutton {
            background: none;
            border: 1px solid #5D5D5D;
            border-radius: 2rem;
            padding: 10px 15px;
         }
         nav ul .active {
            font-family: 'GalanoGrotesqueBold';
            border: 1px solid #5D5D5D;
         }
         .uppercase {
            text-transform: uppercase !important;
         }
         nav ul li {
            list-style: none;
            display: inline;
            padding: 10px 15px;
            border-radius: 2rem;
            font-size: 0.8rem;
         }
         .mycol
         {
            display: block !important;
         }
         
         .text-white {
            color: #fff !important;
         }
         .blackbg {
            background: #5D5D5D;
         }
         .position-relative {
            position: relative !important;
         }
         .pb-5 {
            padding-bottom: 3rem !important;
         }
         .mt-5 {
            margin-top: 3rem !important;
         }
         .footer .yellowlogo {
            position: absolute;
            max-width: 15rem;
            top: -50px;
         }
         .footer h2 {
            font-size: 1rem;
            line-height: 1rem;
            margin-bottom: 0px;
         }
         .language[data-v-75fbb3d3] {
            margin-top: 25px;
         }
         .footer .links ul li{
            list-style: none !important;
         }
         .footer .links ul li a {
            text-decoration: none !important;
            color: white;
         }
         .copyright p {
            font-size: 0.8rem;
         }
         .text-secondary {
            color: #6c757d !important;
         }
         .copyright {
            border-radius: 1rem 1rem 0rem 0rem;
            padding: 5px 0px;
            display: flex;
            justify-content: center;
            left: 0;
         }
         .bg-white {
            background-color: #fff !important;
         }
         .w-100 {
            width: 100% !important;
         }

         @media only screen and (min-width: 320px) and (max-width: 768px)
         { 

         	.my_border
	{ 
    border-right: 0px solid #ccc;
    border-bottom: 1px solid #ccc;
    text-align: center;
	 }

	 .my_border1
	{ 
    border-right: 0px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding-top: 20px;
    text-align: center;
	 }
         	.quote_my
	{
		color: white;
    font-size: 10px;
    padding: 10px 25px;
    background: #0d6efd;
	}

    .my_sec
    { 
        padding: 0px 0 !important; 
    }
    .mycol
    {
        display: none !important;
    }
    }
      </style>

      
