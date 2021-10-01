<template>
  <div>
    <div v-if="!loading">
      <!--- Listing Info Box -->
      <div class="container-fluid find p-0 extrabgbright">
        <div class="container mobmargin">
          <div class="row flex-column flex-sm-row">
            <div
              class="
                col-12 col-sm-6
                d-flex
                align-items-center
                flex-column flex-sm-row
                text-center text-sm-start
              "
            >
              <img
                :src="baseURL + 'images/demo.jpg'"
                width="150px"
                class="rounded-circle listing-hero me-5"
                v-if="driver.user.profileimage === null"
              />
              <img
                :src="baseURL + 'shipments/' + driver.user.profileimage"
                width="100px"
                class="rounded-circle me-5"
                v-if="driver.user.profileimage != null"
              />

              <div class="d-flex flex-column">
                <h1 class="primaryboldfont fs-3 text-white mb-0">
                  {{ driver.user.name }}
                </h1>
                <p class="text-white">@transporter2</p>
                <div class="infobox d-flex">
                  <i class="fas fa-check-circle me-2 text-success fs-7"></i>
                  <p class="text-white m-0 fs-7">
                    {{ language.profile_completed_text }}:
                    {{ driver.completed_jobs }}
                  </p>
                </div>
                <div class="infobox d-flex">
                  <i class="fas fa-clock me-2 text-warning fs-7"></i>
                  <p class="text-white fs-7">
                    {{ language.profile_registered_text }}:
                    {{ moment(driver.user.created_at).format("DD-MM-YYYY") }}
                  </p>
                </div>
              </div>
            </div>
            <div
              class="
                col-12 col-sm-3
                d-flex
                justify-content-center
                flex-row flex-sm-column
                mb-5 mb-sm-0
              "
            >
              <div class="text-white">
                <p class="m-0 fs-7">
                  {{ language.profile_overallrating_text }}
                </p>
                <div class="d-flex">
                  <h1 class="my-0 me-4 primaryheavyfont">
                    {{ parseFloat(driver.rating).toFixed(2) }} %
                  </h1>
                  <div class="rating d-flex align-items-center">
                    <i
                      v-for="n in 5"
                      :key="n"
                      :class="
                        driver.rating >= n
                          ? 'fas fa-star ms-1 secondarycolor'
                          : 'far fa-star ms-1 secondarycolor'
                      "
                    ></i>
                  </div>
                </div>
              </div>
              <div class="text-white ms-3 ms-sm-0">
                <p class="m-0 fs-7">
                  {{ language.profile_negativerating_text }}
                </p>
                <div class="d-flex">
                  <h1 class="m-0 primaryheavyfont">
                    {{ parseFloat(driver.negativerating).toFixed(2) }} %
                  </h1>
                </div>
              </div>
            </div>
            <div
              class="
                col-12 col-sm-3
                d-flex
                justify-content-center
                flex-row flex-sm-column
                mb-5 mb-sm-0
              "
            >
              <img
                v-if="driver.user.badge != null"
                :src="baseURL + driver.user.badge"
                width="100px"
                class="rounded-pill me-4 pull-right"
              />
            </div>
          </div>
        </div>
      </div>
      <!--- Listing Info Box -->

      <!--- Actual Page -->
      <div class="container-fluid">
        <div class="container pt-5">
          <div class="row">
            <div
              class="
                shadow-lg
                p-4
                rounded
                d-flex
                justify-content-between
                graybox
                mb-5
                flex-wrap
              "
            >
              <div
                class="d-flex align-items-center col-6 col-sm-auto mb-4 mb-sm-0"
              >
                <i class="fas fa-check-double fs-1 me-2 text-success"></i>
                <div>
                  <h1 class="m-0 lh-1 primaryheavyfont">
                    {{ driver.completed_jobs }}
                  </h1>
                  <p class="m-0">{{ language.profile_completed_text }}</p>
                </div>
              </div>
              <div
                class="d-flex align-items-center col-6 col-sm-auto mb-4 mb-sm-0"
              >
                <i class="fas fa-times-circle fs-1 me-2 text-danger"></i>
                <div>
                  <h1 class="m-0 lh-1 primaryheavyfont">
                    {{ driver.incomplete_jobs }}
                  </h1>
                  <p class="m-0">{{ language.profile_incomplete_text }}</p>
                </div>
              </div>
              <div
                class="d-flex align-items-center col-6 col-sm-auto mb-4 mb-sm-0"
              >
                <i class="fas fa-star fs-1 me-2 text-success"></i>
                <div>
                  <h1 class="m-0 lh-1 primaryheavyfont">
                    {{ driver.awarded_count }}
                  </h1>
                  <p class="m-0">{{ language.profile_awarded_text }}</p>
                </div>
              </div>
              <div
                class="d-flex align-items-center col-6 col-sm-auto mb-4 mb-sm-0"
              >
                <i class="far fa-star fs-1 me-2 text-danger"></i>
                <div>
                  <h1 class="m-0 lh-1 primaryheavyfont">
                    {{ driver.expired_count }}
                  </h1>
                  <p class="m-0">{{ language.profile_expired_text }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row flex-column-reverse flex-sm-row">
            <div class="col-md-8">
              <div class="headofbid mt-5">
                <h1 class="fw-bolder primaryheavyfont">
                  Avaliações <span class="primarylightfont">recentes</span>
                </h1>
              </div>
              <div
                class="
                  d-flex
                  flex-column
                  justify-content-center
                  align-items-center
                  mb-4
                "
                v-if="driver.reviews[0] === undefined"
              >
                <img :src="baseURL + 'images/noresults.svg'" class="w-25" />
                <h1 class="primaryboldfont mt-4 mtcolor">
                  Ainda <span class="primarylightfont">sem</span> avaliações
                </h1>
              </div>
              <div
                class="shadow-lg p-4 mb-5 rounded"
                v-for="(review, index) in driver.reviews"
                :key="index"
              >
                <div class="topline d-flex justify-content-between">
                  <div class="awardbox mb-4 mb-sm-0 d-flex">
                    <img
                      :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`"
                      width="150px"
                      class="rounded-circle"
                      v-if="review.user.profileimage === null"
                    />
                    <img
                      :src="baseURL + 'shipments/' + review.user.profileimage"
                      width="100px"
                      class="rounded-circle me-5"
                      v-if="review.user.profileimage != null"
                    />
                    <div>
                      <h1 class="m-0 fs-3">{{ review.user.name }}</h1>
                      <h3 class="m-0 fs-5 fw-lighter text-black-50">
                        @transporter1
                      </h3>
                      <div class="rating">
                        <i
                          v-for="n in 5"
                          :key="n"
                          :class="
                            review.rating >= n ? 'fas fa-star' : 'far fa-star'
                          "
                        ></i>
                      </div>
                    </div>
                  </div>
                  <div class="awardandamount d-flex flex-column">
                    <div class="fw-bolder align-self-end mt-3">1000</div>
                  </div>
                </div>
                <p class="mt-3">{{ review.review }}</p>
              </div>
            </div>
            <div class="col-md-4 ps-5 leftside mt-5 mobilepadding">
              <div class="secondarybg rootbox mb-5">
                <h1
                  class="primaryheavyfont secondarybg fs-4 py-3 px-4 text-white"
                >
                  Bio <span class="primarylightfont">Detalhes</span>
                </h1>
                <div class="whitebox bg-white p-4 shadow">
                  <div class="graybox bg-black-50 rounded-3 p-4">
                    <div class="d-flex justify-content-center">
                      <i class="fas fa-map-marker-alt me-3"></i>
                      <p>{{ driver.user.country }}, {{ driver.user.state }}</p>
                    </div>

                    <div class="infoboxx mb-4">
                      <p class="m-0 fw-bold">
                        {{ language.profile_about_text }}
                      </p>
                      <hr class="w-25" />
                      <p v-if="driver.user.about !== null">
                        {{ driver.user.about }}
                      </p>
                      <p v-else>The Trasnporter has not Updated Any Bio</p>
                    </div>
                  </div>
                </div>
                <div
                  class="placebid d-flex justify-content-center py-4 px-3"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--- Actual Page -->
    </div>
    <b-spinner v-else variant="primary" label="Loading driver.."></b-spinner>
  </div>
</template>
<script>
import { BSpinner } from "bootstrap-vue";
import { mapActions, mapGetters } from "vuex";
import moment from "moment";
export default {
  data() {
    return {
      loading: true,
      baseURL,
      moment,
      lang: $lang,
      language: require(`../language/${$lang}/transport.json`),
      driver_rating: "",
    };
  },
  computed: {
    ...mapGetters("front", ["driver"]),
  },
  methods: {
    ...mapActions("front", ["getTransporter"]),
  },
  async mounted() {
    this.loading = true;
    //this.driver_rating=parseFloat(this.driver.rating).toFixed(2);
    await this.getTransporter(this.$route.params.id);
    this.loading = false;
  },
  components: { BSpinner },
};
</script>

<style lang="css">
.fs-7 {
  font-size: 14px;
}
.mt-8 {
  margin-top: 8rem !important;
}
.graybox {
  background-color: #e1e1e1;
}
.leftside .whitebox {
  border-radius: 0rem 0rem 2rem 2rem;
}
.leftside .rootbox {
  border-radius: 0rem 0rem 2rem 2rem;
}
@media (max-width: 570px) {
  .mobmargin {
    margin-top: 5rem;
  }
}
</style>