
<template>
  <div class="vue-container">
    <div class="container form-regi-slide hero mobilepadding">
      <div class="hero-height">
        <img :src="`${baseURL}images/van.svg`" class="bg-hero" />

        <div class="row">
          <div class="heroimgholder timeline">
            <div class="headings">
              <h3 class="primarylightfont mb-0 topheading uppercase">
                O SEU PEDIDO NA
              </h3>
              <h3 class="primaryheavyfont uppercase">BUSCARGO EM 3 PASSOS!</h3>
            </div>

            <div
              class="circles d-flex justify-content-between position-relative"
            >
              <div class="circle me-2">
                <div>
                  <h1 class="primaryheavyfont">1.</h1>
                  <p class="mb-0 uppercase">{{ language.step_1 }}</p>
                </div>
              </div>

              <div class="circle me-2">
                <div>
                  <h1 class="primaryheavyfont">2.</h1>
                  <p class="mb-0 uppercase">{{ language.step_2 }}</p>
                </div>
              </div>

              <div class="circle me-2">
                <div>
                  <h1 class="primaryheavyfont">3.</h1>
                  <p class="mb-0 uppercase">{{ language.step_3 }}</p>
                </div>
              </div>

              <hr class="linethrough d-none d-sm-block" />
            </div>
            <div class="play-btn">
              <a data-bs-toggle="modal" data-bs-target="#modalVideo">
                <i class="fas fa-play"></i>
              </a>

              Clique aqui para video demonstrativo
            </div>
            <div
              id="modalVideo"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              class="modal fade"
              aria-modal="true"
              role="dialog"
            >
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row">
                        <button
                          type="button"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                          class="btn-close"
                        ></button>
                      </div>
                      <div class="row flex-column">
                        <video width="100%" height="100%" controls>
                          <source
                            :src="`${baseURL}images/intro-video.mp4`"
                            type="video/mp4"
                          />
                        </video>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="herotextholder mt-5 mt-sm-0">
            <h2 class="primaryheavyfont main-head uppercase">
              {{ language.hero_form_heading_one }}
            </h2>
            <h2 class="primaryheavyfont secondarycolor main-head uppercase">
              {{ language.hero_form_heading_two }}
            </h2>
            <hr class="extrabg" />

            <p class="mt-2">{{ language.hero_form_desc }}</p>
            <!-- New Form -->
            <PostOrder :language="language" />
          </div>
        </div>
      </div>
      <div class="row justify-content-between features">
        <div class="feature me-2">
          <i class="fas fa-couch"></i>
          <div class="uppercase">
            <h5 class="primaryboldfont mb-0 fhead">{{ language.cat_1_a }}</h5>
            <p class="mb-0">{{ language.cat_1_b }}</p>
          </div>
        </div>
        <div class="feature ms-2">
          <i class="fas fa-car"></i>
          <div class="uppercase">
            <h5 class="primaryboldfont mb-0 fhead">{{ language.cat_2_a }}</h5>
            <p class="mb-0">{{ language.cat_2_b }}</p>
          </div>
        </div>
        <div class="feature me-2">
          <i class="fas fa-motorcycle"></i>
          <div class="uppercase">
            <h5 class="primaryboldfont mb-0 fhead">{{ language.cat_3_a }}</h5>
            <p class="mb-0">{{ language.cat_3_b }}</p>
          </div>
        </div>
        <div class="feature ms-2">
          <i class="fas fa-home"></i>
          <div class="uppercase">
            <h5 class="primaryboldfont mb-0 fhead">{{ language.cat_4_a }}</h5>
            <p class="mb-0">{{ language.cat_4_b }}</p>
          </div>
        </div>
        <div class="feature">
          <i class="fas fa-box"></i>
          <div class="uppercase">
            <h5 class="primaryboldfont mb-0 fhead">{{ language.cat_5_a }}</h5>
            <p class="mb-0">{{ language.cat_5_b }}</p>
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
            <h1 class="primaryheavyfont">100+</h1>
            <p class="mb-0 primarylightfont">{{ language.stat_1 }}</p>
          </div>
          <div class="statbox">
            <h1 class="primaryheavyfont">1000+</h1>
            <p class="mb-0 primarylightfont">{{ language.stat_2 }}</p>
          </div>
          <div class="statbox">
            <h1 class="primaryheavyfont">1 TON+</h1>
            <p class="mb-0 primarylightfont">{{ language.stat_3 }}</p>
          </div>
          <div class="statbox">
            <h1 class="primaryheavyfont">75%</h1>
            <p class="mb-0 primarylightfont">{{ language.stat_4 }}</p>
          </div>
        </div>
      </div>
    </div>
    <!---Stats Section-->

    <!--TimeLine-->
    <div class="container timeline timeline-new">
      <div class="row">
        <div class="headings mobilepadding">
          <h1 class="primarylightfont mb-0 topheading uppercase">
            {{ language.delivered_with }}
          </h1>
          <h1 class="primaryheavyfont uppercase">{{ language.in_steps }}</h1>
        </div>
        <div class="circles d-flex justify-content-between position-relative">
          <div class="col-md-4 me-2">
            <img
              :src="`${baseURL}images/banner-img1.jpg`"
              class="img-fluid"
              alt=""
            />
          </div>
          <div class="col-md-4 me-2">
            <img
              :src="`${baseURL}images/banner-img2.jpg`"
              class="img-fluid"
              alt=""
            />
          </div>
          <div class="col-md-4">
            <img
              :src="`${baseURL}images/banner-img3.jpg`"
              class="img-fluid"
              alt=""
            />
          </div>
        </div>
      </div>
    </div>
    <!--TimeLine-->

    <!--Information Block-->
    <div class="container-fluid infobox">
      <div class="row">
        <div
          class="information col-sm-5 offset-sm-1 offset-xxl-2 mobilepadding"
        >
          <h1 class="primarylightfont mb-0 topheading uppercase">
            {{ language.several_jobs }}
          </h1>
          <h1 class="primaryheavyfont mb-4">{{ language.are_waiting }}</h1>
          <p class="mb-5">{{ language.several_jobs_desc }}</p>
          <a
            href="#"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            class="blackbtn uppercase"
            >{{ language.several_jobs_btn }}</a
          >
        </div>
        <div class="imageblock col-sm-6 col-xxl-5">
          <img :src="`${baseURL}images/truck_driver-new.png`" class="w-100" />
          <a
            href="https://buscargo.pt/client/public/index.php/driver_registration"
            class="blackbtn formoreinfo quotebtn bg-primary uppercase"
          >
            {{ language.homepage_driver_btn }}</a
          >
        </div>
      </div>
    </div>
    <!--Information Block-->

    <!--Delivery Detail box-->
    <div class="container-fluid extrabg delivery">
      <div class="container text-white">
        <div class="row justify-content-between align-items-center">
          <div class="info col-sm-7">
            <h1 class="primarylightfont lineheight2 mb-0 mt-5 mt-sm-0">
              {{ language.solidary }}
            </h1>
            <h1 class="primaryheavyfont">{{ language.deliveries }}</h1>
            <p>{{ language.solidary_desc }}</p>
          </div>
          <div class="freedelivery">
            <img
              :src="`${baseURL}images/delivery.png`"
              v-if="lang === 'en'"
              class="w-100 mb-5 mb-sm-0"
            />
            <img
              :src="`${baseURL}images/delivery-pt.png`"
              v-if="lang === 'pt'"
              class="w-100 mb-5 mb-sm-0"
            />
          </div>
        </div>
      </div>
    </div>
    <!--Delivery Detail box-->

    <!--Information Block-->
    <div class="container-fluid infobox secondarybg text-white">
      <div class="row align-items-end">
        <div class="imageblock col-sm-6">
          <img
            :src="`${baseURL}images/client_ordering.png`"
            class="w-100 mt-5"
          />
        </div>
        <div class="information col-sm-5 col-xxl-4 mobilepadding">
          <h1 class="primarylightfont mb-0 topheading uppercase">
            {{ language.best_shipping }}
          </h1>
          <h1 class="primaryheavyfont mb-4 uppercase">{{ language.prices }}</h1>
          <p class="mb-5">{{ language.best_prices_desc }}</p>
          <a href="/search" class="blackbtn uppercase">{{
            language.best_prices_btn
          }}</a>
        </div>
      </div>
    </div>
    <!--Information Block-->

    <!--Our Clients-->
    <!-- <div class="container-fluid splash">
            <div class="container mobilepadding">
                <div class="row">
                    <h1 class="primarylightfont lineheight2 uppercase">{{ language.client }}</h1>
                    <h1 class="primaryheavyfont mb-5 uppercase">{{ language.feedback }}</h1>
                </div>
                <Testimonials class="mb-5" :language="language" />
            </div>
        </div> -->
    <!--Our Clients-->

    <section class="section testimonials newtestimonil bg--lgray">
      <div class="testimonials__bg">
        <img
          class="section--bg t50 r0"
          src="https://buscargo.pt/client/img/testimonials-bg.png"
          alt="img"
        />
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading heading--white">
              <span class="heading__pre-title"
                ><font style="vertical-align: inherit"
                  ><font style="vertical-align: inherit">
                    {{ language.homepage_testimonials_heading }}
                  </font></font
                ></span
              >
              <h3 class="heading__title">
                <font style="vertical-align: inherit"
                  ><font style="vertical-align: inherit"
                    >{{ language.homepage_testimonials_heading2 }}
                  </font></font
                >
              </h3>
              <span class="heading__layout layout--dgray"
                ><font style="vertical-align: inherit"
                  ><font style="vertical-align: inherit">People</font></font
                ></span
              >
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-4 mb-md-0 mb-5">
            <div class="testimonial">
              <div class="avatar mx-auto">
                <img
                  src="https://buscargo.pt/client/img/testimonials-icons.png"
                  class="rounded-circle testimonials-img z-depth-1 img-fluid"
                />
              </div>
              <h4 class="font-weight-bold dark-grey-text mt-4">
                Carminha Araújo
              </h4>
              <p class="font-weight-normal dark-grey-text">
                <i class="fas fa-quote-left pr-2" aria-hidden="true"></i>
                I am very satisfied with the work of Buscago, I recommend it.
              </p>
            </div>
          </div>
          <div class="col-md-4 mb-md-0 mb-5">
            <div class="testimonial">
              <div class="avatar mx-auto">
                <img
                  src="https://buscargo.pt/client/img/testimonials-icons.png"
                  class="rounded-circle z-depth-1 testimonials-img img-fluid"
                />
              </div>
              <h4 class="font-weight-bold dark-grey-text mt-4">Isabel</h4>
              <p class="font-weight-normal dark-grey-text">
                <i class="fas fa-quote-left pr-2" aria-hidden="true"></i>
                Motorista simpático e prestável. As peças chegaram em bom
                estado. Recomendo.
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="testimonial">
              <div class="avatar mx-auto">
                <img
                  src="https://buscargo.pt/client/img/testimonials-icons.png"
                  class="rounded-circle z-depth-1 testimonials-img img-fluid"
                />
              </div>
              <h4 class="font-weight-bold dark-grey-text mt-4">
                Sonia Cristina
              </h4>
              <p class="font-weight-normal dark-grey-text">
                <i class="fas fa-quote-left pr-2" aria-hidden="true"></i>
                Só tenho a agradecer, correu tudo muito bem, foi uma compra de 8
                cadeiras vindas de Braga, para Sesimbra, 5 estrelas o Sr João
                foi impecável. Custo benefício só tenho a dizer bem. Vou voltar
                a utilizar.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="partlogos-sec">
      <div class="container text-center">
        <img :src="`${baseURL}images/logo1.jpg`" class="" />
        <img :src="`${baseURL}images/logo2.jpg`" class="" />
        <img :src="`${baseURL}images/logo3.jpg`" class="" />
        <img :src="`${baseURL}images/logo4.jpg`" class="" />
        <img :src="`${baseURL}images/logo5.png`" class="" />
      </div>
    </section>

    <!-- msg modal dialog -->
    <div
      class="modal fade"
      id="msgModel"
      aria-hidden="true"
      aria-labelledby="..."
      tabindex="-1"
    >
      <div
        class="
          modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable
        "
      >
        <div class="modal-content">
          <div class="modal-body p-0 m-0">
            <div class="container-fluid p-0">
              <div class="row">
                <div class="headings mb-4 mb-sm-5 px-5 mt-sm-5 mt-4">
                  <p class="mb-0">
                    {{ language.homepage_msgmodel_para1 }}
                  </p>
                  <p>
                    {{ language.homepage_msgmodel_para2 }}
                  </p>
                  <p class="mb-0">
                    {{ language.homepage_msgmodel_user }} :
                    <span id="usr_name"></span>
                  </p>
                  <p>
                    {{ language.homepage_msgmodel_pass }} :
                    <span id="usr_pass"></span>
                  </p>

                  <div class="btn-continue">
                    <button
                      class="blackbtn formoreinfo quotebtn bg-primary uppercase"
                      @click="chkLogin()"
                    >
                      Continuar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--- Modal End -->

    <div v-if="hasclicked">
      <Shipment :cstdata="custData" />
    </div>
  </div>
</template>

<script>
import Shipment from "../common/Shipment";
import Testimonials from "../common/Testimonials.vue";
import { mapGetters, mapActions, mapState } from "vuex";
import moment from "moment";
import PostOrder from "../../post-order/Index.vue";
export default {
  components: {
    Shipment,
    Testimonials,
    PostOrder,
  },
  data() {
    return {
      baseURL,
      lang: $lang,
      language: require(`../language/${$lang}/home.json`),
      form: {
        email: "",
        phone: "",
        category: 1,
        geometry: {
          collection: {},
          delivery: {},
        },
      },
      custData: {},
      hasclicked: true,
      descError: "description manadatory 150 words to 74 characters",
      isdescError: false,
      isValid: false,
      isvalidErrorMsg: "pick up point and drop of point is manadatory",
      isValidTitle: false,
    };
  },
  methods: {
    ...mapActions("front", ["uploadImg", "authLogin"]),
    validateTitle() {
      //alert(this.form.title);
      $("#first_form_next").prop("disabled", false);
      this.isValidTitle = true;
    },
    chkLogin() {
      let loginData = { email: this.form.email, password: this.form.password };
      //let loginData = {'email': 'developerttest@testmail.com', 'password': '34iicg5'};
      axios
        .post("/public/api/login", loginData)
        .then((resp) => {
          console.log(resp);
          console.log("resp");
          localStorage.setItem("token", resp.data.token);
          localStorage.setItem("userId", resp.data.user.id);
          localStorage.setItem("userName", resp.data.user.name);
          localStorage.setItem("userType", resp.data.user.type);
          localStorage.setItem("userEmail", resp.data.user.email);
          localStorage.setItem("role", resp.data.user.type.toLowerCase());

          window.location.href = "https://www.buscargo.pt/user/dashboard";
        })
        .catch((error) => {
          console.log(error);
          if (error) {
            console.log(error);
          }

          // error.response.status Check status code
        });
    },
    submitForm() {
      if (
        this.form.description != "" &&
        this.form.description.length <= 150 &&
        this.form.description.length >= 75
      ) {
        this.custData.clocation = {};
        this.custData.dlocation = {};
        var upass = Math.random().toString(20).substring(8);
        this.form.password = upass;
        $("#sbm_btn").prop("disabled", true);
        $("#sbm_btn").val("processing..");
        this.custData.email = this.form.email;
        this.custData.phone = this.form.phone;
        this.custData.title = this.form.title;
        this.custData.collection = this.form.collection;
        this.custData.delivery = this.form.delivery;
        this.custData.delivery = this.form.delivery;
        this.custData.clocation = this.form.geometry.collection.location;
        this.custData.clatitude = this.form.geometry.collection.latitude;
        this.custData.clongitude = this.form.geometry.collection.longitude;
        this.custData.dlocation = this.form.geometry.delivery.location;
        this.custData.dlatitude = this.form.geometry.delivery.latitude;
        this.custData.dlongitude = this.form.geometry.delivery.longitude;
        this.custData.password = upass;
        //this.hasclicked = true;

        //this.setforvalue(this.form.email, this.form.phone, this.form.title);
        axios
          .post("/client/public/index.php/api/getshipment", this.form)
          .then((res) => {
            var user_id = res.data.data.user_id;
            var shipId = res.data.data.id;
            $("#usr_name").text(this.form.email);
            $("#usr_pass").text(upass);

            this.custData.userid = user_id;
            this.custData.shipid = shipId;
            this.hasclicked = true;
            $("#msgModel").modal("show");
            //console.log(this.custData);

            //Perform Success Action
          })
          .catch((error) => {
            if (error) {
              $("#show_msg").show();
            }

            // error.response.status Check status code
          })
          .finally(() => {
            //Perform action in always
          });
      } else {
        this.isdescError = true;
      }
    },

    uploadCImg(id) {
      let file = document.querySelector(id).files[0];
      if (
        file.type.includes("jpg") ||
        file.type.includes("png") ||
        file.type.includes("jpeg")
      ) {
        $("#sbm_btn").prop("disabled", true);
        $("#show_msg_img").show();
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = (e) => {
          this.url = e.target.result;
          this.barstart = true;
          this.uploadImg(reader.result)
            .then((response) => {
              this.form.image = response;
              $("#sbm_btn").prop("disabled", false);
              $("#show_msg_img").hide();
            })
            .catch((error) => {
              console.log(error);
            });
        };
      } else {
        alert("only jpg & png file is allowed");
      }
    },
  },
};
</script>

<style scoped>
.smltextt {
  font-size: 10px;
  line-height: 11px !important;
  display: inline-block;
}
#show_msg {
  color: #f00;
  padding: 10px;
  display: none;
}

#show_msg_img {
  color: #0d6efd;
  padding: 10px;
  display: none;
}

.img_inpt::before {
  content: none;
}

#msform textarea {
  height: 100px !important;
  line-height: 20px;
}

.slide-in-blurred-top {
  -webkit-animation: slide-in-blurred-top 0.6s cubic-bezier(0.23, 1, 0.32, 1)
    both;
  animation: slide-in-blurred-top 0.6s cubic-bezier(0.23, 1, 0.32, 1) both;
}

@-webkit-keyframes slide-in-blurred-top {
  0% {
    -webkit-transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
    transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
    -webkit-transform-origin: 50% 0%;
    transform-origin: 50% 0%;
    -webkit-filter: blur(40px);
    filter: blur(40px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0) scaleY(1) scaleX(1);
    transform: translateY(0) scaleY(1) scaleX(1);
    -webkit-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    -webkit-filter: blur(0);
    filter: blur(0);
    opacity: 1;
  }
}
@keyframes slide-in-blurred-top {
  0% {
    -webkit-transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
    transform: translateY(-1000px) scaleY(2.5) scaleX(0.2);
    -webkit-transform-origin: 50% 0%;
    transform-origin: 50% 0%;
    -webkit-filter: blur(40px);
    filter: blur(40px);
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0) scaleY(1) scaleX(1);
    transform: translateY(0) scaleY(1) scaleX(1);
    -webkit-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    -webkit-filter: blur(0);
    filter: blur(0);
    opacity: 1;
  }
}

/* 
.justify-content-between{-ms-flex-pack:justify!important;-webkit-box-pack:justify!important;justify-content:space-between!important}
.flex-xl-row{-ms-flex-direction:row!important;-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;flex-direction:row!important}
.align-items-end{-ms-flex-align:end!important;-webkit-box-align:end!important;align-items:flex-end!important}
.top-50{margin-top:50px!important}
.top-xl-0{margin-top:0!important}
.promo-tabs{width:100%;max-width:770px;position:absolute;bottom:0;left:50%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%);bottom:-50px;-webkit-box-shadow:0 3px 10px 2px rgba(0,0,0,.04);box-shadow:0 3px 10px 2px rgba(0,0,0,.04);border:none}
.tabs p:last-of-type{margin-bottom:0}
.horizontal-tabs .r-tabs-panel{padding:23px 30px}
.bottom-20{margin-bottom:20px!important}
.heading{position:relative}
.heading__title{font-size:32px;line-height:40px;margin-bottom:0;z-index:1;position:relative}
horizontal-tabs__content{border:1px solid #d9e2e0;margin-top:-1px} */

.icon-item__img img {
  max-height: 270px;
  width: auto;
}

footer {
  margin-top: 0px;
}

.icon-item {
  margin-bottom: 30px;
}
.my_border {
  border-right: 1px solid #ccc;
  border-bottom: 1px solid #ccc;
  text-align: center;
}

.my_border1 {
  border-right: 1px solid #ccc;
  border-bottom: 0px solid #ccc;
  padding-top: 20px;
  text-align: center;
}

.quote_my {
  color: white;
  font-size: 17px;
  padding: 10px 25px;
  background: #0d6efd;
}

.logos-slider__item::before {
  background: #d1d1d1;
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
.form .nice-select,
.form .nice-select .list {
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
.my_sec {
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
.topmenu .infoblock .biginfo {
  font-family: "GalanoGrotesqueBold";
}
.topmenu .infoblock .smallinfo {
  font-size: 0.7rem;
  font-family: "GalanoGrotesqueLight";
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
  font-family: "GalanoGrotesqueLight";
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
  background: #ffe1c2;
  border-radius: 0px 0px 10px 10px;
  padding: 5px 20px;
  align-items: center;
}
.topmenu .registermodal .fas {
  margin-right: 10px;
  color: #5d5d5d;
}
.topmenu .registermodal .registertext {
  font-size: 1.2rem;
  margin-bottom: 0px;
  color: #5d5d5d;
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
  background: #ff9224;
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
  border: 1px solid #5d5d5d;
  border-radius: 2rem;
  padding: 10px 15px;
}
nav ul .active {
  font-family: "GalanoGrotesqueBold";
  border: 1px solid #5d5d5d;
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
.mycol {
  display: block !important;
}

.text-white {
  color: #fff !important;
}
.blackbg {
  background: #5d5d5d;
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
.footer .links ul li {
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

@media only screen and (min-width: 320px) and (max-width: 768px) {
  .my_border {
    border-right: 0px solid #ccc;
    border-bottom: 1px solid #ccc;
    text-align: center;
  }

  .my_border1 {
    border-right: 0px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding-top: 20px;
    text-align: center;
  }
  .quote_my {
    color: white;
    font-size: 10px;
    padding: 10px 25px;
    background: #0d6efd;
  }

  .my_sec {
    padding: 0px 0 !important;
  }
  .mycol {
    display: none !important;
  }
}
</style>
