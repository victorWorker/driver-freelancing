<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                    <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.user}}</span>  {{ language.details }}</h4>
                    <span class="clearfix"></span>
                    <div class="row">
                        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center py-4">
                            <img :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`" width="150px" class="rounded-circle">
                            <h3 class="font-weight-light mt-2"><span class="font-weight-bolder">{{user.details.name}}</span></h3>
                            <div>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="progress mt-4 w-50 ">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-7 px-5 py-5">
                            <div class="d-flex justify-content-between">
                                <div class="stat">
                                    <h3 class="font-weight-bolder m-0">25</h3>
                                    <p class="text-black-50">OPEN LISTINGS</p>
                                </div>
                                <div class="stat">
                                    <h3 class="font-weight-bolder m-0">11</h3>
                                    <p class="text-black-50">COMPLETED LISTINGS</p>
                                </div>
                                <div class="stat">
                                    <h3 class="font-weight-bolder m-0">09</h3>
                                    <p class="text-black-50">EXPIRED LISTINGS</p>
                                </div>
                                <div class="stat">
                                    <h3 class="font-weight-bolder m-0">500</h3>
                                    <p class="text-black-50">MESSAGES</p>
                                </div>
                            </div>
                            <div class="headingcard mt-5">
                                <h2 class="font-weight-bolder">Personal <span class="font-weight-lighter">Details</span></h2>
                                <hr>
                            </div>
                            <div class="personal d-flex justify-content-between">
                                <div class="stat">
                                    <p class="text-black-50">Full Name</p>
                                    <h3 class="font-weight-bolder m-0">{{user.details.name}}</h3>
                                </div>
                                <div class="stat">
                                    <p class="text-black-50">Type of User</p>
                                    <h3 class="font-weight-bolder m-0">{{user.details.type}}</h3>
                                </div>
                                <div class="stat">
                                    <p class="text-black-50">Email</p>
                                    <h3 class="font-weight-bolder m-0">{{user.details.email}}</h3>
                                </div>
                                <div class="stat">
                                    <p class="text-black-50">Phone</p>
                                    <h3 class="font-weight-bolder m-0">{{user.details.phone}}</h3>
                                </div>
                            </div>
                            <div class="headingcard mt-5">
                                <h2 class="font-weight-bolder">Extra <span class="font-weight-lighter">Details</span></h2>
                                <hr>
                            </div>
                            <div class="personal d-flex justify-content-between">
                                <div class="stat">
                                    <p class="text-black-50">Address</p>
                                    <h3 class="font-weight-bolder m-0">{{user.details.address}}</h3>
                                </div>
                                <div class="stat">
                                    <p class="text-black-50">Join Date</p>
                                    <h3 class="font-weight-bolder m-0">{{moment(user.details.created_at).format('DD-MM-YYYY hh:mm')}}</h3>
                                </div>
                                <div class="stat">
                                    <p class="text-black-50">Country</p>
                                    <h3 class="font-weight-bolder m-0">{{user.details.country}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-5">
                        <div class="headingcard mt-5">
                            <h2 class="font-weight-bolder">Latest <span class="font-weight-lighter">Listings</span></h2>
                            <hr>
                        </div>
                        <div class="table-res-contain">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">S No.</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Collection</th>
                                    <th scope="col">Delivery</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr v-for="(listing,index) in user.listings" :key="index">
                                    <th>{{index+1}}</th>
                                    <td>{{listing.title}}</td>
                                    <td>{{listing.budget}}</td>
                                    <td>{{listing.collection}}</td>
                                    <td>{{listing.delivery}}</td>
                                    <td>
                                        <label :class="'badge badge-danger'">{{listing.status}}</label>
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
            moment:moment,
            baseURL,
            language: require(`../language/${$lang}/users.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
        }
    },
    computed: {
        ...mapGetters("user", ['user']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", ["getUser"]),
        async init() {
            let resp = await this.getUser(this.$route.params.id);
            console.log(this.user);
        },
    }
}
</script>

<style>
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