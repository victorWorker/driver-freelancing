@include('includes.header') 
      <main class="main">
         <!-- promo start-->
            
            <section class="section my_sectionimg" >
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6 top-50">                       
                        <div class="video-left-part">
                           <img src="{{env('LIVE_URL')}}img/pexels-tima-miroshnichen.png" alt="img">
                           <div class="video-left-text">
                              <div>
                                 <h3>{{__('messages.INCREASE_PROFITS')}}</h3>
                                 <h4>{{__('messages.BECOME_CARRIER')}}! </h4>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--<div class="col-sm-6 top-50">
                        <ul class="my_ul">
                           <li>  {{__('messages.GET_TO_WORK_NOW')}}</li>
                           <li>  {{__('messages.FREE_AND_WITHOUT_FEES')}}</li>
                           <li>  {{__('messages.REG_IN_LESS_THAN_1_MIN')}}</li>
                           <li> {{__('messages.THE_AMOUNT_YOU_BID')}}</li>

                        </ul>
                        <div class="col-sm-12">
                           <a class="quote-form__submit" href="#section2" style="color: white;font-size: 17px;padding: 10px 25px;">{{__('messages.MORE_ABOUT_BUSCARGO')}} <svg class="icon">
                              <use xlink:href="#arrow">
                                 <svg viewBox="0 0 150 78.6" id="arrow" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 31.5h150v12.7H0V31.5zM112.8-.1l30.9 31.5-8.8 9L104 8.9l8.8-9zm18.1 51l-18.4 18.8 8.9 9 18.4-18.8-8.9-9z"></path>
                                 </svg>
                              </use>
                           </svg></a>
                        </div>
                     </div> -->
                     <div class="col-lg-6 top-50 top-lg-0">
                              <div class="form-wrapper">

                                 <form class="form quote-form" action="{{url('drive_register')}}" method="post">
                                    @csrf
                                    <h6 class="quote-form__title">{{__('messages.REGISTER_WITH_US')}}</h6>

                                    @if (count($errors) > 0)
                                     <div class="alert alert-danger">
                                       <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                       <ul>
                                          @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                          @endforeach
                                       </ul>
                                     </div>
                                   @endif
                                 @if (isset($message) && $message!='')
                                   <div class="alert alert-success">
                                     <p style="color: green;">Thanks for registering with us <a href="https://buscargo.pt/" target="_self">click here</a> to login</p>
                                   </div>
                                   <script type="text/javascript">
                                     $(document).ready(function(){
                                      setTimeout(function(){
                                        $(".alert").hide('slow');
                                        
                                        var url = "https://buscargo.pt/";
                                        $(location).attr('href',url);
                                      },60000);
                                   });
                                   </script>
                                   @endif

                                    <div class="row">
                                       <div class="col-sm-6">
                                          <input class="form__field" type="text" name="name" placeholder="{{__('messages.NAME')}}">
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="email" name="email" placeholder="{{__('messages.EMAIL')}}">
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="password" name="password" placeholder="{{__('messages.PASSWORD')}}">
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="tel" name="phone" placeholder="{{__('messages.PHONE')}}">
                                       </div>
                                       <div class="col-12">
                                          <textarea class="form__field form__message" name="address" placeholder="{{__('messages.ADDRESS')}}"></textarea>
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="text" name="country" placeholder="{{__('messages.COUNTRY')}}">
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="text" name="state" placeholder="{{__('messages.TOWN_CITY')}}">
                                       </div>
                                       <div class="col-sm-12">
                                          <input class="form__field" type="text" name="zip" placeholder="{{__('messages.POSTAL_CODE')}}">
                                       </div>
                                       

                                       <div class="col-12">
                                          <button class="quote-form__submit" type="submit">{{__('messages.REGISTER')}}</button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                  </div>
               </div>
               </section>
           

            <section class="section" id="section2">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6 col-xl-5">
                      <div class="video-left-part">
                        <div class="play-btn">
                            <a class="popup-vimeo" href="//player.vimeo.com/video/551890295
?autoplay=1">
                              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="play" class="svg-inline--fa fa-play fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
                            </a>
                          </div>
                        <img class="w-100 bottom-50" src="{{env('LIVE_URL')}}img/section_2.jpg" alt="img">
                      </div>
                        <div class="img-badge">
                          <img class="img-badge__img" src="{{env('LIVE_URL')}}img/badge-img.png" alt="img">
                           <h3 class="img-badge__title bottom-0" style="font-size: 30px;"> {{__('messages.DELIVERS_AT_DISTANCE')}} </h3>
                        </div>
                     </div>
                     <div class="col-lg-6 col-xl-6 offset-xl-1">
                        <div class="heading bottom-20"><span class="heading__pre-title">About us</span>
                           <h3 class="heading__title">{{__('messages.BUSCARGO_CHARGES')}}  <span class="color--green"> {{__('messages.ITS_DRIVERS')}} </span> {{__('messages.NOTHING')}} </h3>
                        </div>
                        <p>{{__('messages.ABOUT_US_PARA_1')}}</p>
                        <p>{{__('messages.ABOUT_US_PARA_2')}}</p>
                        <p>{{__('messages.ABOUT_US_PARA_3')}}</p>
                        <!-- <ul class="list list--check list--reset">
                           <li class="list__item">Red salmon skilfish, threadtail mullet southern flounder, orangespine unicorn fish flounder bobtail snipe eel</li>
                           <li class="list__item">Trumpeter ropefish bonito roughy cobbler dogteeth tetra Russian sturgeon pollock sea snail</li>
                        </ul> --><a style="{{(isset($locale) && $locale=='pt') ? 'font-size: 10px;' : ''}}" class="top-40 button button--green quote-form__submit" href="#section3"><span>{{__('messages.GET_TO_KNOW_OUR_FEATURES')}}</span>
                           <svg class="icon">
                              <use xlink:href="#arrow">
                                 <svg viewBox="0 0 150 78.6" id="arrow" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 31.5h150v12.7H0V31.5zM112.8-.1l30.9 31.5-8.8 9L104 8.9l8.8-9zm18.1 51l-18.4 18.8 8.9 9 18.4-18.8-8.9-9z"></path>
                                 </svg>
                              </use>
                           </svg></a>
                        </div>
                     </div>
                  </div>
               </section>



               <section class="section bg--lgray" id="section3">
                  <div class="container">
                     <div class="row align-items-end">
                        <div class="col-xl-6 text-center text-xl-left"><img class="truck-img" src="{{env('LIVE_URL')}}images/img-1.png" alt="img">
                           <h4>"{{__('messages.BUSCARGO_MAKES_THE_LINKS_CUST_DRIVER')}}" </h4>
                        </div>
                        <div class="col-xl-6 top-50 top-xl-0">
                           <div class="heading bottom-20">
                              <h3 class="heading__title">{{__('messages.LINK_SECTION_1')}}  
                              </h3>
                           </div>
                           <p class="bottom-0">{{__('messages.LINK_SECTION_4')}}</p>
                           <a class="top-40 button button--green quote-form__submit" href="#section4"><span>{{__('messages.GET_TO_KNOW_OUR_FEATURES')}}</span>
                           <svg class="icon">
                              <use xlink:href="#arrow">
                                 <svg viewBox="0 0 150 78.6" id="arrow" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 31.5h150v12.7H0V31.5zM112.8-.1l30.9 31.5-8.8 9L104 8.9l8.8-9zm18.1 51l-18.4 18.8 8.9 9 18.4-18.8-8.9-9z"></path>
                                 </svg>
                              </use>
                           </svg></a>

                        </div>
                     </div>
                  </div>
               </section>


               <section class="section" id="section4">
                  <div class="container">
                     <div class="row align-items-end bottom-70">
                        <div class="col-lg-5 col-xl-6">
                           <div class="heading"><span class="heading__pre-title"></span>
                              <h3 class="heading__title"><span class="color--green"> {{__('messages.OUR_FEATURES')}} </span>  </h3><span class="heading__layout layout--lgray"></span>
                           </div>
                        </div>
                     </div>
                     <div class="row offset-50">
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                <img src="{{env('LIVE_URL')}}images/phone.png">
                              </div>
                              <h6 class="icon-item__title">{{__('messages.MESSAGE_SYSTEM')}} </h6>
                             
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <img src="{{env('LIVE_URL')}}images/bill.png">
                              </div>
                              <h6 class="icon-item__title">{{__('messages.DOWNLOAD_PRINT')}}</h6>
                              
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                <img src="{{env('LIVE_URL')}}images/smartphone.png">
                              </div>
                              <h6 class="icon-item__title">{{__('messages.DETAILED_N_PERSONALIZED_PROFILE')}}</h6>
                             
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                <img src="{{env('LIVE_URL')}}images/prices.png">
                              </div>
                              <h6 class="icon-item__title">{{__('messages.BOX_PRICE_COMPARISON')}}</h6>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </section>

             
                  <section class="section bg--lgray route-management" id="section5" style="padding: 0px 0px;"><img class="section--bg t50 r0" src="{{env('LIVE_URL')}}img/testimonials-bg.png" alt="img">
                     <div class="container">
                        <div class="row bottom-70">
                           <div class="col-12">
                              <div class="heading heading--white"><span class="heading__pre-title"></span>
                                 <h3 class="heading__title" style="text-align: center;font-size: 25px;">{{__('messages.HOW_TO_CHOOSE_ROUTE')}} </h3>
                                 <span class="heading__layout layout--dgray"></span>
                              </div>
                           </div>
                        </div>
                        <div class="row offset-50">
                           <div class="col-md-6 col-xl-3">
                              <div class="icon-item icon-item--white">
                                 <div class="icon-item__count"><span>01</span></div>
                                 <h6 class="icon-item__title">{{__('messages.BID_LOW_ACCEPT')}}</h6>
                                 <p class="icon-item__text"></p>
                              </div>
                           </div>
                           <div class="col-md-6 col-xl-3">
                              <div class="icon-item icon-item--white">
                                 <div class="icon-item__count"><span>02</span></div>
                          <h6 class="icon-item__title">{{__('messages.YOUR_DELIVERS_RIGHT')}}</h6>
                                 
                              </div>
                           </div>
                           <div class="col-md-6 col-xl-3">
                              <div class="icon-item icon-item--white">
                                 <div class="icon-item__count"><span>03</span></div>
                                 <h6 class="icon-item__title">{{__('messages.CHOOSE_ROUTE')}}</h6>
                                 
                              </div>
                           </div>
                           <div class="col-md-6 col-xl-3">
                              <div class="icon-item icon-item--white">
                                 <div class="icon-item__count"><span>04</span></div>
                                 <h6 class="icon-item__title">{{__('messages.FINALIZE_DELIVERIES')}}</h6>
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>

                   <section class="section" id="section4">
                  <div class="container">
                     <div class="row align-items-end bottom-70">
                        <div class="col-lg-5 col-xl-6">
                           <div class="heading"><span class="heading__pre-title"></span>
                              <h3 class="heading__title"><span class="color--green"> {{__('messages.CUSTOMER_SUPPORT')}} </span>  </h3><span class="heading__layout layout--lgray"></span>
                           </div>
                        </div>
                     </div>
                    
                     <div class="row offset-50">
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <img src="{{env('LIVE_URL')}}images/HEAD OFFICE LOCATED.jpg">
                              </div>
                              <h6 class="icon-item__title">{{__('messages.HEAD_OFF')}}</h6>
                              
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <img src="{{env('LIVE_URL')}}images/AVAILABLE 24-7.jpg">
                              </div>
                              <h6 class="icon-item__title">{{__('messages.AVAILABLE_24_7')}}</h6>
                              
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <img src="{{env('LIVE_URL')}}images/ONLINE SUPPORT.jpg">
                              </div>
                              <h6 class="icon-item__title">{{__('messages.ONLINE_SUPPORT')}}</h6>
                            
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <img src="{{env('LIVE_URL')}}images/INSURANCE.jpg">
                              </div>
                              <h6 class="icon-item__title">{{__('messages.CARGO_INSURANCE')}}</h6>
                              
                           </div>
                        </div>
                     </div>

                  </div>
               </section>


                  <section class="section home-price-sec" style="background: #ff9224;">
                     <div class="container">
                        <div class="row bottom-50">
                           <div class="col-12">
                              <div class="heading heading--center"><span class="heading__pre-title"></span>
                                 <h3 class="heading__title" style="color: white;">{{__('messages.VIDEOS')}} <span class="color--green"></span></h3><span class="heading__layout layout--lgray"></span>

                              </div>
                              <p></p>
                           </div>
                        </div>
                        <div class="row offset-50">

                           <div class="col-sm-9 col-md-6 col-xl-4">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/-7TcEQBF12w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                              <div class="col-sm-9 col-md-6 col-xl-4">
                               <iframe width="100%" height="315" src="https://www.youtube.com/embed/QXNQv54UCOY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                 </div>
                                 <div class="col-sm-9 col-md-6 col-xl-4">
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/UKLPoSqTSb8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                 </div>
                              </div>
                           </section>



                           <section class="section app-section bg--lgray">
                              <div class="container">
                                 <div class="row">
                                    <div class="col-lg-5 col-xl-4 offset-xl-1 d-none d-lg-block"><img src="{{env('LIVE_URL')}}images/phone-img2.png" alt="img"></div>
                                    <div class="col-lg-6 offset-lg-1 col-xl-5">
                                       <div class="heading bottom-20"><span class="heading__pre-title"></span>
                                         <h3 class="heading__title"><span class="color--green">{{__('messages.UNDER_DEV_APP_1')}} </span><br> {{__('messages.UNDER_DEV_APP_2')}}</h3>
                                       </div>
                                       <p>✓ {{__('messages.DETAILED_DELIVERY_TRACK')}}</p>
                                       <p>✓ {{__('messages.EMERGENCY_DELIVERIES')}}</p>
                                       <p>✓ {{__('messages.PREMINUM_SERVICES')}}</p>
                                       <p>{{__('messages.OTHER_SERVICES')}}</p>
                                       <div class="app-download"><a class="app-download__link" href="#"><img src="{{env('LIVE_URL')}}img/mobile/apple.svg" alt="apple"></a><a class="app-download__link" href="#"><img src="{{env('LIVE_URL')}}img/mobile/google.svg" alt="google"></a></div>
                                    </div>
                                 </div>
                              </div>
                           </section>

                        </main>


                  @include('includes.footer') 
