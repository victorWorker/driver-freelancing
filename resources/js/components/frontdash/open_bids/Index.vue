<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.open}}</span>  {{ language.bids }}</h4>
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
                        <th>{{language.expiration}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(bid, index) in openbids" :key="index">
                            <td>{{ (index + 1) }}</td>
                            <td>{{ bid.shipment.title }}</td>
                            <td>
                                <span class="badge badge-success text-white">{{ bid.status }}</span>
                            </td>
                            <td><h5 class="font-weight-bold text-dark">€{{ bid.amount }}</h5></td>
                            <td><h5 class="font-weight-bold text-dark">€{{ bid.shipment.budget }}</h5></td>
                            <td><span class="date small">{{ moment(bid.expiration).format('LL') }}</span></td>
                            <td>
                                <!-- <a href="#" @click.prevent="promoteBid(bid.id)" v-if="membership && bid.promoted === null" class="small text-success">Promote | </a> -->
                                <a href="#" class="small text-primary" 
                                    @click.prevent="addBidModal({ id: bid.id, proposal: bid.proposal, amount: bid.amount, expiration: bid.expiration })">
                                    {{ language.edit }} | 
                                </a>
                                <a href="#" class="small text-primary" 
                                    @click.prevent="addmessageModal({ id: bid.id,driver_id:bid.driver_id,user_id:bid.user_id,shipment_id:bid.shipment_id,subject:bid.shipment.title,subject1:bid.shipment.title  })">
                                    <i class="fa fa-envelope"></i> | 
                                </a>
                                <a href="#" @click.prevent="removeBid(bid.id)" class="small text-danger">{{ language.delete }} | </a>
                                <span class="badge badge-success ml-3" v-if="bid.promoted === 1">PROMOTED</span>
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
                        <button type="button" @click.prevent="editBid" class="btn btn-primary">{{ language.update_bid }}</button>
                    </div>
                    </div>
                </div>
            </div>

            <!--bid message modal-->
            <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{language.message}}</h5>
                        <button type="button" class="close" @click.prevent="closemessageModal">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <div class="form-group">
                        <label for="">{{language.subject}}</label>
                        <input type="text" readonly="" v-model="formData1.subject1" placeholder="Enter Subject" class="form-control">
                         <input type="hidden" v-model="formData1.subject" placeholder="Enter Subject" class="form-control">
                    </div>

                    <div class="form-group">
                        <label   style="border:1px solid gray;padding: 10px;"  :class="{ active : active_el == 1 }" for="no" @click.prevent="getmessage(language.question1,1)">{{language.question1}}</label><br>
                        <label  style="border:1px solid gray;padding: 10px;" :class="{ active : active_el == 2 }" for="no" @click.prevent="getmessage(language.question2,2)">{{language.question2}}</label><br>
                        <label style="border:1px solid gray;padding: 10px;"  :class="{ active : active_el == 3 }" for="no" @click.prevent="getmessage(language.question3,3)">{{language.question3}}</label><br>
                        <label style="border:1px solid gray;padding: 10px;"  :class="{ active : active_el == 4 }" for="no" @click.prevent="getmessage(language.question4,4)">{{language.question4}}</label><br>
                        <label style="border:1px solid gray;padding: 10px;"  :class="{ active : active_el == 5 }" for="no" @click.prevent="getmessage(language.question5,5)">{{language.question5}}</label><br>
                        <label style="border:1px solid gray;padding: 10px;"   :class="{ active : active_el == 6 }" for="no" @click.prevent="getmessage(language.question6,6)">{{language.question6}}</label><br>
                    </div>

                   

                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="setSubject" class="btn btn-primary">{{language.send}}</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="transporter/dashboard/openbids" :fetch="getOpenBids" />
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
            language: require(`../language/${$lang}/openbids.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            edit: false,
            active_el:0,
            formData: {},
            formData1: {
                'subject':'',
                'subject1':'',
                'message':'',
                'driver_id':'',
                'user_id':'',
                'shipment_id':'',
            },
            moment
        }
    },
    computed: {
        ...mapGetters("bid", ['openbids', 'pagination', 'errors']),
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
        ...mapActions("bid", ["getOpenBids", "updateBid", "deleteBid", "promoteTransBid" ,"addMessageSubjectbyDriver"]),
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
        addmessageModal(data){
            this.formData1 = data; 
            $('#messageModal').modal('show');
        },
        closemessageModal(data){
            $('#messageModal').modal('hide');
        },
        getmessage(msg,el){
            this.active_el = el;
            this.formData1.message=msg;
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
        async setSubject() {
            console.log(this.formData1);
            await Swals.dialog1(
                this.language.are_you_sure,
                this.language.send_message_to_user,
                this.language.yes+','+ this.language.continue,
                this.language.cancel,
                this.language.sent,
                this.language.message_sent_successfully,
                this.addMessageSubjectbyDriver,
                this.formData1
            );
            $('#messageModal').modal('hide');
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
            this.getOpenBids(this.page);
        },
    }
}
</script>

<style>
.date{
    color: #b7b7b7;
}
.active {
  color : green;
}
</style>