<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.completed}}</span>  {{ language.shipments }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>{{language.title}}</th>
                        <th>{{language.awarded_to}}</th>
                        <th>{{language.budget}}</th>
                        <th>{{language.bid_amount}}</th>
                        <th>{{language.completed_on}}</th>
                        <th>{{language.rating}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(shipment, index) in completedshipments" :key="index">
                            <td>{{ shipment.title }}</td>
                            <td>
                                <span class="small">{{ shipment.awarded.name }}</span>
                            </td>
                            <td><h5 class="font-weight-bold text-dark mb-0">€{{ shipment.budget }}</h5></td>
                            <td><h5 class="font-weight-bold text-dark mb-0">€{{ shipment.awardedbid.amount }}</h5></td>
                            <td><span class="date small">{{ moment(shipment.updated_at).format('LL') }}</span></td>
                            <td>
                                <i class="fa fa-star text-warning"  v-if="shipment.review.rating !=''" v-for="item in shipment.review.rating" :key="item"></i>
                            </td>
                            <td class="d-flex"> 
                                <router-link :to="`/user/dashboard/shipment/view/${shipment.id}`" class="mr-1 bg-success text-white circle-btn" title="Details">
                                   <i class="fas fa-stream"></i>
                                </router-link>
                                  <a href="#" v-if="shipment.review.rating =='' && shipment.review.rating ==0" class="mr-1 bg-secondary text-warning circle-btn" title="Provide Rating" @click.prevent="openReview(shipment)"><i class="fa fa-star"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>

        </div>

        <Pagination :pagination="pagination" route="user/dashboard/completedshipments" :fetch="getUserCompletedShipments" />
        <Review :data="shipment" :language="language"/>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
import Review from '../common/Review';
import Pagination from '../common/Pagination';

export default {
    components: { Pagination,Review },
    data() {
        return {
            language: require(`../language/${$lang}/completedshipments.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            edit: false,
            formData: {},
            moment,
            shipment: {},
        }
    },
    computed: {
        ...mapGetters("shipment", ['completedshipments', 'pagination', 'errors']),
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("shipment", ["getUserCompletedShipments",]),
        async init() {
            
        },
    
    openReview(shipment) {
            $('#reviewModal').modal('show');
            this.shipment = shipment;
        }
    }    
}
</script>

<style>
.date{
    color: #b7b7b7;
}
.circle-btn{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px !important;
    height: 30px !important;
    border-radius: 30px !important;
    padding: 3px;
}
.circle-btn:hover{
    text-decoration: none;
    opacity: 0.89;
}
</style>