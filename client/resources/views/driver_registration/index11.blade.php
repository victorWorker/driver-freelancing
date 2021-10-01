@include('includes.header') 
      <main class="main">
         <!-- promo start-->
            
            <section class="section" style="background: #ff9224;">
               <div class="container">
                  <div class="row">
                     <div class="col-sm-6 top-50">
                        <ul class="my_ul">
                           <li>  GET TO WORK NOW! </li>
<li>  FREE AND WITHOUT FEES FORM</li>
<li>  REGISTRATION IN LESS THAN 1 MINUTE</li>
<li> THE AMOUNT YOU BID, IS THE AMOUNT YOU WILL RECEIVE!</li>

                        </ul>
                        <div class="col-sm-12">
        <a class="quote-form__submit" href="#section2" style="color: white;
    font-size: 17px;padding: 10px 25px;">MORE ABOUT BUSCARGO! <svg class="icon">
                              <use xlink:href="#arrow"></use>
                           </svg></a>
                        </div>
                     </div>
                     <div class="col-lg-6 top-50 top-lg-0">
                              <div class="form-wrapper">

                                 <form class="form quote-form" action="{{url('drive_register')}}" method="post">
                                    @csrf
                                    <h6 class="quote-form__title">Register with us</h6>

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
                                   @endif

                                    <div class="row">
                                       <div class="col-sm-6">
                                          <input class="form__field" type="text" name="name" placeholder="Name">
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="email" name="email" placeholder="Email">
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="password" name="password" placeholder="Password">
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="tel" name="phone" placeholder="Mobile Phone">
                                       </div>
                                       <div class="col-12">
                                          <textarea class="form__field form__message" name="address" placeholder="Address"></textarea>
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="text" name="country" placeholder="Country">
                                       </div>
                                       <div class="col-sm-6">
                                          <input class="form__field" type="text" name="state" placeholder="Town / City">
                                       </div>
                                       <div class="col-sm-12">
                                          <input class="form__field" type="text" name="zip" placeholder="Postal code">
                                       </div>
                                       

                                       <div class="col-12">
                                          <button class="quote-form__submit" type="submit">Register</button>
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
                        <img class="w-100 bottom-50" src="https://buscargo.pt/client/img/section_2.jpg" alt="img">
                      </div>
                        <div class="img-badge">
                          <img class="img-badge__img" src="https://buscargo.pt/client/img/badge-img.png" alt="img">
                           <h3 class="img-badge__title bottom-0" style="font-size: 30px;"> DELIVERIES AT THE   <br>DISTANCE OF A CLICK!</h3>
                        </div>
                     </div>
                     <div class="col-lg-6 col-xl-6 offset-xl-1">
                        <div class="heading bottom-20"><span class="heading__pre-title">About us</span>
                           <h3 class="heading__title">BUSCARGO CHARGES  <span class="color--green"> ITS DRIVERS </span> NOTHING! </h3>
                        </div>
                        <p>Our platform is the complete solution for transport orders of larger items, or any item for transportation.</p>
                        <p>If you have 1 or 2 vans and/or you are a company, Buscargo is a platform where you will get multiple jobs.</p>
                        <p>On one side of the platform are customers posting their requests, on the other side of the 
platform are drivers and transporters to perform the work. After a job is requested, there is an 
auction by the drivers to get the delivery. We encourage you to bid low, which will make it 
possible to have multiple deliveries along your route.
All Buscargo deliveries are rated by the clients, that is, all transporters/companies will always 
have feedback and evaluation of their work.
Buscargo has the commitment and the mission to reduce CO2 emissions</p>
                        <!-- <ul class="list list--check list--reset">
                           <li class="list__item">Red salmon skilfish, threadtail mullet southern flounder, orangespine unicorn fish flounder bobtail snipe eel</li>
                           <li class="list__item">Trumpeter ropefish bonito roughy cobbler dogteeth tetra Russian sturgeon pollock sea snail</li>
                        </ul> --><a class="top-40 button button--green quote-form__submit" href="#section3"><span>GET TO KNOW OUR 
FEATURES!</span>
                           <svg class="icon">
                              <use xlink:href="#arrow"></use>
                           </svg></a>
                        </div>
                     </div>
                  </div>
               </section>



               <section class="section bg--lgray" id="section3">
                  <div class="container">
                     <div class="row align-items-end">
                        <div class="col-xl-6 text-center text-xl-left"><img class="truck-img" src="https://buscargo.pt/client/images/car_2.png" alt="img">
                           <h4>"Buscargo makes the link between its customers and its drivers." </h4>
                        </div>
                        <div class="col-xl-6 top-50 top-xl-0">
                           <div class="heading bottom-20">
                              <h3 class="heading__title">PAYMENT IS MADE BY THE CUSTOMER,  
 <span class="color--green">IN HAND OR ANY OTHER METHOD THE </span> TRANSPORTER WISHES, ON THE DAY OF DELIVERY.</h3>
                           </div>
                           <p class="bottom-0">After mutual agreement between customer and transporter, regarding price, place and 
delivery date, payment will be made on the day of the delivery by the customer.</p>
<a class="top-40 button button--green quote-form__submit" href="#section4"><span>GET TO KNOW OUR 
FEATURES!</span>
                           <svg class="icon">
                              <use xlink:href="#arrow"></use>
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
                              <h3 class="heading__title"><span class="color--green"> OUR FEATURES
 </span>  </h3><span class="heading__layout layout--lgray"></span>
                           </div>
                        </div>
                     </div>
                     <div class="row offset-50">
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                <img src="https://buscargo.pt/client/images/01.png">
                              </div>
                              <h6 class="icon-item__title">Message system between client and driver and/or company. </h6>
                             
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <img src="https://buscargo.pt/client/images/02.png">
                              </div>
                              <h6 class="icon-item__title">Download and Print of the Transport Waybill.</h6>
                              
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                <img src="https://buscargo.pt/client/images/03.png">
                              </div>
                              <h6 class="icon-item__title">Detailed and personalized profile of each driver and/or company, with reliable and 
updated feedback</h6>
                             
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                <img src="https://buscargo.pt/client/images/04.png">
                              </div>
                              <h6 class="icon-item__title">Box price comparison</h6>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </section>

             
                  <section class="section bg--lgray route-management" id="section5"><img class="section--bg t50 r0" src="https://buscargo.pt/client/img/testimonials-bg.png" alt="img">
                     <div class="container">
                        <div class="row bottom-70">
                           <div class="col-12">
                              <div class="heading heading--white"><span class="heading__pre-title"></span>
                                 <h3 class="heading__title">HOW TO CHOOSE YOUR ROUTE AND REDUCE CO2 EMISSIONS
 </h3>
                                 <span class="heading__layout layout--dgray"></span>
                              </div>
                           </div>
                        </div>
                        <div class="row offset-50">
                           <div class="col-md-6 col-xl-3">
                              <div class="icon-item icon-item--white">
                                 <div class="icon-item__count"><span>01</span></div>
                                 <h6 class="icon-item__title">Bid low and accept multiple deliveries.</h6>
                                 <p class="icon-item__text"></p>
                              </div>
                           </div>
                           <div class="col-md-6 col-xl-3">
                              <div class="icon-item icon-item--white">
                                 <div class="icon-item__count"><span>02</span></div>
                          <h6 class="icon-item__title">Get all the details of your deliveries right.</h6>
                                 
                              </div>
                           </div>
                           <div class="col-md-6 col-xl-3">
                              <div class="icon-item icon-item--white">
                                 <div class="icon-item__count"><span>03</span></div>
                                 <h6 class="icon-item__title">Choose your route, taking into account the deliveries you will have, thus avoiding 
wasting cargo space and reducing pollution.</h6>
                                 
                              </div>
                           </div>
                           <div class="col-md-6 col-xl-3">
                              <div class="icon-item icon-item--white">
                                 <div class="icon-item__count"><span>04</span></div>
                                 <h6 class="icon-item__title">Finalize your deliveries, get paid and rated by the client.</h6>
                                 
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
                              <h3 class="heading__title"><span class="color--green"> COSTUMER SUPPORT
 </span>  </h3><span class="heading__layout layout--lgray"></span>
                           </div>
                        </div>
                     </div>
                     <div class="row offset-50">
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <svg class="icon">
                                    <use xlink:href="#warehouse"></use>
                                 </svg>
                              </div>
                              <h6 class="icon-item__title">HEAD OFFICE LOCATED IN LISBON</h6>
                              
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <svg class="icon">
                                    <use xlink:href="#support"></use>
                                 </svg>
                              </div>
                              <h6 class="icon-item__title">AVAILABLE 24/7</h6>
                              
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <svg class="icon">
                                    <use xlink:href="#location"></use>
                                 </svg>
                              </div>
                              <h6 class="icon-item__title">ONLINE SUPPORT</h6>
                            
                           </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                           <div class="icon-item">
                              <div class="icon-item__img">
                                 <svg class="icon">
                                    <use xlink:href="#insurance"></use>
                                 </svg>
                              </div>
                              <h6 class="icon-item__title">CARGO INSURANCE</h6>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </section>


                  <section class="section home-price-sec" style="    background: #ff9224;">
                     <div class="container">
                        <div class="row bottom-50">
                           <div class="col-12">
                              <div class="heading heading--center"><span class="heading__pre-title"></span>
                                 <h3 class="heading__title" style="color: white;">Video <span class="color--green"></span></h3><span class="heading__layout layout--lgray"></span>

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
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/U8mJMh6aYNQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                 </div>
                              </div>
                           </section>



                           <section class="section app-section bg--lgray">
                              <div class="container">
                                 <div class="row">
                                    <div class="col-lg-5 col-xl-4 offset-xl-1 d-none d-lg-block"><img src="https://buscargo.pt/client/images/phone-img2.png" alt="img"></div>
                                    <div class="col-lg-6 offset-lg-1 col-xl-5">
                                       <div class="heading bottom-20"><span class="heading__pre-title"></span>
                                          <h3 class="heading__title"><span class="color--green">OUR APP IS </span><br> UNDER DEVELOPMENT!</h3>
                                       </div>
                                       <p>✓ Detailed Map And Delivery Tracking</p>
                                       <p>✓ Emergency Deliveries</p>
                                       <p>✓ Premium Services</p>
                                       <p>And many other secret features, so stay tuned!</p>
                                       <div class="app-download"><a class="app-download__link" href="#"><img src="https://buscargo.pt/client/img/mobile/apple.svg" alt="apple"></a><a class="app-download__link" href="#"><img src="https://buscargo.pt/client/img/mobile/google.svg" alt="google"></a></div>
                                    </div>
                                 </div>
                              </div>
                           </section>

                        </main>


                  @include('includes.footer') 