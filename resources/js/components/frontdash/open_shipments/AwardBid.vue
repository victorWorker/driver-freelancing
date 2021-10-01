<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card mt-3 px-4 py-4">
        <div class="row payment-section">
          <div class="col-md-6">
            <div class="col-md-12">
              <h5 class="font-weight-light">{{ language.actual_location }}</h5>
              <br />
              <h5 class="font-weight-light">
                {{ language.coupon_heading_one }}
                <span
                  v-on:click="showCoponbox"
                  style="color: blue; cursor: pointer"
                >
                  {{ language.coupon_heading_two }}
                </span>
              </h5>
              <div class="input-group" v-if="isCouponShow">
                <input
                  type="text"
                  class="form-control"
                  :placeholder="language.coupon_code"
                  v-model="formData1.couponcode"
                />
                <span class="input-group-btn">
                  <button
                    class="btn btn-primary"
                    v-if="isCouponApplied"
                    @click="applyCoupon()"
                    type="button"
                  >
                    {{ language.apply_coupon_button }}
                  </button>
                </span>
              </div>
              <div class="form-group mt-5">
                <label for="">{{ language.phone_number }}</label>
                <input
                  type="tel"
                  name=""
                  id=""
                  v-model="formData.phone"
                  class="form-control"
                  :placeholder="language.phone_number_placeholder"
                />
              </div>
              <div class="form-group">
                <label for="">{{ language.complete_address }}</label>
                <textarea
                  name=""
                  id=""
                  class="form-control"
                  v-model="formData.address"
                  rows="5"
                  :placeholder="language.complete_address_placeholder"
                ></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card rounded" style="width: 100%">
                <div
                  class="card-body"
                  style="
                    padding-top: 10px !important;
                    padding-bottom: 10px !important;
                  "
                >
                  <!--  <b>Referência:</b> <span id="reference_no"></span><br> -->
                  <b>{{ language.heading_payment }}</b
                  ><br />
                  <span
                    ><img :src="`${baseURL}images/tick (2).png`" />
                    {{ language.heading_first_line }}</span
                  >
                  <br />
                  <span
                    ><img :src="`${baseURL}images/tick (2).png`" />{{
                      language.heading_second_line
                    }}
                  </span>
                  <br />
                  <span
                    ><img :src="`${baseURL}images/tick (2).png`" />
                    {{ language.heading_third_line }}
                  </span>
                </div>
              </div>
              <div class="card rounded" style="width: 100%">
                <div
                  class="card-body"
                  style="
                    padding-top: 10px !important;
                    padding-bottom: 10px !important;
                  "
                >
                  <div class="col-md-12">
                    <a
                      href="https://pt.trustpilot.com/review/buscargo.pt"
                      class="text-decoration-none"
                      target="_blank"
                    >
                      <img
                        :src="`${baseURL}images/trustpilot-logo.jpg`"
                        class="imagesize1"
                        style="width: 150px"
                      />
                      &nbsp;&nbsp;
                    </a>
                    <a
                      href="https://www.linkedin.com/company/buscargopt"
                      class="text-decoration-none"
                      target="_blank"
                    >
                      <img
                        :src="`${baseURL}images/linkedin.png`"
                        class="imagesize"
                        style="width: 45px"
                      />
                      &nbsp;&nbsp;
                    </a>
                    <a
                      href="https://www.google.com/url?sa=t&source=web&rct=j&url=https://m.facebook.com/buscargotransporte/&ved=2ahUKEwiLhIvLqYjyAhXERUEAHbzUDJ4QFjAAegQIAxAC&usg=AOvVaw3IjSUHy_Bg0glG-Mqsvxz2"
                      class="text-decoration-none"
                      target="_blank"
                    >
                      <img
                        :src="`${baseURL}images/facebook1.png`"
                        class="imagesize"
                        style="width: 45px"
                      />
                      &nbsp;&nbsp;
                    </a>
                    <a
                      href="https://instagram.com/buscargopt?utm_medium=copy_link"
                      class="text-decoration-none"
                      target="_blank"
                    >
                      <img
                        :src="`${baseURL}images/instagram1.png`"
                        class="imagesize"
                        style="width: 45px"
                      />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="col-md-12">
              <!--  <h4 class="font-weight-light text-right">Amount  <span class="font-weight-bold text-success dep_amount"></span> </h4> -->
              <div class="card rounded" style="width: 100%">
                <div
                  class="card-body card-font"
                  style="
                    padding-top: 10px !important;
                    padding-bottom: 10px !important;
                  "
                >
                  <div v-if="!loading" class="col-md-9" style="float: left">
                    <div class="row">
                      <div class="col-md-10" style="float: left; width: 75%">
                        <b>Valor total:</b>
                      </div>
                      <div class="col-md-2" style="float: left; width: 25%">
                        <span
                          class="payment_total"
                          v-text="`€${payments.total}`"
                        ></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10" style="float: left; width: 75%">
                        <b>
                          Valor do depósito &nbsp;<span class="text-primary">
                            ( Deposite que voce paga hoje ):
                          </span>
                        </b>
                      </div>
                      <div class="col-md-2" style="float: left; width: 25%">
                        <span
                          class="dep_amount"
                          v-text="`€${payments.depositAmount}`"
                        ></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-10" style="float: left; width: 75%">
                        <b>
                          Valor a liquidar ao motorista &nbsp;
                          <span class="text-primary">
                            ( Pague o motorista no dia da entrega )
                          </span>
                          :
                        </b>
                      </div>
                      <div class="col-md-2" style="float: left; width: 25%">
                        <span
                          class="driver_amount"
                          v-text="`€${payments.driverAmount}`"
                        ></span>
                      </div>
                    </div>
                  </div>
                  <b-spinner
                    v-else
                    variant="success"
                    label="Loading.."
                  ></b-spinner>
                  <div class="col-md-3" style="float: right">
                    <img
                      :src="`${baseURL}images/secure-payment.jpeg`"
                      style="width: 150px"
                    />
                  </div>
                </div>
              </div>
              <Payment
                id="payable"
                type="SHIPMENT"
                link="/user/dashboard/awardedshipments"
                :bid="this.$route.params.id"
                :shipmentData="formData"
              />
              <div class="card rounded" style="width: 100%">
                <div
                  class="card-body"
                  style="
                    padding-top: 10px !important;
                    padding-bottom: 10px !important;
                  "
                >
                  <div class="col-md-12">
                    Buscargo LDA<br />
                    NIF 516202910<br />
                    Rua Agua Marinha, 147ft1<br />
                    Sao Domingos Da Rana<br />
                    Cascais<br />
                    2785-312
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row invoice-info" style="display: none">
          <div class="col-md-12">
            <h4 class="font-weight-bolder mt-4">
              <span class="font-weight-light">{{
                this.language.payment_summary
              }}</span>
            </h4>
            <span class="clearfix"></span>
            <hr />
          </div>
          <div class="col-md-6 invoice-col">
            <b>Número de telemóvel:</b> <span id="phone_no"></span><br />
            <b>Morada completa:</b> <span id="full_address"></span>
            <br />
            <!-- <br>
       <p ><router-link :to="`/user/dashboard/awardedshipments`"  title="Review Now">
             Clique aqui para revisão do motorista             
         </router-link></p> -->
          </div>

          <div class="col-md-6 invoice-col">
            <b>Referência:</b> <span id="reference_no"></span><br />
            <b>Valor total:</b> €<span
              id="payment_total"
              v-text="payments.total"
            ></span
            ><br />
            <b>Valor do depósito:</b> <span id="deposit_total"></span> <br />
            <b>Discount:</b> <span id="discount_amount"></span> <br />
            <b>Valor a liquidar ao motorista:</b>
            <span id="driver_amount" v-text="payments.driverAmount"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
import Payment from "../common/Payment";
import { BSpinner } from "bootstrap-vue";
export default {
  components: { Payment, BSpinner },
  data() {
    return {
      loading: false,
      moment: moment,
      baseURL,
      formData: {},
      formData1: {
        couponcode: "",
        code: 0,
      },
      language: require(`../language/${$lang}/newshipment.json`),
      bidDetails: { amt: "120" },
      isCouponShow: false,
      isDiscountShow: false,
      isCouponApplied: true,
      page: this.$route.query.page == undefined ? 1 : this.$route.query.page,
      couponPerc: 0
    };
  },
  computed: {
    ...mapGetters("bid", ["bidInfo"]),
    payments() {
      if (this.bidInfo.data?.amount == undefined) return {};
      let mainAmount = +parseFloat(this.bidInfo.data.amount);
      let payemount = +parseFloat((mainAmount * 20) / 100).toFixed(2);
      let total = mainAmount + payemount
      if(this.couponPerc > 0) {
        const discount_amount = parseFloat(((total * this.couponPerc) / 100).toFixed(2));
        this.formData1.code = discount_amount;
        total -= discount_amount
        mainAmount = +(total / 1.2)
        payemount = parseFloat((mainAmount * 0.2).toFixed(2));
        $("#payable").attr("amount", payemount);
        $("#payable").attr("discount_amount", discount_amount);
        $("#payable").attr("discount_percent", this.couponPerc);
      } 
      $("#payable").attr('amount', payemount);
      return {
        total,
        driverAmount: mainAmount,
        depositAmount: payemount,
      };
    },
  },
  mounted() {
    this.init();
  },
  methods: {
    ...mapActions("bid", ["getbidInfo"]),
    async init() {
      this.loading = true;
      await this.getbidInfo(this.$route.params.id);
      this.loading = false;
    },
    async showCoponbox() {
      this.isCouponShow = true;
    },
    async applyCoupon() {
      if (this.formData1.couponcode == "Bus5new") {
        this.couponPerc = 5;
        this.isDiscountShow = true;
        this.isCouponApplied = false;
        Swals.toast(this.language.coupon_apply_success_msg, "success");
      } else {
        Swals.message("Error", this.language.coupon_apply_error_msg, "error");
      }
    },
  },
};
</script>
<style>
@media (max-width: 570px) {
  .imagesize1 {
    width: 100px !important;
  }
  .imagesize {
    width: 30px !important;
  }
  .card-font {
    font-size: 14px;
  }
}
</style>