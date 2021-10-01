<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.expired}}</span>  {{ language.shipments }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                         <th>{{language.title}}</th>
                        <th>{{language.collection}}</th>
                        <th>{{language.delivery}}</th>
                        <th>{{language.delivery_date}}</th>
                        <th>{{language.budget}}</th>
                        <th>{{language.status}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(shipment, index) in expiredshipments" :key="index">
                            <td>{{ shipment.title }}</td>
                            <td>{{ shipment.collection }}</td>
                            <td>{{ shipment.delivery }}</td>
                            <td><span class="date small">{{ moment(shipment.delivery_date).format('LL') }}</span></td>
                            <td><h5 class="font-weight-bold text-dark mb-0">€{{ shipment.budget }}</h5></td>
                            <td><h5 class="font-weight-bold text-dark mb-0"><span class="badge badge-danger">{{ shipment.status }}</span></h5></td>
                            <td class="d-flex">
                                <a href="" class="small text-success" @click.prevent="edit(shipment)" v-if="shipment.competitors !== null">Edit Prices | </a> 
                                <router-link :to="`/user/dashboard/shipment/view/${shipment.id}`" class="mr-1 bg-success text-white circle-btn" title="Details">
                                   <i class="fas fa-stream"></i>
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>


        </div>

        <Pagination :pagination="pagination" route="user/dashboard/expiredshipments" :fetch="getUserExpiredShipments" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
import Pagination from '../common/Pagination';

export default {
    components: { Pagination },
    data() {
        return {
            language: require(`../language/${$lang}/expiredshipments.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            moment
        }
    },
    computed: {
        ...mapGetters("shipment", ['expiredshipments', 'pagination', 'errors']),
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("shipment", ["getUserExpiredShipments",]),
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