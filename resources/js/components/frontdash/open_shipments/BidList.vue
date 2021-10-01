<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.all}}</span>  {{ language.bids }}</h4>
                <h5 v-if="shipmentbids[0] != undefined" class="font-weight-bold">Shipment: <span class="font-weight-light">{{ shipmentbids[0].shipment.title }}</span></h5>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>{{language.proposal}}</th>
                        <th>{{language.transporter}}</th>
                        <th>{{language.bid_amount}}</th>
                        <!--<th>{{language.deposit_amount}}</th> -->
                        <th>{{language.status}}</th>
                        <th>{{language.date}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(bid, index) in shipmentbids" :key="index">
                            <td><small>{{ bid.proposal.substring(0,50) }} <span v-if="bid.proposal.length>50">...</span> </small></td>
                            <td>{{ bid.transporter.name }} </td>
                            <td><h5 class="font-weight-bold">€{{ bid.amount + (bid.amount * 20 / 100)}}</h5></td>
                            <!--<td><h5 class="font-weight-bold">€{{ bid.amount * 20 / 100 }}</h5></td>-->
                           <td>
                                <label :class="(bid.status === 'ACTIVE') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ bid.status }}</label>
                            </td>
                            <td>{{ moment(bid.created_at).format('DD-MM-YYYY') }}</td>
                            <td class="h-100 d-flex align-items-center"> 
                                <a href="#" @click.prevent="view(bid)" class="mr-2 bg-warning text-white circle-btn" title="View Bid"><i class="fas fa-stream"></i> </a>
                                <div class="d-flex align-items-center" v-if="(bid.status !== 'SUSPENDED' && bid.status !== 'EXPIRED')">
                                    <router-link :to="`/user/dashboard/messages?subject_id=${bid.subject_id}`" class="mr-2 bg-primary text-white circle-btn" title="Message" v-if="bid.subject_id !== null && (bid.shipment.status == 'ACTIVE' || bid.shipment.status == 'AWARDED')"><i class="fa fa-envelope"></i></router-link>
                                    <a href="#" @click.prevent="viewMessage(bid)" class="mr-2 bg-primary text-white circle-btn" title="Message" v-if="bid.subject_id === null && (bid.shipment.status == 'ACTIVE' || bid.shipment.status == 'AWARDED')"><i class="fa fa-envelope"></i></a>
                                    <router-link :to="`/user/dashboard/bid/award/${bid.id}`" class="bg-success text-white circle-btn" title="Award" v-if="bid.shipment.status == 'ACTIVE'"><i class="fa fa-check"></i></router-link>
                                </div>  
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" :route="`user/dashboard/bidlist/view/${this.$route.params.id}`" :fetch="() => getUserShipmentBids({id:this.$route.params.id, page:this.page})" />
        <ViewBid :data="bid" :editing="editing" />
        <MessageModal :data="bid" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import Pagination from '../common/Pagination';
import ViewBid from '../common/ViewBid';
import MessageModal from '../common/MessageModal';
import moment from 'moment';
export default {
    components: { Pagination, ViewBid, MessageModal },
    data() {
        return {
            moment: moment,
            language: require(`../language/${$lang}/bidlist.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            bid: '',
            editing: false
        }
    },
    computed: {
        ...mapGetters("bid", ['shipmentbids', 'pagination']),
        

    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("bid", ["getUserShipmentBids"]),
        async init() {
            
        },
        view(bid) {
            this.bid = bid;
            this.editing = false;
            $('#bidModal').modal('show')
        },
        viewMessage(bid) {
            this.bid = bid;
            $('#messageModal').modal('show')
        }
        
    }
}
</script>

<style>

</style>