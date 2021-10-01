
         <!-- footer start-->
         <footer data-v-75fbb3d3="" class="secondarybg">
            <div data-v-75fbb3d3="" class="container-fluid blackbg footer position-relative">
               <div data-v-75fbb3d3="" class="container text-white">
                  <div data-v-75fbb3d3="" class="row mt-5 pb-5">
                     <img data-v-75fbb3d3="" src="{{env('LIVE_URL')}}images/bclogo.png" class="yellowlogo"> 
                     <div data-v-75fbb3d3="" class="social col-sm-4 mt-5">
                        <div data-v-75fbb3d3="" class="head">
                           <h2 data-v-75fbb3d3="">{{__('messages.FOLLOW_ON_LABEL')}}</h2>
                           <h1 data-v-75fbb3d3="">{{__('messages.SOCIAL_LABEL')}}<span data-v-75fbb3d3="" class="primarylightfont"> {{__('messages.MEDIA_LABEL')}}</span></h1>
                        </div>
                        <div data-v-75fbb3d3="" class="socialicons"><a data-v-75fbb3d3="" href="https://www.facebook.com/buscargotransporte/" target="_blank"><i data-v-75fbb3d3="" class="fab fa-facebook" aria-hidden="true"></i></a> <a data-v-75fbb3d3="" href="https://www.instagram.com/buscargopt/" target="_blank"><i data-v-75fbb3d3="" class="fab fa-instagram" aria-hidden="true"></i></a> <a data-v-75fbb3d3="" href="https://www.youtube.com/channel/UCYmfInr_0404aJHS8qLtCBw" target="_blank"><i data-v-75fbb3d3="" class="fab fa-youtube" aria-hidden="true"></i></a> <a data-v-75fbb3d3="" href="#" target="_blank"><i data-v-75fbb3d3="" class="fab fa-twitter" aria-hidden="true"></i></a></div>
                        <div data-v-75fbb3d3="" class="language d-flex align-items-center">
                           <i data-v-75fbb3d3="" class="fas fa-language" aria-hidden="true"></i> 
                           <select name="language" id="language">
                              <option value="en" {{(isset($locale) && $locale=='en') ? "selected" : ''}}>English</option>
                              <option value="pt"  {{(isset($locale) && $locale=='pt') ? "selected" : ''}}>Portugese</option>
                           </select>
                        </div>
                     </div>
                     <div data-v-75fbb3d3="" class="links col-sm-3 my-3 my-sm-0">
                        <div data-v-75fbb3d3="" class="head">
                           <h2 data-v-75fbb3d3="">{{__('messages.BROWSE_LABEL')}}</h2>
                           <h1 data-v-75fbb3d3="">{{__('messages.QUICK_LABEL')}}<span data-v-75fbb3d3="" class="primarylightfont"> {{__('messages.LINKS_LABEL')}}</span></h1>
                           <hr data-v-75fbb3d3="">
                        </div>
                        <ul data-v-75fbb3d3="" class="m-0 p-0">
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/" aria-current="page" class="uppercase router-link-exact-active router-link-active">{{__('messages.START_LABEL')}}</a></li>
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/search" class="uppercase">{{__('messages.SEARCH_DELIVERIES_LABEL')}}</a></li>
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/how-it-works" class="uppercase">{{__('messages.HOW_DOES_IT_WORKS_LABEL')}}</a></li>
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/help" class="uppercase"></a>{{__('messages.HELP_LABEL')}}</li>
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/aboutus" class="uppercase">{{__('messages.ABOUT_US_LABEL')}}</a></li>
                        </ul>
                     </div>
                     <div data-v-75fbb3d3="" class="about col-sm-4 offset-sm-1 my-3 my-sm-0">
                        <div data-v-75fbb3d3="" class="head">
                           <h2 data-v-75fbb3d3="">{{__('messages.READ_LABEL')}}</h2>
                           <h1 data-v-75fbb3d3="">{{__('messages.ABOUT_LABEL')}}<span data-v-75fbb3d3="" class="primarylightfont"> {{__('messages.US_LABEL')}}</span></h1>
                           <hr data-v-75fbb3d3="">
                        </div>
                        <p data-v-75fbb3d3="" class="primarylightfont"> {{__('messages.FOOTER_TEXT')}} </p>
                     </div>
                  </div>
                  <div data-v-75fbb3d3="" class="copyright w-100">
                     <p data-v-75fbb3d3="" class="mb-0 text-center mobilepadding">Largo Das Chafariz, 55 1B, Sao Domingos Da Rana, Cascais, 2785-112 </p>
                  </div>
                  <div data-v-75fbb3d3="" class="copyright bg-white w-100">
                     <p data-v-75fbb3d3="" class="mb-0 text-center text-secondary mobilepadding">BusCargo LDA. All rights reserved |  Designed, developed and maintained by RedArc Technology Pvt. Ltd. </p>
                  </div>
               </div>
            </div>
         </footer>
         <!-- footer end-->
      </div>
      <!-- libs-->
      <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
      
      <script src="{{env('LIVE_URL')}}js/aos.js"></script>
      <script src="{{env('LIVE_URL')}}js/jquery.magnific-popup.min.js"></script>
      <script src="{{env('LIVE_URL')}}js/libs.min.js"></script>
      <script src="{{env('LIVE_URL')}}js/map.js"></script>
      <!-- scripts-->
      <script src="{{env('LIVE_URL')}}js/common.min.js"></script>
      
      <script type="text/javascript">
         $( "#language" ).change(function() {

            var language = this.value;
             var urlr = "{{url('/language/:id')}}";
               urlr = urlr.replace(":id", language);

            $.ajax({
                type: "GET",
                url: urlr,
                cache:false,
                success: function(response){                  
                    setTimeout(function() {
                         location.reload();
                     }, 500);
                }
              });
         });

         /*$(document).ready(function(){
            setTimeout(function(){
              $(".alert").hide('slow');
              
              var url = "https://buscargo.pt/";
              $(location).attr('href',url);
            },60000);
         });*/
      </script>
   </body>
   </html>
