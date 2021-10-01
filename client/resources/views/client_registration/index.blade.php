@include('includes.header') 
         <main class="main">
            <!-- promo start-->
            <section class="section my_sec">
               <div class="container">
                  <div class="row  flex-xl-row align-items-end">
                     <div class="col-xl-6 top-50 top-xl-0">
                        <div class="promo-tabs tabs horizontal-tabs">
                           <div class="heading bottom-20">
                              <h3 class="heading__title" style="font-size: 30px; color: #93bbe1">{{ __('messages.SHIPPERS_MEET_CARRIERS') }}</h3>
                               <h3 class="heading__title" style="font-size: 30px;">{{ __('messages.CARRIERS_MEET_SHIPPERS') }}</h3>
                           </div>
                           <p class="bottom-0">{{ __('messages.CHOICE_OF_CUSTOMERS') }}</p>
                           <ul style="display: none;" class="horizontal-tabs__header r-tabs-nav">
                              <li class="r-tabs-tab r-tabs-state-active"><a href="#horizontal-tabs__item-1" class="r-tabs-anchor"></a></li>
                              <!-- <li><a href="#horizontal-tabs__item-2"><span>For Private Person</span></a></li>
                                 <li><a href="#horizontal-tabs__item-3"><span>For Public Sector</span></a></li> -->
                              </ul>
                               
                              <div class="horizontal-tabs__content">

                                 <div class="horizontal-tabs__item" id="horizontal-tabs__item-1">

                                     @if (isset($message) && $message!='')
                                   <div class="alert alert-success">
                                     <p style="color: green;">Thanks for registering with us <a href="https://buscargo.pt/" target="_self">click here</a> to login</p>
                                   </div>
                                   @endif
                                    <form class="form promo-form promo-form--f5" method="post" action="{{url('step2')}}" autocomplete="off">

                                       @csrf
                                       <div class="row offset-20">
                                          <div class="col-md-12">
                                             <select required class="form__select" name="transport" id="transport">
                                                <option data-display="{{__('messages.CHOOSE_TRANSPORT')}}">{{__('messages.WHAT_ARE_YOU_MOVING')}}?</option>
                                                @foreach($categories as $category)
                                                   <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                                <!--<option value="value2" style="background-image:url(images/home.png);width: 25px;">Home Removals</option>
                                                <option value="value3" style="background-image:url(images/car.png);width: 25px;">Cars & Vehicles</option>
                                                <option value="value4" style="background-image:url(images/pack.png);width: 25px;">Packaged Items & Parcels</option>-->
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
                                                <input required class="form__field " type="text" id="collection" name="from" placeholder="{{__('messages.COLLECTION_LOCATION')}}"/>
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
                                                <input required class="form__field mapfield" id="delivery" type="text" name="To" placeholder="{{__('messages.DELIVERY_LOCATION')}}"/>
                                             </label>
                                          </div>
                                              <div id="map"></div>
                                       <div class="col-sm-6 col-md-3">
                                          <button class="button button--green" style="    background: #0d6efd;color: white;font-size: 15px;" type="submit">
                                             <span>{{__('messages.POST_LABEL')}}</span> 
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
                     <div class="col-xl-6 text-center text-xl-left"><img class="truck-img" src="{{env('LIVE_URL')}}images/truck.jpg" alt="img">
                        {{__('messages.WANT_TO_REGISTER')}}

                     </div>
                  </div>
               </div>
            </section>
            <section class="section my_sec bg--lgray">
               <div class="container">
                  <div class="row bottom-60">
                     <div class="col-12">
                        <div class="heading heading--center">
                           <span class="heading__pre-title"></span>
                           <h3 class="heading__title">{{__('messages.PROUDLY')}}  <span class="color--green">{{__('messages.FEATURED')}} </span>:</h3>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <!-- logos slider start-->
                        <div class="logos-slider logos-slider--style-2">
                           <div class="logos-slider__item"><img src="{{env('LIVE_URL')}}images/11.png" alt="logo"/></div>
                           <div class="logos-slider__item"><img src="{{env('LIVE_URL')}}images/12.png" alt="logo"/></div>
                           <div class="logos-slider__item"><img src="{{env('LIVE_URL')}}images/13.png" alt="logo"/></div>
                           <div class="logos-slider__item"><img src="{{env('LIVE_URL')}}images/14.png" alt="logo"/></div>
                        </div>
                        <div class="logos-slider__dots"></div>
                        <!-- logos slider end-->
                     </div>
                  </div>
               </div>
            </section>
            <section class="section">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-lg-6 col-xl-5">
                      <div class="video-left-part">
                        <div class="play-btn">
                            <a class="popup-vimeo" href="//player.vimeo.com/video/551890295?autoplay=1">
                              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="play" class="svg-inline--fa fa-play fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
                            </a>
                            
                          </div>
                        <img class="w-100" src="{{env('LIVE_URL')}}images/buscargo01.jpg" alt="img">
                      </div>
                      
                     </div>
                     <div class="col-lg-6 col-xl-6 offset-xl-1">
                        <div class="shiply-Works-box">
                           <h4>{{__('messages.OLD_WAYS_ARE_GONE')}}</h4>
                           <ol>
                              <li><p>{{__('messages.OLD_WAYS_ARE_GONE_PARA_1')}}</p></li>
                              <li><p>{{__('messages.OLD_WAYS_ARE_GONE_PARA_2')}}</p></li>
                              <li><p>{{__('messages.OLD_WAYS_ARE_GONE_PARA_3')}}</p></li>
                              <li><p>{{__('messages.OLD_WAYS_ARE_GONE_PARA_4')}}</p></li>
                              <li><p>{{__('messages.OLD_WAYS_ARE_GONE_PARA_5')}}</p></li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- section end-->
            <!-- section end-->
            <!-- section start-->
            <section class="section bg--lwhite">
               <div class="container">
                  <div class="row align-items-end bottom-60">
                     <div class="col-lg-5 col-xl-8">
                        <div class="heading">
                           <h3 class="heading__title">{{__('messages.WAHT_WE_LOVE_TO_DO')}}</h3>
                        </div>
                     </div>
                  </div>
                  <div class="row offset-50">
                     <div class="col-sm-6 col-lg-3 my_border">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="{{env('LIVE_URL')}}images/House Removals.jpg">
                           </div>
                           <h6 class="icon-item__title">{{__('messages.HOUSE_REMOVALS')}}</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3 my_border">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="{{env('LIVE_URL')}}images/Furniture & Large Items Delivery.jpg">
                           </div>
                           <h6 class="icon-item__title">{{__('messages.FURNITURE_N_LARGE_ITEMS')}}</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3 my_border">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="{{env('LIVE_URL')}}images/Car Transport.jpg">
                           </div>
                           <h6 class="icon-item__title">{{__('messages.CAR_TRANSPORT')}}</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3 my_border" style="border-right: none;">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="{{env('LIVE_URL')}}images/Piano Transport.jpg">
                           </div>
                           <h6 class="icon-item__title">{{__('messages.PIANO_TRANSPORT')}}</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3 my_border1">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="{{env('LIVE_URL')}}images/OLX Deliveries.jpg">
                           </div>
                           <h6 class="icon-item__title">{{__('messages.OLX_DELIVERIES')}}</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3 my_border1">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="{{env('LIVE_URL')}}images/Low Cost Storage.jpg">
                           </div>
                           <h6 class="icon-item__title">{{__('messages.LOW_COST_STORAGE')}}</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3 my_border1">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="{{env('LIVE_URL')}}images/Man & Van Service.jpg">
                           </div>
                           <h6 class="icon-item__title">{{__('messages.MAN_N_VAN_SERVICE')}}</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3 my_border1" style="border-right: none;">
                        <div class="icon-item">
                           <div class="icon-item__img">
                             <img src="{{env('LIVE_URL')}}images/European Moves.jpg">
                           </div>
                           <h6 class="icon-item__title">{{__('messages.EUROPEAN_MOVES')}}</h6>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            

            <!-- section end-->
            <!-- section start-->
            <section class="section info-block environment-section" style="background: url('{{env('LIVE_URL')}}images/env03.png') no-repeat;">
               <div class="container">
                  <div class="row">
                     <div class="col-12">
                        <div class="heading">
                           <h3 class="heading__title">{{__('messages.BUSCARGO_HELP_ENVIRNOMENT')}}</h3>
                        </div>
                        <p class="section-environment-p">{{__('messages.BUSCARGO_HAS_THE_COMMITMENT')}}</p>
                        <div class="environment-wrapper">
                           <div class="environment-numbers-list">
                                 <span class="environment-numbers" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="300">
                                    1
                                 </span>
                                 <span class="environment-numbers" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="600">
                                    8
                                 </span>
                                 <span class="environment-numbers environment-numbers-small" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="900">
                                    5
                                 </span>
                                 <span class="environment-numbers" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1200">
                                    4
                                 </span>
                                 <span class="environment-numbers" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1500">
                                    7
                                 </span>
                                 <span class="environment-numbers environment-numbers-small" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="1800">
                                    3
                                 </span>
                                 <span class="environment-numbers" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2100">
                                    1
                                 </span>
                                 <span class="environment-numbers" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2400">
                                    6
                                 </span>
                                 <span class="environment-numbers" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2700">
                                    4
                                 </span>
                        </div>
                                               
                     </div>                     
                  </div>
               </div>
            </section>

            
            <section class="section testimonials bg--lgray">
               <div class="testimonials__bg"><img class="section--bg t50 r0" src="{{env('LIVE_URL')}}img/testimonials-bg.png" alt="img"/></div>
               <div class="container">
                  <div class="row">
                     <div class="col-12">
                        <div class="heading heading--white"><span class="heading__pre-title">{{__('messages.TESTIMONIALS_LABEL')}}</span>
                           <h3 class="heading__title">{{__('messages.EXCELLENT_LABEL')}} <span class="color--green">{{__('messages.QUALITY_LABEL')}}</span> {{__('messages.SERVICES_LABEL')}}</h3><span class="heading__layout layout--dgray">{{__('messages.PEOPLE_LABEL')}}</span>
                        </div>
                        <!-- <div class="testimonials__nav"></div>
                        <img class="testimonials__img" src="img/testimonials_img.png" alt="img"/> -->
                     
                        <div class="testimonials-slider-new">
                           <div class="testimonials-slider__item">
                              <div class="testimonials-img">
                                 <img src="{{env('LIVE_URL')}}img/testimonials-icons.png" alt="img"/>
                              </div>
                              <div class="testimonials-slider__author">
                                 <h6>Carminha Araújo</h6>
                              </div>
                              <p><i class="fas fa-quote-left"></i> {{__('messages.TESTIMONIALS_1')}}</p>
                           </div>
                           <div class="testimonials-slider__item">
                              <div class="testimonials-img">
                                 <img src="{{env('LIVE_URL')}}img/testimonials-icons.png" alt="img"/>
                              </div>
                              <div class="testimonials-slider__author">
                                 <h6>Isabel</h6>
                              </div>
                              <p><i class="fas fa-quote-left"></i>  {{__('messages.TESTIMONIALS_2')}}</p>
                           </div>
                           <div class="testimonials-slider__item">
                              <div class="testimonials-img">
                                 <img src="{{env('LIVE_URL')}}img/testimonials-icons.png" alt="img"/>
                              </div>
                              <div class="testimonials-slider__author">
                                 <h6>Sónia Cristina</h6>
                              </div>
                              <p><i class="fas fa-quote-left"></i>  {{__('messages.TESTIMONIALS_3')}}</p>
                           </div>
                         
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- section end-->

         </main>
         @include('includes.footer') 
                 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ4J2G7btoA72YPSJ2MwBDQde0PTGIjYQ&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>