<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" v-if="shipment.data != undefined">
          <h4 class="font-weight-bolder mt-1">
            <span class="font-weight-light">{{ language.shipment }}</span>
            {{ language.details }}
          </h4>
          <span class="clearfix"></span>
          <!-- Awarded Bid Add Section -->
          <div class="row mb-3" v-if="shipment.awarded != null">
            <div class="col-md-6">
              <div class="card awarded-container">
                <div class="card-body">
                  <h3 class="font-weight-bold">
                    {{ language.awarded }}
                    <span class="font-weight-light">{{ language.bid }}</span>
                  </h3>
                  <div class="d-flex mt-3 align-items-top">
                    <img
                      :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`"
                      width="60px"
                      class="rounded-circle"
                    />
                    <div class="flex-fill mx-3">
                      <p class="mb-2">
                        {{ shipment.awarded.transporter.name }}
                      </p>
                      <span class="badge badge-success">AWARDED</span>
                    </div>
                    <div class="d-flex flex-column align-items-end">
                      <h4 class="mb-0 font-weight-bold ml-3">
                        €{{ shipment.awarded.amount }}
                      </h4>
                      <a
                        href="#"
                        class="mt-2 bg-success text-white circle-btn"
                        title="Message"
                        v-if="shipment.awarded.status == 'AWARDED'"
                        ><i class="fa fa-envelope"></i
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div
              class="
                col-md-6
                d-flex
                py-3
                flex-column
                align-items-center
                justify-content-center
              "
            >
              <span
                class="
                  proj-status
                  btn btn-lg btn-outline-success
                  font-weight-bolder
                "
                >{{ shipment.data.status }}</span
              >
              <p class="review mt-4" v-if="shipment.data.status == 'COMPLETED'">
                <i
                  class="fa fa-star text-warning"
                  v-for="item in shipment.review.rating"
                  :key="item"
                ></i>
                <span class="ml-2 font-weight-bold"
                  >({{ shipment.review.rating }}/5)</span
                >
                <i class="d-block">{{ shipment.review.review }}</i>
              </p>
            </div>
          </div>
          <!-- Awarded Bid Add Section -->

          <!-- Expired Bid Add Section -->
          <div class="row mb-3" v-if="shipment.data.status == 'EXPIRED'">
            <div class="col-md-6 text-center">
              <span
                class="
                  proj-status
                  btn btn-lg btn-outline-danger
                  font-weight-bolder
                "
                >{{ shipment.data.status }}</span
              >
            </div>
          </div>
          <!-- Expired Bid Add Section -->

          <div class="row">
            <div class="col-md-6 d-flex flex-column mt-4 px-4">
              <img
                :src="`${baseURL}images/nia.jpg`"
                v-if="shipment.data.image === null"
                class="w-100 rounded align-self-center mb-4"
              />
              <img
                :src="`${baseURL}shipments/${shipment.data.image}`"
                v-if="shipment.data.image !== null"
                class="w-100 rounded align-self-center mb-4"
              />

              <div class="fullinfo">
                <p class="mb-2 text-black-50">{{ language.shipment_title }}</p>
                <p>{{ shipment.data.title }}</p>
              </div>
              <div class="fullinfo">
                <p class="mb-2 text-black-50">{{ language.description }}</p>
                <p>{{ shipment.data.description }}</p>
              </div>
              <div class="d-flex">
                <div class="halfinfo w-50">
                  <p class="mb-2 text-black-50">{{ language.collection }}</p>
                  <p>{{ shipment.data.collection }}</p>
                </div>
                <div class="halfinfo w-50">
                  <p class="mb-2 text-black-50">{{ language.delivery }}</p>
                  <p>{{ shipment.data.delivery }}</p>
                </div>
              </div>
              <div class="d-flex">
                <div class="halfinfo w-50">
                  <p class="mb-2 text-black-50">{{ language.distance }}</p>
                  <p>{{ shipment.data.distance }} Km</p>
                </div>
                <div class="halfinfo w-50">
                  <p class="mb-2 text-black-50">{{ language.delivery_date }}</p>
                  <p>{{ shipment.data.delivery_date }}</p>
                </div>
              </div>
              <div class="d-flex">
                <div class="halfinfo w-50">
                  <p class="mb-2 text-black-50">{{ language.budget }}</p>
                  <p>{{ shipment.data.budget }} €</p>
                </div>
                <div class="halfinfo w-50">
                  <p class="mb-2 text-black-50">Status</p>
                  <span href="#" class="badge badge-success">{{
                    shipment.data.status
                  }}</span>
                </div>
              </div>
            </div>
            <div class="col-md-6 px-4">
              <div class="headingcard">
                <h2 class="font-weight-bolder">
                  {{ language.recent }}
                  <span class="font-weight-lighter">{{ language.bids }}</span>
                </h2>
                <hr />
              </div>
              <div
                class="bids-resposnive d-flex mt-3 align-items-top"
                v-for="(bid, index) in shipment.bids"
                :key="index"
              >
                <img
                  :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`"
                  width="60px"
                  class="rounded-circle"
                />
                <div class="flex-fill mx-3">
                  <p class="mb-2 font-weight-bold">
                    {{ bid.transporter.name }}
                  </p>
                  <p class="mb-2">{{ bid.proposal }}</p>
                  <span class="badge badge-success">{{ bid.status }}</span>
                  <span>{{ language.bid_amount }} : </span>
                  <h4 class="mb-0 font-weight-bold d-inline-block ml-3">
                    €{{ bid.amount + (bid.amount * 20) / 100 }}
                  </h4>
                  <!-- <span>{{language.deposit_amount}} : </span>
                                    <h4 class="mb-0 font-weight-bold d-inline-block ml-3">€{{ bid.amount * 20 / 100 }} 
                                    </h4>-->
                </div>
                <div
                  class="actions-ship d-flex align-items-center"
                  v-if="bid.status !== 'SUSPENDED' && bid.status !== 'EXPIRED'"
                >
                  <router-link
                    :to="`/user/dashboard/messages?subject_id=${bid.subject_id}`"
                    class="bg-primary text-white circle-btn"
                    title="Envie agora uma mensagem ao transportador!"
                    v-if="
                      bid.subject_id !== null &&
                      (shipment.data.status == 'ACTIVE' ||
                        shipment.data.status == 'AWARDED')
                    "
                    ><i class="fa fa-envelope"></i
                  ></router-link>
                  <b-button
                    @click="$router.push('/user/dashboard/messages')"
                    v-if="bid.subject_id === null && shipmentView"
                    variant="primary"
                    v-b-tooltip.hover.top="'Chat to deliver'"
                    pill
                  >
                    <i class="fa fa-comments-o" id="chat_id"></i>
                  </b-button>
                  <b-button
                    v-b-tooltip.hover.top="'Envie agora uma mensagem ao transportador!'"
                    @click="
                      viewMessage({
                        shipment: shipment.data,
                        id: bid.id,
                        transporter: { id: bid.driver_id },
                      })
                    "
                    v-if="bid.subject_id === null && shipmentView"
                    class="mr-2"
                    variant="warning"
                    pill
                  >
                    <i class="fa fa-envelope" id="envelope_id"></i>
                  </b-button>
                  <b-button
                    v-if="shipment.data.status == 'ACTIVE'"
                    @click="$router.push(`/user/dashboard/bid/award/${bid.id}`)"
                    v-b-tooltip.hover.top="'ACEITAR MOTORIST'"
                    variant="success"
                    pill
                  >
                    <i class="fa fa-check" id="check_id"></i>
                  </b-button>
                  <!--
                                    <span  @mouseover.prevent="checkicon_change_mouseover()" @mouseleave.prevent="checkicon_change_mouseleave()"><router-link :to="`/user/dashboard/bid/award/${bid.id}`" class="bg-success text-white circle-btn" title="ACEITAR MOTORIST" v-if="shipment.data.status == 'ACTIVE'" id="check_id_route"><i class="fa fa-check" id="check_id"></i></router-link></span> -->
                </div>
              </div>
              <router-link
                :to="`/user/dashboard/bidlist/view/${shipment.data.id}`"
                class="btn btn-primary btn-md w-100 mt-3"
                >{{ language.view_all_bids }}</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modals -->
    <DiscountModal :language="language" :active="discountModal" @subscribe="subscribeEmail" />
    <MessageModal :data="bid" />
  </div>
</template>

<script>
import { BButton, VBTooltip } from "bootstrap-vue";
import { mapActions, mapGetters } from "vuex";
import DiscountModal from "../../core/DiscountModal";
import MessageModal from "../common/MessageModal";
import moment from "moment";
export default {
  directives: {'b-tooltip': VBTooltip},
  components: { MessageModal, BButton, DiscountModal },
  data() {
    return {
      discountModal: false,
      baseURL,
      language: require(`../language/${$lang}/newshipment.json`),
      page: this.$route.query.page == undefined ? 1 : this.$route.query.page,
      bid: "",
      countBid: "",
      created_at: "",
      end_at: new Date(),
      formData: {
        email: "",
        user_id: "",
        shipment_id: "",
      },
      moment,
    };
  },
  computed: {
    ...mapGetters("shipment", ["shipment"]),
    ...mapGetters("user", ["authUser"]),
    shipmentView() {
      return (
        this.shipment.data.status == "ACTIVE" ||
        this.shipment.data.status == "AWARDED"
      );
    },
  },
  mounted() {
    this.init();
  },
  methods: {
    ...mapActions("shipment", ["getUserShipment", "sendCoupon"]),
    async init() {
      let resp = await this.getUserShipment(this.$route.params.id);
      //console.log(this.shipment);
      this.countBid = this.shipment.bids.length;
      this.created_at = this.shipment.data.created_at;
      this.formData.user_id = this.shipment.data.user_id;
      this.formData.shipment_id = this.shipment.data.id;
      this.formData.email = this.authUser.email;
      var startTime = moment(this.created_at, "YYYY-MM-DD");
      var endTime = moment(this.end_at, "YYYY-MM-DD");
      var duration = moment.duration(endTime.diff(startTime));
      var hours = parseInt(duration.asHours());
      var minutes = parseInt(duration.asMinutes()) - hours * 60;
      if (
        this.countBid > 0 &&
        hours <= 48 &&
        this.shipment.data.status == "ACTIVE"
      ) {
        this.discountModal = true;
      }
    },
    async subscribeEmail() {
      let resp = await this.sendCoupon(this.formData);
      if (resp == "success") {
        Swals.toast(this.language.coupon_send_success_msg, "success");
        this.discountModal = false;
      } else {
        let errors = "";
        for (const error in this.errors) {
          errors =
            '<span class="text-danger">' +
            errors +
            this.errors[error][0] +
            "</span><br>";
        }
        Swals.message("Error", errors, "error");
      }
    },
    viewMessage(bid) {
      this.bid = bid;
      $("#messageModal").modal("show");
    },
  },
};
</script>
    
<style lang="scss">
.circle-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 40px;
  padding: 5px;
}
.circle-btn:hover {
  text-decoration: none;
  opacity: 0.89;
}
.proj-status {
  border-radius: 30px !important;
  font-size: 1.3rem !important;
  border-width: 3px !important;
}
.awarded-container {
  border: 4px solid #19d895;
  border-radius: 10px;
}
.actions-ship {
  > * {
    margin-right: 10px;
  }
}
@media (max-width: 576px) {
  .bids-resposnive  {
    flex-direction: column;
    align-items: center;
    justify-content: center;
    align-content: center;
    text-align: center;
  }
}
</style>