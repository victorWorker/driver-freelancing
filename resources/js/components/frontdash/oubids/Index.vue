<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light"></span>  {{language.oubids}}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>{{language.number}}</th>
                        <th>{{language.request}}</th>
                        <th>{{language.status}}</th>
                        <th>{{language.your_bid}}</th>
                        <th>{{language.lowest_bid}}</th>
                       <!-- <th>{{language.expiration}}</th>-->
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead> 
                    <tbody>
                        <tr v-for="(bid, index) in oubids" :key="index">
                            <td>{{ (index + 1) }}</td>
                            <td>{{ bid.shipment.title }}</td>
                            <td>
                                <span class="badge badge-success text-white">{{ bid.status }}</span>
                            </td>
                            <td><h5 class="font-weight-bold text-dark">€{{ bid.amount }}</h5></td>
                            <td><h5 class="font-weight-bold text-dark">€{{ bid.minprice }}</h5> 
                           <span v-if="bid.mindriver_id !== bid.login_id">
                            You have been outbid, revise you bid here<br>
                            A sua licitação foi superada por outro motorista, edite a sua licitação aqui
                           </span>
                           </td>
                          
                            <td>
                                
                                <a href="#" class="small text-primary" 
                                    @click.prevent="addBidModal({ id: bid.id, proposal: bid.proposal, amount: bid.amount, expiration: bid.expiration })">
                                    {{ language.edit }}
                                </a>
                              
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
                           <label for="">{{ language.bid_amount }}</label>
                           <input type="text" v-model="formData.amount" class="form-control" placeholder="Enter Category Title">
                       </div>

                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="editBid" class="btn btn-primary btn1">{{ language.update_bid }}</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="transporter/dashboard/oubids" :fetch="getOuBids" />
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
            language: require(`../language/${$lang}/oubids.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            edit: false,
            formData: {},
            moment
        }
    },
    computed: {
        ...mapGetters("bid", ['oubids', 'pagination', 'errors']),
        ...mapGetters('user', ['authUser']),
        membership() {
            return this.authUser.membership != null 
                   && this.authUser.membership == 1 
                   && this.authUser.membership_status == 'ACTIVE';
        }
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("bid", ["getOuBids", "updateOuBid", "deleteBid", "promoteTransBid"]),
        async init() {
            let resp = await this.getOuBids(this.page);
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
            let resp = await this.updateOuBid(this.formData);
            if(resp == 'success') {
                this.getOuBids(this.page);
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
            this.getOuBids(this.page);
        },
        async promoteBid(id){
            await Swals.dialog(
                'Are You Sure?',
                'This Will Mark your Bid as Promoted !',
                'Yes, Continue',
                'Promoted',
                'Bid Promoted Successfully.',
                this.promoteTransBid,
                id
            );
            this.getOuBids(this.page);
        },
    }
}
</script>

<style>
.date{
    color: #b7b7b7;
}
</style>