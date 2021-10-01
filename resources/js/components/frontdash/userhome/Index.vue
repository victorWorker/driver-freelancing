<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <UserModal :active="modalActive" :language="language" />
          <div
            class="
              alert alert-primary
              small
              mb-5
              d-flex
              justify-content-between
              align-items-center
            "
            role="alert"
          >
            <span v-html="language.new_shipment_text"></span>
            <router-link
              to="/user/dashboard/newshipment"
              class="btn btn-sm btn-success ml-3 new"
              >[+] {{ language.new_shipment_btn }}</router-link
            >
          </div>
          <h4 class="font-weight-bolder mt-1">{{ language.dashboard }}</h4>
          <div class="row" v-if="userDashData.user != undefined">
            <div
              class="
                col-md-3
                d-flex
                flex-column
                justify-content-center
                align-items-center
                py-4
              "
            >
              <img :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`" width="150px" class="rounded-circle" v-if="userDashData.user.profileimage == ''">
              <img :src="`${baseURL}/shipments/${userDashData.user.profileimage}`" width="150px" class="rounded-circle" v-if="userDashData.user.profileimage != ''">
              <h3 class="font-weight-light mt-2">
                <span class="font-weight-bolder"></span>
                {{ userDashData.user.name }}
              </h3>
              <div class="mt-3">
                <p class="smallmb-0">
                  {{ language.user_since }}:
                  <span class="font-weight-bold text-primary">{{
                    moment(userDashData.user.created_at).format("LL")
                  }}</span>
                </p>
              </div>
              <div class="progress mt-4 w-50">
                <div
                  class="progress-bar"
                  role="progressbar"
                  style="width: 25%"
                  aria-valuenow="25"
                  aria-valuemin="0"
                  aria-valuemax="100"
                ></div>
              </div>
            </div>
            <div class="col-md-9 px-5 py-5">
              <div class="stat-contain d-flex justify-content-between w-100">
                <div class="stat">
                  <h3 class="font-weight-bolder m-0 text-warning">
                    {{ userDashData.open_count }}
                  </h3>
                  <p class="text-black-50">{{ language.open_jobs }}</p>
                </div>
                <div class="stat">
                  <h3 class="font-weight-bolder m-0 text-success">
                    {{ userDashData.completed_count }}
                  </h3>
                  <p class="text-black-50">{{ language.completed_jobs }}</p>
                </div>
                <div class="stat">
                  <h3 class="font-weight-bolder m-0 text-primary">
                    {{ userDashData.awarded_count }}
                  </h3>
                  <p class="text-black-50">{{ language.awarded_jobs }}</p>
                </div>

                <div class="stat">
                  <h3 class="font-weight-bolder m-0 text-danger">
                    {{ userDashData.expired_count }}
                  </h3>
                  <p class="text-black-50">{{ language.expired_jobs }}</p>
                </div>
              </div>
              <div class="headingcard mt-5">
                <h2 class="font-weight-bolder">
                  {{ language.open }}
                  <span class="font-weight-lighter">{{
                    language.shipments
                  }}</span>
                </h2>
                <hr />
              </div>
              <div
                v-if="userDashData.open_shipments != undefined"
                class="personal d-flex flex-column justify-content-between"
              >
                <div class="table-res-contain">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>{{ language.shipment }}</th>
                        <th>{{ language.collection }}</th>
                        <th>{{ language.delivery }}</th>
                        <th>{{ language.delivery_on }}</th>
                        <th>{{ language.actions }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(shipment, index) in userDashData.open_shipments"
                        :key="index"
                      >
                        <td>{{ shipment.title }}</td>
                        <td>{{ shipment.collection }}</td>
                        <td>{{ shipment.delivery }}</td>
                        <td>
                          <span class="date small">{{
                            moment(shipment.delivery_date).format("LL")
                          }}</span>
                        </td>
                        <td>
                          <div class="d-flex">
                            <router-link
                              :to="`/user/dashboard/shipment/view/${shipment.id}`"
                              class="mr-1 bg-success text-white circle-btn"
                              style="margin-top: 15px"
                            >
                              <i class="fas fa-stream"></i>
                            </router-link>
                            <img
                              :src="`${baseURL}images/arrowbtn.png`"
                              style="width: 130px; height: 60px"
                              class="rounded-circle"
                            />
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <router-link
                  :to="`/transporter/dashboard/awardedbids`"
                  class="
                    btn btn-secondary btn-md
                    w-50
                    mt-3
                    align-self-end
                    font-weight-bold
                    mt-3
                  "
                  v-if="userDashData.open_shipments.length == 5"
                  >View All Bids</router-link
                >
              </div>
              <div class="headingcard mt-5">
                <h2 class="font-weight-bolder">
                  {{ language.awarded }}
                  <span class="font-weight-lighter">{{
                    language.shipments
                  }}</span>
                </h2>
                <hr />
              </div>
              <div
                v-if="userDashData.awarded_shipments != undefined"
                class="personal d-flex flex-column justify-content-between"
              >
                <div class="table-res-contain">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>{{ language.shipment }}</th>
                        <th>{{ language.collection }}</th>
                        <th>{{ language.delivery }}</th>
                        <th>{{ language.awarded_to }}</th>

                        <th>{{ language.actions }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(
                          shipment, index
                        ) in userDashData.awarded_shipments"
                        :key="index"
                      >
                        <td>{{ shipment.title }}</td>
                        <td>{{ shipment.collection }}</td>
                        <td>{{ shipment.delivery }}</td>
                        <td>
                          <span class="small">{{ shipment.awarded && shipment.awarded.name }}</span>
                        </td>

                        <td class="d-flex h-100">
                          <router-link
                            :to="`/user/dashboard/shipment/view/${shipment.id}`"
                            class="mr-1 bg-success text-white circle-btn"
                            title="Details"
                          >
                            <i class="fas fa-stream"></i>
                          </router-link>
                          <a
                            href="#"
                            class="mr-1 bg-primary text-white circle-btn"
                            title="Message Transporter"
                            ><i class="fa fa-envelope"></i
                          ></a>
                          <a
                            href="#"
                            class="mr-1 bg-secondary text-warning circle-btn"
                            title="Provide Rating"
                            @click.prevent="openReview(shipment)"
                            ><i class="fa fa-star"></i
                          ></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <router-link
                  :to="`/transporter/dashboard/awardedbids`"
                  class="
                    btn btn-secondary btn-md
                    w-50
                    mt-3
                    align-self-end
                    font-weight-bold
                    mt-3
                  "
                  v-if="userDashData.awarded_shipments.length == 5"
                  >View All Bids</router-link
                >
                <Review :data="shipment" :language="language" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import moment from "moment";
import Review from "../common/Review";
import UserModal from "../../core/UserModal.vue";
export default {
  components: { Review, UserModal },
  data() {
    return {
      modalActive: false,
      baseURL,
      language: require(`../language/${$lang}/userdash.json`),
      moment,
      shipment: {},
    };
  },
  watch: {
    userDashData(v) {
      if (!v) return;
      const openShipments = v.open_shipments
      if (this.isNotAllowed) {
        const lastShipment = openShipments[openShipments.length - 1]
        this.$router.push(`/user/dashboard/shipment/view/${lastShipment.id}`)
      } else {
        this.modalActive = true;
      }
    },
  },
  computed: {
    ...mapGetters("dashboard", ["userDashData"]),
    isRedirect() {
      return location.pathname.includes('/redirect')
    },
    isNotAllowed() {
      return this.isRedirect && this.userDashData?.open_shipments?.length
    }
  },
  mounted() {
    this.init();
  },
  methods: {
    ...mapActions("dashboard", ["getUserDashData"]),
    async init() {
       await this.getUserDashData();
    },
    openReview(shipment) {
      $("#reviewModal").modal("show");
      this.shipment = shipment;
    },
  },
};
</script>

<style>
.stat {
  margin-right: 15px;
}
.borderbox {
  border: 1px solid #e1e1e1;
  border-radius: 10px;
}
.justify-content-evenly {
  justify-content: space-evenly;
}
.personal > .stat > h3 {
  font-size: 14px;
}
.circle-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100px !important;
  height: 30px !important;
  border-radius: 5px !important;
  padding: 3px;
}
.circle-btn:hover {
  text-decoration: none;
  opacity: 0.89;
}
.dash-auto-model {
  max-width: 800px;
  width: 100%;
}
.dash-auto-model .modal-content {
  box-shadow: 0px 0px 7px #d7d7d7;
  min-height: 220px;
}
.dash-auto-model .close {
  position: absolute;
  right: 7px;
  top: 3px;
  z-index: 99;
}
.modal-backdrop.show {
  opacity: 0 !important;
  display: none;
}
@media only screen and (min-width: 576px) {
  .modal-dialog {
    margin: 30px 20px 20px 32% !important;
  }
}
</style>