@include('includes.header') 
         <main class="main">
            <!-- promo start-->
            <section class="section my_sec">
               <div class="container">
                  <div class="row flex-column-reverse flex-xl-row align-items-end">
                     <div class="col-xl-6 top-50 top-xl-0">
                        <div class="promo-tabs tabs horizontal-tabs">
                           <div class="heading bottom-20">
                              <h3 class="heading__title" style="font-size: 30px;">GRAB A  CUP OF COFFEE AND DESCRIBE US WHAT YOU WANT TO MOVE</h3>
                           </div>
                           <p class="bottom-0">Buscargo is the choice of thousands of costumers.</p>
                           <ul class="horizontal-tabs__header">
                              <li><a href="#horizontal-tabs__item-1"><span>For Business</span></a></li>
                              <!-- <li><a href="#horizontal-tabs__item-2"><span>For Private Person</span></a></li>
                                 <li><a href="#horizontal-tabs__item-3"><span>For Public Sector</span></a></li> -->
                              </ul>
                              @if (isset($message) && $message!='')
                                   <div class="alert alert-success">
                                     <p style="color: green;">Thanks for registering with us <a href="https://buscargo.pt/" target="_self">click here</a> to login</p>
                                   </div>
                                   @endif
                              <div class="horizontal-tabs__content">
                                 <div class="horizontal-tabs__item" id="horizontal-tabs__item-1">
                                    <form class="form promo-form promo-form--f5" method="post" action="{{url('step2')}}" autocomplete="off">

                                       @csrf
                                       <div class="row offset-20">
                                          <div class="col-md-12">
                                             <select required class="form__select" name="transport" id="transport">
                                                <option data-display="Choose transport">What are you moving?</option>
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
                                                   <use xlink:href="#pin"></use>
                                                </svg>
                                                <input required class="form__field " type="text" id="collection" name="from" placeholder="From"/>
                                             </label>
                                          </div>
                                          <div class="col-sm-6">
                                             <label>
                                                <svg class="icon">
                                                   <use xlink:href="#pin"></use>
                                                </svg>
                                                <input required class="form__field mapfield" id="delivery" type="text" name="To" placeholder="To"/>
                                             </label>
                                          </div>
                                              <div id="map"></div>

                                       <!-- <div class="col-sm-6 col-md-3">
                                          <label>
                                            <svg class="icon">
                                                <use xlink:href="#calendar_2"></use>
                                            </svg>
                                            <input class="form__field" data-toggle="datepicker" type="text" name="date" placeholder="Date"/>
                                          </label>
                                       </div>  -->
                                       <div class="col-sm-6 col-md-3">
                                          <button class="button button--green" style="    background: #0d6efd;
    color: white;
    font-size: 15px;" type="submit">
                                             <span>Next</span> 
                                             <svg class="icon">
                                                <use xlink:href="#arrow"></use>
                                             </svg>
                                          </button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                    

                     <div class="col-xl-6 text-center text-xl-left"><img class="truck-img" src="https://buscargo.pt/client/images/truck.jpg" alt="img">
                        <a class="quote-form__submit" href="#section2" style="color: white;
    font-size: 17px;padding: 10px 25px;background: #0d6efd;">I want to register, but i don ́t have a request yet
 <svg class="icon">
                              <use xlink:href="#arrow"></use>
                           </svg></a>

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
                           <h3 class="heading__title">Proudly  <span class="color--green">featured </span> on:</h3>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <!-- logos slider start-->
                        <div class="logos-slider logos-slider--style-2">
                           <div class="logos-slider__item"><img src="https://buscargo.pt/client/images/11.png" alt="logo"/></div>
                           <div class="logos-slider__item"><img src="https://buscargo.pt/client/images/12.png" alt="logo"/></div>
                           <div class="logos-slider__item"><img src="https://buscargo.pt/client/images/13.png" alt="logo"/></div>
                           <div class="logos-slider__item"><img src="https://buscargo.pt/client/images/14.png" alt="logo"/></div>
                        </div>
                        <div class="logos-slider__dots"></div>
                        <!-- logos slider end-->
                     </div>
                  </div>
               </div>
            </section>
            <section class="section">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6 col-xl-5">
                      <div class="video-left-part">
                        <div class="play-btn">
                            <a class="popup-vimeo" href="//player.vimeo.com/video/75852227?autoplay=1">
                              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="play" class="svg-inline--fa fa-play fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
                            </a>
                          </div>
                        <img class="w-100 bottom-50" src="https://buscargo.pt/client/img/section_2.jpg" alt="img">
                      </div>
                    
                     </div>
                      <div class="col-lg-6 col-xl-6 offset-xl-1">
                        <div class="shiply-Works-box">
                           <h4>THE OLD WAYS ARE GONE, BUSCARGO HAS ARRIVED!</h4>
                           <ol>
                              <li><p>Move anything, anywhere.</p></li>
                              <li><p>All you need to do is quickly fill out a form and competitive quotes will be sent to your email from our network of over 2000 reliable drivers</p></li>
                              <li><p>Bids are typically up to 75% lower than standard delivery services.The transporters will compete, in an auction, to get your delivery, which drives the prices down dramatically!</p></li>
                              <li><p>We use reliable and verified payment methods, such as Multibanco, MBWAY and PayPal.</p></li>
                              <li><p>All companies and/or carriers are rated according to their deliveries, so youcan choose the right one for you.</p></li>
                           </ol>
                        </div>
                     </div>
                     </div>
                  </div>
               </section>
            <!-- section end-->
            <!-- section end-->
            <!-- section start-->
            <section class="section bg--lgray">
               <div class="container">
                  <div class="row align-items-end bottom-60">
                     <div class="col-lg-5 col-xl-4">
                        <div class="heading">
                           <h3 class="heading__title">What we love doing</h3>
                        </div>
                     </div>
                  </div>
                  <div class="row offset-50">
                     <div class="col-sm-6 col-lg-3">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <svg class="icon">
                                 <use xlink:href="#warehouse">
                                    <svg viewBox="0 0 64 64" id="warehouse" xmlns="http://www.w3.org/2000/svg">
               <path d="M61.326 12.055l-29-10a.985.985 0 00-.652 0l-29 10A1 1 0 002 13v48a1 1 0 001 1h4a1 1 0 001-1V26h48v35a1 1 0 001 1h4a1 1 0 001-1V13a1 1 0 00-.674-.945zM4 13.713l28-9.655 28 9.655V18H4zM6 60H4V20h2zm2-36v-4h48v4zm52 36h-2V20h2z"></path>
               <path d="M32 16a4 4 0 10-4-4 4 4 0 004 4zm0-6a2 2 0 11-2 2 2 2 0 012-2zm21 50h-4V45a1 1 0 00-1-1h-7V29a1 1 0 00-1-1H24a1 1 0 00-1 1v15h-7a1 1 0 00-1 1v15h-4a1 1 0 000 2h42a1 1 0 000-2zM39 46h2v5.382l-.553-.277a1 1 0 00-.894 0l-.553.277zm-6-16v5.382l-.553-.277a1 1 0 00-.894 0l-.553.277V30zm-8 0h4v7a1 1 0 001.447.9L32 37.118l1.553.777A1 1 0 0035 37v-7h4v14H25zm-1 16h1v5.382l-.553-.277a1 1 0 00-.894 0l-.553.277V46zm-7 0h4v7a1 1 0 001.447.9L24 53.118l1.553.777A1 1 0 0027 53v-7h4v14H17zm16 0h4v7a1 1 0 001.447.9L40 53.118l1.553.777A1 1 0 0043 53v-7h4v14H33z"></path>
            </svg>
                                 </use>
                              </svg>
                           </div>
                           <h6 class="icon-item__title">House Removals</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="https://buscargo.pt/client/images/022.png">
                           </div>
                           <h6 class="icon-item__title">Furniture & Large Items Delivery</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="https://buscargo.pt/client/images/033.png">
                           </div>
                           <h6 class="icon-item__title">Car Transport</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="https://buscargo.pt/client/images/044.png">
                           </div>
                           <h6 class="icon-item__title">Piano Transport</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="https://buscargo.pt/client/images/055.png">
                           </div>
                           <h6 class="icon-item__title">OLX Deliveries</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="https://buscargo.pt/client/images/066.png">
                           </div>
                           <h6 class="icon-item__title">Low Cost Storage</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3">
                        <div class="icon-item">
                           <div class="icon-item__img">
                              <img src="https://buscargo.pt/client/images/077.png">
                           </div>
                           <h6 class="icon-item__title">Man & Van Service</h6>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-3">
                        <div class="icon-item">
                           <div class="icon-item__img">
                             <img src="https://buscargo.pt/client/images/088.png">
                           </div>
                           <h6 class="icon-item__title">European Moves</h6>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <section class="section bg--lwhite">
               <div class="container">
                  <div class="row align-items-end">
                     <div class="col-xl-6 text-center text-xl-left"><img class="truck-img" src="https://buscargo.pt/client/images/truck.jpg" alt="img"/></div>
                     <div class="col-xl-6 top-50 top-xl-0">
                        <div class="heading bottom-20">
                           <h3 class="heading__title">Low Cost Storage</h3>
                        </div>
                        <p class="bottom-0">We collect, store and deliver making storing your items hassle free and low cost. With over 40 facilities, we cover the whole of the UK.</p>
                        <div class="row top-40">
                           <div class="col-sm-6 col-lg-5 col-xl-6">
                              <ul class="list list--check list--reset">
                                 <li class="list__item">Unbeatable Prices</li>
                                 <li class="list__item">Compensation Cover</li>
                                 <li class="list__item">No Minimum Terms</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- section end-->
            <!-- section start-->
            <section class="section info-block environment-section">
               <div class="container">
                  <div class="row">
                     <div class="col-12">
                        <div class="heading">
                           <h3 class="heading__title">How Shiply Helps The Environment</h3>
                        </div>
                        <p class="section-environment-p">By utilising spare capacity of vehicles running on the road, Shiply helps reduce the number of otherwise wasteful journeys needed to transport the item.</p>
                        <div class="environment-wrapper">
                           <div class="environment-numbers-list">
                                 <span class="environment-numbers">
                                    1
                                 </span>
                                 <span class="environment-numbers">
                                    8
                                 </span>
                                 <span class="environment-numbers environment-numbers-small">
                                    5
                                 </span>
                                 <span class="environment-numbers">
                                    4
                                 </span>
                                 <span class="environment-numbers">
                                    7
                                 </span>
                                 <span class="environment-numbers environment-numbers-small">
                                    3
                                 </span>
                                 <span class="environment-numbers">
                                    1
                                 </span>
                                 <span class="environment-numbers">
                                    6
                                 </span>
                                 <span class="environment-numbers">
                                    4
                                 </span>
                              <span class="environment-unit">Kg/CO<sub>2</sub> Saved</span>
                        </div>
                           <div class="environment-unit-saved"><span class="environment-unit">Kg/CO<sub>2</sub> Saved</span></div>
                     </div>
                     <!-- <div class="col-lg-4 offset-lg-1 top-50 top-lg-0">
                        <div class="row offset-50">
                           <div class="col-md-6 col-lg-12">
                              <div class="counter counter--white">
                                 <div class="counter__top"><span class="js-counter counter__count">3000</span><span class="counter__subject">m <sup>2</sup></span></div>
                                 <div class="counter__lower"><span class="counter__details color--lgray">Total warehouse area</span></div>
                              </div>
                           </div>
                           <div class="col-md-6 col-lg-12">
                              <div class="counter counter--white">
                                 <div class="counter__top"><span class="js-counter counter__count">1200</span><span class="counter__subject"></span></div>
                                 <div class="counter__lower"><span class="counter__details color--lgray">Created Jobs</span></div>
                              </div>
                           </div>
                        </div>
                     </div> -->
                  </div>
               </div>
            </section>

            
            <section class="section testimonials bg--lgray">
               <div class="testimonials__bg"><img class="section--bg t50 r0" src="https://buscargo.pt/client/img/testimonials-bg.png" alt="img"/></div>
               <div class="container">
                  <div class="row">
                     <div class="col-12">
                        <div class="heading heading--white"><span class="heading__pre-title">Testimonials</span>
                           <h3 class="heading__title">Excellent company <span class="color--green">quality</span> services</h3><span class="heading__layout layout--dgray">People</span>
                        </div>
                        <!-- <div class="testimonials__nav"></div>
                        <img class="testimonials__img" src="img/testimonials_img.png" alt="img"/> -->
                     
                        <div class="testimonials-slider-new">
                           <div class="testimonials-slider__item">
                              <div class="testimonials-img">
                                 <img src="https://buscargo.pt/client/img/testimonials-1.jpg" alt="img"/>
                              </div>
                              <div class="testimonials-slider__author">
                                 <h6>Well Singer</h6>
                                 <span>Manager of Westwood</span>
                              </div>
                              <p><i class="fas fa-quote-left"></i> Estou muito satisfeita com o trabalho da buscargo, eu recomendo.</p>
                           </div>
                           <div class="testimonials-slider__item">
                              <div class="testimonials-img">
                                 <img src="https://buscargo.pt/client/img/testimonials-2.jpg" alt="img"/>
                              </div>
                              <div class="testimonials-slider__author">
                                 <h6>Well Singer</h6>
                                 <span>Manager of Westwood</span>
                              </div>
                              <p><i class="fas fa-quote-left"></i> Estou muito satisfeita com o trabalho da buscargo, eu recomendo.</p>
                           </div>
                           <div class="testimonials-slider__item">
                              <div class="testimonials-img">
                                 <img src="https://buscargo.pt/client/img/testimonials-3.jpg" alt="img"/>
                              </div>
                              <div class="testimonials-slider__author">
                                 <h6>Well Singer</h6>
                                 <span>Manager of Westwood</span>
                              </div>
                              <p><i class="fas fa-quote-left"></i> Estou muito satisfeita com o trabalho da buscargo, eu recomendo.</p>
                           </div>
                           <div class="testimonials-slider__item">
                              <div class="testimonials-img">
                                 <img src="https://buscargo.pt/client/img/testimonials-3.jpg" alt="img"/>
                              </div>
                              <div class="testimonials-slider__author">
                                 <h6>Well Singer</h6>
                                 <span>Manager of Westwood</span>
                              </div>
                              <p><i class="fas fa-quote-left"></i> Estou muito satisfeita com o trabalho da buscargo, eu recomendo.</p>
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