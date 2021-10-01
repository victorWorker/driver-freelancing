<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <div v-if="authUser.status === 'UNAPPROVED'" class="alert alert-danger small mb-2 d-flex justify-content-between align-items-center" role="alert">
                      <span v-html="language.verify_text"></span>
                      <router-link to="/transporter/dashboard/verify" class="btn btn-sm btn-dark ml-3">{{ language.verify_btn }}</router-link>                 
                  </div>

                  <div class="alert alert-primary small mb-5 d-flex justify-content-between align-items-center" role="alert">
                      <span v-if="!membership" v-html="language.subscribe_now_text"></span>
                      <span v-if="membership" v-html="language.subscribed_text"></span>
                      <router-link to="/transporter/dashboard/subscribe" class="btn btn-sm btn-success ml-3" v-if="!membership">{{ language.subscribe_now_btn }}</router-link>                 
                      <router-link to="/transporter/dashboard/subscribe" class="btn btn-sm btn-success ml-3 new" v-if="membership">{{ language.view_details }}</router-link>                 
                  </div>
                   <h4 class="font-weight-bolder mt-1">{{ language.dashboard }}</h4>
                   <div class="row">
                        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center py-4">
                            <img :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`" width="150px" class="rounded-circle" v-if="authUser.profileimage == ''">
                            <img :src="`${baseURL}/shipments/${authUser.profileimage}`" width="150px" class="rounded-circle" v-if="authUser.profileimage != ''">
                            <h4 class="font-weight-light mt-2"><span class="font-weight-bolder"></span> {{ authUser.name }}</h4>
                            <div>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="mt-3">
                                <p class="smallmb-0">
                                    {{ language.user_since }}: <span class="font-weight-bold text-primary">{{ moment(authUser.created_at).format('LL') }}</span>
                                </p>
                            </div>
                            <div class="progress mt-4 w-50 ">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-9 px-5 py-5">
                            <div class="stat-contain d-flex justify-content-between w-100">
                                <div class="stat">
                                    <h3 class="font-weight-bolder m-0 text-warning">{{ transDashData.open_count }}</h3>
                                    <p class="text-black-50">{{ language.open_bids }}</p>
                                </div>
                                <div class="stat">
                                    <h3 class="font-weight-bolder m-0 text-success">{{ transDashData.completed_count }}</h3>
                                    <p class="text-black-50">{{ language.completed_jobs }}</p>
                                </div>
                                <div class="stat">
                                    <h3 class="font-weight-bolder m-0 text-danger">{{ transDashData.expired_count }}</h3>
                                    <p class="text-black-50">{{ language.expired_jobs }}</p>
                                </div>
                                <div class="stat">
                                    <h3 class="font-weight-bolder m-0 text-primary">€{{transDashData.total_price}}</h3>
                                    <p class="text-black-50">{{ language.revenue }}</p>
                                </div>
                            </div>
                            <div class="headingcard mt-5">
                                <h2 class="font-weight-bolder">{{ language.awarded }} <span class="font-weight-lighter">{{ language.bids }}</span></h2>
                                <hr>
                            </div>
                            <div v-if="transDashData.awarded_bids != undefined" class="personal d-flex flex-column justify-content-between table-res-contain">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{language.shipment}}</th>
                                        <th>{{language.bid_amount}}</th>
                                        <th>{{language.awarded_on}}</th>
                                        <th>{{language.status}}</th>
                                        <th>{{language.actions}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(bid, index) in transDashData.awarded_bids" :key="index">
                                            <td>{{ bid.shipment.title }}</td>
                                            <td><h5 class="font-weight-bold text-dark">€{{ bid.amount }}</h5></td>
                                            <td><span class="date small">{{ moment(bid.updated_at).format('LL') }}</span></td>
                                            <td>
                                                <span class="badge badge-success text-white">{{ bid.status }}</span>
                                            </td>
                                            <td>
                                                <a href="#" @click.prevent="" class="small text-success">Message User | </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <router-link :to="`/transporter/dashboard/awardedbids`" class="btn btn-secondary btn-md w-50 mt-3 align-self-end font-weight-bold mt-3" v-if="transDashData.awarded_bids.length >= 5">View All Bids</router-link>
                            </div>
                            <div class="headingcard mt-5">
                                <h2 class="font-weight-bolder">{{ language.latest }} <span class="font-weight-lighter">{{ language.invitations }}</span></h2>
                                <hr>
                            </div>
                            <div v-if="transDashData.invitations != undefined" class="personal d-flex flex-column justify-content-between table-res-contain">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{language.shipment}}</th>
                                        <th>{{language.bid_amount}}</th>
                                        <th>{{language.awarded_on}}</th>
                                        <th>{{language.status}}</th>
                                        <th>{{language.actions}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(bid, index) in transDashData.awarded_bids" :key="index">
                                            <td>{{ bid.shipment.title }}</td>
                                            <td><h5 class="font-weight-bold text-dark">€{{ bid.amount }}</h5></td>
                                            <td><span class="date small">{{ moment(bid.updated_at).format('LL') }}</span></td>
                                            <td>
                                                <span class="badge badge-success text-white">{{ bid.status }}</span>
                                            </td>
                                            <td>
                                                <a href="#" @click.prevent="" class="small text-success">Message User | </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <router-link :to="`/transporter/dashboard/awardedbids`" class="btn btn-secondary btn-md w-50 mt-3 align-self-end font-weight-bold mt-3" v-if="transDashData.invitations.length >= 5">View All Bids</router-link>
                            </div>
                        </div>
                    </div>


                    <div class="row px-5">
                        <div class="headingcard mt-5">
                            <h2 class="font-weight-bolder">{{ language.latestr }} <span class="font-weight-lighter">{{ language.reviews }}</span></h2>
                            <hr>
                        </div>
                        <div class="table-res-contain">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{ language.shipment }}</th>
                                    <th scope="col">{{ language.rating }}</th>
                                    <th scope="col">{{ language.review }}</th>
                                    <th scope="col">{{ language.amount }}</th>
                                    <th scope="col">{{ language.date }}</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr v-for="(review, index) in transDashData.reviews" :key="index">
                                    <td>{{ review.shipment.title }}</td>
                                    <td>
                                        <i v-for="item in review.rating" :key="item"  class="fa fa-star text-warning"></i>
                                    </td>
                                    <td>
                                        <i>{{ review.review }}</i>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold text-dark">€{{ review.bid.amount }}</h5>
                                    </td>
                                    <td>
                                        <span class="date small">{{ moment(review.created_at).format('LL') }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
export default {
    data() {
        return {
            baseURL,
            language: require(`../language/${$lang}/transporterdash.json`),
            moment
        }
    },
    computed: {
        ...mapGetters("dashboard", ['transDashData']),
        ...mapGetters("user", ['authUser']),
        membership() {
            return this.authUser.membership != null && this.authUser.membership == 1 && this.authUser.membership_status == 'ACTIVE';
        }
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("dashboard", ["getTransDashData"]),
        async init() {
            let resp = await this.getTransDashData();
        },
        
    }
}
</script>

<style lang="scss">
.stat{
    margin-right: 15px;
}
@media (max-width: 480px) {
    .stat-contain {
        flex-direction: column;
    }
}
.borderbox{
    border: 1px solid #e1e1e1;
    border-radius: 10px;
}
.justify-content-evenly{
    justify-content:space-evenly;
}
.personal > .stat > h3{
    font-size: 14px;
}
</style>