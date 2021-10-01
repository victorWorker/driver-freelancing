<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.awarded}}</span>  {{ language.bids }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{language.shipment}}</th>
                        <th>{{language.status}}</th>
                        <th>{{language.bid_amount}}</th>
                        <th>{{language.client_budget}}</th>
                        <th>{{language.awarded_on}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(bid, index) in awardedbids" :key="index">
                            <td>{{ (index + 1) }}</td>
                            <td>{{ bid.shipment.title }}</td>
                            <td>
                                <span class="badge badge-success text-white">{{ bid.status }}</span>
                            </td>
                            <td><h5 class="font-weight-bold text-dark">€{{ bid.amount }}</h5></td>
                            <td><h5 class="font-weight-bold text-dark">€{{ bid.shipment.budget }}</h5></td>
                            <td><span class="date small">{{ moment(bid.updated_at).format('LLL') }}</span></td>
                            <td>
                                <!-- <a href="#" class="small text-primary" 
                                    @click.prevent="addBidModal({ id: bid.id, proposal: bid.proposal, amount: bid.amount, expiration: bid.expiration })">
                                    Edit | 
                                </a> -->
                                <a href="#" @click.prevent="" class="small text-success">Message User | </a>
                                <router-link :to="`/transporter/dashboard/guia/${bid.shipment.id}`" class="small text-primary">Guia de transporte </router-link>
                                <!-- <a href="#" @click.prevent="removeBid(bid.id)" class="small text-danger">Delete | </a> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ language.edit_bid }}</h5>
                        <button type="button" class="close" @click.prevent="closeBidModal">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="form-group">
                           <label for="">{{ language.proposal }}</label>
                           <textarea v-model="formData.proposal" rows="5" class="form-control" placeholder="Bid Proposal"></textarea>
                       </div>

                       <div class="form-group">
                           <label for="">{{ language.bid_amount }}</label>
                           <input type="text" v-model="formData.amount" class="form-control" placeholder="Enter Category Title">
                       </div>

                       <div class="form-group">
                           <label for="">{{ language.expiration }}</label>
                           <br />
                           <v-date-picker v-model='formData.expiration' :min-date='new Date()' />
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="editBid" class="btn btn-primary">UPDATE BID</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="transporter/dashboard/awardedbids" :fetch="getAwardedBids" />
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
            language: require(`../language/${$lang}/awardedbids.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            edit: false,
            formData: {},
            moment
        }
    },
    computed: {
        ...mapGetters("bid", ['awardedbids', 'pagination', 'errors']),
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("bid", ["getAwardedBids", "updateBid", "deleteBid"]),
        async init() {
            let resp = await this.getOpenBids(this.page);
        },
        addBidModal(data) {
            this.formData = data; 
            $('#bidModal').modal('show');
        },
        closeBidModal() {
            $('#bidModal').modal('hide');
        },
        async editBid() {
            this.formData.expiration = this.moment(this.formData.expiration).format('YYYY-MM-DD');
            let resp = await this.updateBid(this.formData);
            if(resp == 'success') {
                this.getOpenBids(this.page);
                Swals.toast('Bid Updated Successfully', 'success');
                this.closeBidModal();
            }else{
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swals.message('Error', errors, 'error');
            }
        },
        async removeBid(id){
           await Swals.dialog(
                'Are You Sure?',
                'This Will Delete your Bid Permanently !',
                'Yes, Continue',
                'Deleted',
                'Bid Deleted Successfully.',
                this.deleteBid,
                id
            );
            this.getOpenBids(this.page);
        },
    }
}
</script>

<style>
.date{
    color: #b7b7b7;
}
</style>