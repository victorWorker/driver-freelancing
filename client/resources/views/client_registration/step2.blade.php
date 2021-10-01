<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
      <meta name="description" content="description"/>
      <meta name="keywords" content="keywords"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
      <script src="https://kit.fontawesome.com/a69cfdfc72.js" crossorigin="anonymous"></script> 
      <link rel="shortcut icon" href="{{env('LIVE_URL')}}img/favicon.ico"/>
      <title>Buscargo</title>
      <!-- styles-->
      <link rel="stylesheet" href="{{env('LIVE_URL')}}css/styles.min.css"/>
      <link rel="stylesheet" href="{{env('LIVE_URL')}}css/magnific-popup.css"/>
      <link rel="stylesheet" href="{{env('LIVE_URL')}}css/style.css"/>
      <link rel="stylesheet" href="{{env('LIVE_URL')}}path/to/font-awesome/css/font-awesome.min.css">
      <!-- web-font loader-->
      <script>
         WebFontConfig = {
           google: {
         
             families: ['Inter:300,400,500,700', 'Open+Sans:700'],
         
          }
         }
         
         function font() {
         
         var wf = document.createElement('script')
         
         wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js'
         wf.type = 'text/javascript'
         wf.async = 'true'
         
         var s = document.getElementsByTagName('script')[0]
         
         s.parentNode.insertBefore(wf, s)
         
         }
         
         font()
      </script>
      <style>
         .error{color: red;}
         .form__select{
            border-radius: 10px !important;
         }
         label#email-error{
            color: red;
         }
         .quote-form__submit{ 
         background: #0d6efd;
         color: white;
         font-size: 20px;
         }
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
         }
         .form__field {
         border: 3px solid #e2e2e2 !important;
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
         position: relative;
         }
         .promo-tabs {
         box-shadow: none !important;
         }
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
         font-size: 20px;
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
         padding: 5px 10px;
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
         .my_ul
         { 
         color: white;
         }
         .my_ul li
         { 
         font-size: 30px;
         }
         @media only screen and (min-width: 320px) and (max-width: 768px)
         { 
         .quote-form__submit {
         background: #0d6efd;
         color: white;
         font-size: 15px;
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

         .w-100 {
    width: 100% !important;
}
.d-flex {
    display: flex !important;
}
.topmenu .infoblock {
    max-width: 430px;
    padding: 15px 20px;
    margin: 12px 0;
    border-radius: 2px;
}
      </style>
   </head>
   <body>
      <div class="page-wrapper">
         <!-- menu dropdown start-->
         <div class="menu-dropdown">
            <div class="menu-dropdown__inner" data-value="start">
               <div class="screen screen--start">
                  <div class="menu-dropdown__close">
                     <svg class="icon">
                        <use xlink:href="#close"></use>
                     </svg>
                  </div>
                  <div class="d-block d-lg-none bottom-20">
                     <div class="screen__item screen--trigger item--active" data-category="screen-one">
                        <span>Home</span>
                        <span>
                           <svg class="icon">
                              <use xlink:href="#chevron-right"></use>
                           </svg>
                        </span>
                     </div>
                     <div class="screen__item screen--trigger" data-category="screen-two">
                        <span>Pages</span>
                        <span>
                           <svg class="icon">
                              <use xlink:href="#chevron-right"></use>
                           </svg>
                        </span>
                     </div>
                     <div class="screen__item screen--trigger" data-category="screen-three">
                        <span>Services</span>
                        <span>
                           <svg class="icon">
                              <use xlink:href="#chevron-right"></use>
                           </svg>
                        </span>
                     </div>
                     <div class="screen__item screen--trigger" data-category="screen-five">
                        <span>Shop</span>
                        <span>
                           <svg class="icon">
                              <use xlink:href="#chevron-right"></use>
                           </svg>
                        </span>
                     </div>
                     <div class="screen__item screen--trigger" data-category="screen-four">
                        <span>Elements</span>
                        <span>
                           <svg class="icon">
                              <use xlink:href="#chevron-right"></use>
                           </svg>
                        </span>
                     </div>
                  </div>
                  <div class="screen__item"><a class="screen__link" href="javascript:void(0);">Documents</a></div>
                  <div class="screen__item"><a class="screen__link" href="javascript:void(0);">Information</a></div>
                  <div class="screen__item"><a class="screen__link" href="javascript:void(0);">Additional docs</a></div>
                  <div class="screen__item"><a class="screen__link" href="javascript:void(0);">Pricing</a></div>
                  <div class="screen__item"><a class="screen__link" href="javascript:void(0);">Downloads</a></div>
                  <div class="screen__item screen--trigger d-flex d-lg-none" data-category="screen-six">
                     <span>Language</span>
                     <span>
                        <svg class="icon">
                           <use xlink:href="#chevron-right"></use>
                        </svg>
                     </span>
                  </div>
                  <div class="menu-dropdown__block top-50"><span class="block__title">Email</span><a class="screen__link" href="mailto:support@helpo.org">support@helpo.org</a></div>
                  <div class="menu-dropdown__block top-20"><span class="block__title">Phone numbers</span><a class="screen__link" href="tel:+180012345678">+ 1800 - 123 456 78</a><a class="screen__link" href="tel:+18009756511">+ 1800 - 975 65 11</a></div>
                  <div class="menu-dropdown__block">
                     <ul class="socials list--reset">
                        <li class="socials__item">
                           <a class="socials__link" href="#">
                              <svg class="icon">
                                 <use xlink:href="#youtube"></use>
                              </svg>
                           </a>
                        </li>
                        <li class="socials__item">
                           <a class="socials__link" href="#">
                              <svg class="icon">
                                 <use xlink:href="#facebook"></use>
                              </svg>
                           </a>
                        </li>
                        <li class="socials__item">
                           <a class="socials__link" href="#">
                              <svg class="icon">
                                 <use xlink:href="#twitter"></use>
                              </svg>
                           </a>
                        </li>
                        <li class="socials__item">
                           <a class="socials__link" href="#">
                              <svg class="icon">
                                 <use xlink:href="#linkedin"></use>
                              </svg>
                           </a>
                        </li>
                        <li class="socials__item">
                           <a class="socials__link" href="#">
                              <svg class="icon">
                                 <use xlink:href="#inst"></use>
                              </svg>
                           </a>
                        </li>
                     </ul>
                  </div>
                  <div class="menu-dropdown__block top-50"><a class="button button--filled" href="#">Get a Quote</a>
                  </div>
               </div>
            </div>
            <div class="menu-dropdown__inner" data-value="screen-one">
               <div class="screen screen--sub">
                  <div class="screen__heading">
                     <h6 class="screen__back">
                        <svg class="icon">
                           <use xlink:href="#chevron-left"></use>
                        </svg>
                        <span>Home</span>
                     </h6>
                  </div>
                  <div class="screen__item"><a class="screen__link" href="index.html">Home 1</a></div>
                  <div class="screen__item"><a class="screen__link" href="front_2.html">Home 2</a></div>
                  <div class="screen__item"><a class="screen__link" href="front_3.html">Home 3</a></div>
                  <div class="screen__item"><a class="screen__link" href="front_4.html">Home 4</a></div>
                  <div class="screen__item item--active"><a class="screen__link" href="front_5.html">Home 5</a></div>
                  <div class="screen__item"><a class="screen__link" href="front_6.html">Home 6</a></div>
               </div>
            </div>
            <div class="menu-dropdown__inner" data-value="screen-two">
               <div class="screen screen--sub">
                  <div class="screen__heading">
                     <h6 class="screen__back">
                        <svg class="icon">
                           <use xlink:href="#chevron-left"></use>
                        </svg>
                        <span>Pages</span>
                     </h6>
                  </div>
                  <div class="screen__item"><a class="screen__link" href="about.html">About</a></div>
                  <div class="screen__item"><a class="screen__link" href="team.html">Team</a></div>
                  <div class="screen__item"><a class="screen__link" href="services.html">Services</a></div>
                  <div class="screen__item"><a class="screen__link" href="service-details.html">Service Details</a></div>
                  <div class="screen__item"><a class="screen__link" href="careers.html">Сareers</a></div>
                  <div class="screen__item"><a class="screen__link" href="warehouse.html">Warehouse</a></div>
                  <div class="screen__item"><a class="screen__link" href="request.html">Request Quote</a></div>
                  <div class="screen__item"><a class="screen__link" href="calculator.html">Calculator</a></div>
                  <div class="screen__item"><a class="screen__link" href="documents.html">Documents</a></div>
                  <div class="screen__item"><a class="screen__link" href="trucks.html">Trucks</a></div>
                  <div class="screen__item"><a class="screen__link" href="locations.html">Locations</a></div>
                  <div class="screen__item"><a class="screen__link" href="contacts.html">Contacts</a></div>
                  <div class="screen__item"><a class="screen__link" href="gallery.html">Gallery Masonry</a></div>
                  <div class="screen__item"><a class="screen__link" href="gallery_2.html">Gallery Grid</a></div>
                  <div class="screen__item"><a class="screen__link" href="blog.html">Blog</a></div>
                  <div class="screen__item"><a class="screen__link" href="blog-post.html">Blog Post</a></div>
                  <div class="screen__item"><a class="screen__link" href="faq.html">F.A.Q</a></div>
                  <div class="screen__item"><a class="screen__link" href="404.html">404</a></div>
                  <div class="screen__item"><a class="screen__link" href="typography.html">Typography</a></div>
               </div>
            </div>
            <div class="menu-dropdown__inner" data-value="screen-three">
               <div class="screen screen--sub">
                  <div class="screen__heading">
                     <h6 class="screen__back">
                        <svg class="icon">
                           <use xlink:href="#chevron-left"></use>
                        </svg>
                        <span>Services</span>
                     </h6>
                  </div>
                  <div class="screen__item"><a class="screen__link" href="service-details.html">Truck Freight</a></div>
                  <div class="screen__item"><a class="screen__link" href="service-details.html">Ship Freight</a></div>
                  <div class="screen__item"><a class="screen__link" href="service-details.html">Plane Freight</a></div>
                  <div class="screen__item"><a class="screen__link" href="service-details.html">Train Freight</a></div>
               </div>
            </div>
            <div class="menu-dropdown__inner" data-value="screen-four">
               <div class="screen screen--sub">
                  <div class="screen__heading">
                     <h6 class="screen__back">
                        <svg class="icon">
                           <use xlink:href="#chevron-left"></use>
                        </svg>
                        <span>Elements</span>
                     </h6>
                  </div>
                  <div class="screen__item"><a class="screen__link" href="accordion.html">Accordion</a></div>
                  <div class="screen__item"><a class="screen__link" href="alerts.html">Alerts</a></div>
                  <div class="screen__item"><a class="screen__link" href="counters.html">Counters</a></div>
                  <div class="screen__item"><a class="screen__link" href="tabs.html">Tabs</a></div>
                  <div class="screen__item"><a class="screen__link" href="pricing.html">Pricing</a></div>
                  <div class="screen__item"><a class="screen__link" href="tables.html">Tables</a></div>
                  <div class="screen__item"><a class="screen__link" href="forms.html">Forms</a></div>
                  <div class="screen__item"><a class="screen__link" href="info-blocks.html">Info Blocks</a></div>
                  <div class="screen__item"><a class="screen__link" href="icons.html">Icons</a></div>
               </div>
            </div>
            <div class="menu-dropdown__inner" data-value="screen-five">
               <div class="screen screen--sub">
                  <div class="screen__heading">
                     <h6 class="screen__back">
                        <svg class="icon">
                           <use xlink:href="#chevron-left"></use>
                        </svg>
                        <span>Shop</span>
                     </h6>
                  </div>
                  <div class="screen__item"><a class="screen__link" href="shop.html">Shop</a></div>
                  <div class="screen__item"><a class="screen__link" href="shop-single.html">Shop Single</a></div>
                  <div class="screen__item"><a class="screen__link" href="shop-cart.html">Shop Cart</a></div>
                  <div class="screen__item"><a class="screen__link" href="shop-checkout.html">Shop Checkout</a></div>
                  <div class="screen__item"><a class="screen__link" href="shop-account.html">Shop Account</a></div>
               </div>
            </div>
            <div class="menu-dropdown__inner" data-value="screen-six">
               <div class="screen screen--sub">
                  <div class="screen__heading">
                     <h6 class="screen__back">
                        <svg class="icon">
                           <use xlink:href="#chevron-left"></use>
                        </svg>
                        <span>Language</span>
                     </h6>
                  </div>
                  <div class="screen__item"><a class="screen__link" href="javascript:void(0);">English</a></div>
                  <div class="screen__item"><a class="screen__link" href="javascript:void(0);">Deutsch</a></div>
                  <div class="screen__item"><a class="screen__link" href="javascript:void(0);">Ukrainian</a></div>
               </div>
            </div>
         </div>
         <!-- menu dropdown end-->
         <!-- header start-->
         <header class="page-header_3 mb-4 d-sm-block">
            <div id="top" class="container">
               <div class="row">
                  <div class="col-sm-4 logoholder"><img src="{{env('LIVE_URL')}}images/bclogo.png"></div>
                  <div class="col-sm-8 mainmenuholder d-flex align-items-center">
                     <div class="topmenu d-flex justify-content-center w-100">
                        <div class="infoblock d-flex align-items-center justify-content-evenly w-100 align-items-center md-5">
                           <div class="info1 w-50 d-flex align-items-center">
                              <i class="fas fa-phone-volume" aria-hidden="true"></i> 
                              <div>
                                 <h3 class="biginfo mb-0"><a href="tel:210 203 206">210 203 206</a></h3>
                                 <p class="smallinfo mb-0">Seg a Sexta 24/7</p>
                              </div>
                           </div>
                           <div class="info2 w-50 d-flex align-items-center">
                              <i class="fas fa-at" aria-hidden="true"></i> 
                              <div>
                                 <h3 class="biginfo mb-0"><a href="mailto:info@buscargo.pt">info@buscargo.pt</a></h3>
                                 <p class="smallinfo mb-0"><a href="mailto:contact@buscargo.pt">contact@buscargo.pt</a></p>
                              </div>
                           </div>
                        </div>
                        <a class="button button--green quote-form__submit" href="{{env('MAIN_URL')}}"><span>{{__('messages.GO_HOME_LABEL_CLIENT')}}</span>
                          <svg class="icon">
                           <use xlink:href="#arrow"></use>
                        </svg></a>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <!-- header end-->
         <main class="main">
            <!-- promo start-->
            <section class="section" style="background: #ff9224;">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-12 top-50 top-lg-0">
                        <div class="form-wrapper">
                          <form class="form quote-form" name="step2_form" id="step2_form" method="post" enctype="multipart/form-data" action="{{url('shipment_submit')}}" autocomplete="off">
                           @csrf
                           <input type="hidden" name="collection" value="{{$from}}">
                           <input type="hidden" name="delivery" value="{{$to}}">
                           <input type="hidden" name="category" value="{{$transport}}">

                              <div class="col-sm-12">
                                 <h4>{{__('messages.ITEM_DESCRIPTION')}}</h4>
                              </div>
                              <div class="row">
                                 <div class="col-sm-12">
                                    <input class="form__field" type="text" name="title" placeholder="{{__('messages.WHAT_YOU_NEED_TO_MOVE')}} ({{__('messages.WHAT_YOU_NEED_TO_MOVE_PLACEHOLDER')}})">
                                 </div>
                                 <div class="col-12">
                                    <textarea class="form__field form__message" name="description" placeholder="{{__('messages.DESCRIBE_YOUR_SHIPMENT')}} ({{__('messages.DESCRIBE_YOUR_SHIPMENT_PLACEHOLDER')}})"></textarea>
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="date" name="delivery_date" placeholder="{{__('messages.PREFERRED_DELIVERY_DEADLINE')}}">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="email" name="email" placeholder="{{__('messages.EMAIL')}}">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="password" name="password" placeholder="{{__('messages.PASSWORD')}}">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="budget" placeholder="{{__('messages.BUDGET')}}">
                                 </div>
                                 <div class="col-sm-12">
                                    <select class="form__select" name="delivery_size" style="display: none;">
                                       <option data-display="{{__('messages.SHIPMENT_SIZE')}}">{{__('messages.IS_LIFT_AVIALBLE')}}</option>
                                       <option value="S" data-display="{{__('messages.SMALL')}}">{{__('messages.SMALL')}}</option>
                                       <option value="M" data-display="{{__('messages.MEDIUM')}}">{{__('messages.MEDIUM')}}</option>
                                       <option value="L" data-display="{{__('messages.LARGE')}}">{{__('messages.LARGE')}}</option>
                                       <option value="XL" data-display="{{__('messages.EXTRA_BI')}}">{{__('messages.EXTRA_BI')}}</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-12 top-50">
                                    <h4>{{__('messages.UPLOAD_IMAGE_OF_ITEM')}}</h4>
                                 </div>
                                 <div class="col-sm-6">
                                    <input type="file" name="image">
                                 </div>
                                 <div class="col-sm-12 top-50">
                                    <h4>{{__('messages.SPECIFICATIONS_OF_THE_LOCATIONS')}}</h4>
                                 </div>
                                 <div class="col-sm-6">
                                    <select class="form__select" name="pickup_floor" style="display: none;">
                                       <option data-display="{{__('messages.PICKUP_POINT_LABEL')}} "></option>
                                       @for($i=1; $i<=30;$i++)
                                          <option value="{{$i}}">{{$i}}</option>\
                                       @endfor
                                    </select>
                                 </div>
                                 <div class="col-sm-6">
                                    <select class="form__select" name="delivery_floor" style="display: none;">
                                       <option data-display="{{__('messages.DELIVERY_POINT_LABEL')}}"></option>
                                       @for($i=1; $i<=30;$i++)
                                          <option value="{{$i}}">{{$i}}</option>\
                                       @endfor
                                    </select>
                                 </div>
                                 <div class="col-sm-6">
                                    <select class="form__select" name="pickup_lift" style="display: none;">
                                       <option data-display="ELEVATOR">{{__('messages.IS_ELEVATOR_PRESENT')}}?</option>
                                       <option value="2">{{__('messages.AVAILABEL_LABEL')}}</option>
                                       <option value="3">{{__('messages.OUT_OF_STOCK')}}</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-6">
                                    <select class="form__select" name="delivery_lift" style="display: none;">
                                       <option data-display="ELEVATOR">{{__('messages.IS_ELEVATOR_PRESENT')}}?</option>
                                       <option value="2">{{__('messages.AVAILABEL_LABEL')}}</option>
                                       <option value="3">{{__('messages.OUT_OF_STOCK')}}</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-12 top-50">
                                    <h4>{{__('messages.DELIVERY_INFORMATION_LABEL')}}</h4>
                                 </div>
                                 <div class="col-sm-12">
                                    <input class="form__field" type="text" name="name" placeholder="{{__('messages.NAME')}}">
                                 </div>
                                 <div class="col-12">
                                    <textarea class="form__field form__message" name="address" placeholder="{{__('messages.ADDRESS')}}"></textarea>
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="country" placeholder="{{__('messages.STATE')}}">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="parents" placeholder="{{__('messages.COUNTRY')}}">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="phone" placeholder="{{__('messages.PHONE')}}">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="zip" placeholder="{{__('messages.ZIP')}}">
                                 </div>
                                 <div class="col-12">
                                    <button class="quote-form__submit" type="submit">{{__('messages.SUBMIT_LISTINGS')}}</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </main>
         <!-- footer start-->
         <footer data-v-75fbb3d3="" class="secondarybg">
            <div data-v-75fbb3d3="" class="container-fluid blackbg footer position-relative">
               <div data-v-75fbb3d3="" class="container text-white">
                  <div data-v-75fbb3d3="" class="row mt-5 pb-5">
                     <img data-v-75fbb3d3="" src="{{env('LIVE_URL')}}images/bclogo.png" class="yellowlogo"> 
                     <div data-v-75fbb3d3="" class="social col-sm-4 mt-5">
                        <div data-v-75fbb3d3="" class="head">
                           <h2 data-v-75fbb3d3="">FOLLOW ON</h2>
                           <h1 data-v-75fbb3d3="">SOCIAL<span data-v-75fbb3d3="" class="primarylightfont"> MEDIA</span></h1>
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
                           <h2 data-v-75fbb3d3="">BROWSE</h2>
                           <h1 data-v-75fbb3d3="">QUICK<span data-v-75fbb3d3="" class="primarylightfont"> LINKS</span></h1>
                           <hr data-v-75fbb3d3="">
                        </div>
                        <ul data-v-75fbb3d3="" class="m-0 p-0">
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/" aria-current="page" class="uppercase router-link-exact-active router-link-active">Inicio</a></li>
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/search" class="uppercase">Pesquisar Entregas</a></li>
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/how-it-works" class="uppercase">Como Funciona</a></li>
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/help" class="uppercase">Ajuda</a></li>
                           <li data-v-75fbb3d3=""><a data-v-75fbb3d3="" href="/aboutus" class="uppercase">Sobre Nós</a></li>
                        </ul>
                     </div>
                     <div data-v-75fbb3d3="" class="about col-sm-4 offset-sm-1 my-3 my-sm-0">
                        <div data-v-75fbb3d3="" class="head">
                           <h2 data-v-75fbb3d3="">READ</h2>
                           <h1 data-v-75fbb3d3="">ABOUT<span data-v-75fbb3d3="" class="primarylightfont"> US</span></h1>
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
      <script src="{{env('LIVE_URL')}}js/jquery.magnific-popup.min.js"></script>
      <script src="{{env('LIVE_URL')}}js/libs.min.js"></script>
      <!-- scripts-->
      <script src="{{env('LIVE_URL')}}js/common.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
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
                     }, 1000);
                }
              });
         });

         $(document).ready(function(){
            $("form[name='step2_form']").validate({
               lang: 'pt',  // or whatever language option you have.
                // Specify validation rules
                rules: {
                  email: { 
                     'required' : true,
                     'remote' : {
                       url:"{{env('LIVE_URL')}}public/index.php/checkEmailExists",
                       type: "post",
                       data: {
                            email:$('#email').val(),
                           _token:"{{ csrf_token() }}"
                        },
                       dataFilter: function (data) {
                           var json = JSON.parse(data);
                           if (json.msg == "true") {
                               return "\"" + "Email address already in use" + "\"";
                           } else {
                               return 'true';
                           }
                       }
                    }
                  },
                  title : {'required':true},
                  description : {'required':true},
                  delivery_date : {'required':true},
                  password : {'required':true},
                  delivery_size : {'required':true},
                  budget : {'required':true, 'number' : true},
                  pickup_floor : {'required':true},
                  pickup_lift : {'required':true},
                  delivery_floor : {'required':true},
                  delivery_lift : {'required':true}
                },
                // Specify validation error messages
                messages: {
                  email: {
                      required: '{{__("messages.EMAIL_MSG_REQUIRED")}}',
                      email: '{{__("messages.EMAIL_MSG_EMAIL")}}',
                      remote: '{{__("messages.EMAIL_MSG_REMOTE")}}'
                  },
                  title : {required : '{{__("messages.TITLE_MSG_REQUIRED")}}'},
                  description : {required : '{{__("messages.DESCRIPTION_MSG_REQUIRED")}}'},
                  delivery_date : {required : '{{__("messages.DELIVERY_DATE_MSG_REQUIRED")}}'},
                  password : {required : '{{__("messages.PASSWORD_MSG_REQUIRED")}}'},
                  delivery_size : {required : '{{__("messages.DELIVERY_SIZE_MSG_REQUIRED")}}'},
                  budget : {required : '{{__("messages.BUDGET_MSG_REQUIRED")}}', number : '{{__("messages.BUDGET_MSG_NUMBER")}}'},
                  pickup_floor : {required : '{{__("messages.PICKUP_FLOOR_MSG_REQUIRED")}}'},
                  pickup_lift : {required : '{{__("messages.PICKUP_LIFT_MSG_REQUIRED")}}'},
                  delivery_floor : {required : '{{__("messages.DELIVERY_FLOOR_MSG_REQUIRED")}}'},
                  delivery_lift : {required : '{{__("messages.DELIVERY_LIFT_MSG_REQUIRED")}}'},

                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                  form.submit();
                }
              });

            $.tools.validator.localize("pt", {
             '*'          : 'Este campo é obrigatório',
             ':email'     : 'Virheellinen s&auml;hk&ouml;postiosoite',
             ':number'    : 'Arvon on oltava numeerinen',
             '[required]' : 'Este campo é obrigatório',
             '[remote]'   : 'Endereço de email já está em uso!'
         });

         });

      </script>
   </body>
</html>