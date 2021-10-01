<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.shipment}}</span>  {{ language.details }}</h4>
                    <span class="clearfix"></span>
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column mt-4 px-4">
                            <img :src="`${baseURL}images/sofa.jpg`" class="w-100 rounded align-self-center mb-4" />
                            <div class="fullinfo">
                                <p class="mb-2 text-black-50">Title</p>
                                <p>{{shipment.data.title}}</p>
                            </div>
                            <div class="fullinfo">
                                <p class="mb-2 text-black-50">Description</p>
                                <p>{{shipment.data.description}}</p>
                            </div>
                            <div class="d-flex">
                                <div class="halfinfo w-50">
                                    <p class="mb-2 text-black-50">Collection</p>
                                    <p>{{shipment.data.collection}}</p>
                                </div>
                                <div class="halfinfo w-50">
                                    <p class="mb-2 text-black-50">Delivery</p>
                                    <p>{{shipment.data.delivery}}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="halfinfo w-50">
                                    <p class="mb-2 text-black-50">Distance</p>
                                    <p>{{shipment.data.distance}} Km</p>
                                </div>
                                <div class="halfinfo w-50">
                                    <p class="mb-2 text-black-50">Delivery Date</p>
                                    <p>{{shipment.data.delivery_date}}</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="halfinfo w-50">
                                    <p class="mb-2 text-black-50">Budget</p>
                                    <p>{{shipment.data.budget}} $</p>
                                </div>
                                <div class="halfinfo w-50">
                                    <p class="mb-2 text-black-50">Status</p>
                                    <span href="#" class="badge badge-success">{{shipment.data.status}}</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6 px-4">
                            <div class="headingcard ">
                                <h2 class="font-weight-bolder">Recent <span class="font-weight-lighter">Bids</span></h2>
                                <hr>
                            </div>
                            <div class="d-flex mt-3" v-for="(bid,index) in shipment.bids" :key="index">
                                <img :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`" width="60px" class="rounded-circle">
                                <div class="flex-fill mx-3">
                                    <p class="mb-2">{{bid.proposal}}</p>
                                    <span class="badge badge-success">{{bid.status}}</span>
                                </div>
                                <h1 class="align-self-end">${{bid.amount}}</h1>
                            </div>
                            <router-link :to="`/dash/shipments/view/bidlist/${shipment.data.id}`" class="btn btn-primary btn-md w-100 mt-3">View All Bids</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    data() {
        return {
            baseURL,
            language: require(`../language/${$lang}/shipments.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
        }
    },
    computed: {
        ...mapGetters("shipment", ['shipment']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("shipment", ["getShipment"]),
        async init() {
            let resp = await this.getShipment(this.$route.params.id);
        },
    }
}
</script>

<style>

</style>