<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.awarded}}</span>  {{ language.shipments }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>{{language.title}}</th>
                        <th>{{language.delivery_date}}</th>
                        <th>{{language.budget}}</th>
                        <th>{{language.awarded_to}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(shipment, index) in awardedshipments" :key="index">
                            <td>{{ shipment.title }}</td>
                            <td><span class="date small">{{ moment(shipment.delivery_date).format('LL') }}</span></td>
                            <td><h5 class="font-weight-bold text-dark mb-0">€{{ shipment.budget }}</h5></td>
                            <td>
                                <span class="small">{{ shipment.awarded && shipment.awarded.name }}</span>
                            </td>
                            <td class="d-flex">
                                <router-link :to="`/user/dashboard/shipment/view/${shipment.id}`" class="mr-1 bg-success text-white circle-btn" title="Details">
                                   <i class="fas fa-stream"></i>
                                </router-link>
                                 <a href="#" class="mr-1 bg-primary text-white circle-btn" title="Message Transporter"><i class="fa fa-envelope"></i></a>
                                <!--  <a href="#" class="mr-1 bg-secondary text-warning circle-btn" title="Provide Rating" @click.prevent="openReview(shipment)"><i class="fa fa-star"></i></a> -->

                                  <a href="javascript:void(0)" @click.prevent="markasComplete(shipment,shipment.id)" class="mr-1 bg-success text-white circle-btn" title="Mark as Complete"> <i class="fa fa-check"></i></a>

                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="shipmentModal" tabindex="-1" role="dialog" aria-labelledby="shipmentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ language.edit_bid }}</h5>
                        <button type="button" class="close" @click.prevent="closeShipmentModal">
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

        <Pagination :pagination="pagination" route="user/dashboard/awardedshipments" :fetch="getUserAwardedShipments" />
        <Review :data="shipment" :language="language"/>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
import Review from '../common/Review';
import Pagination from '../common/Pagination';

export default {
    components: { Pagination, Review },
    data() {
        return {
            language: require(`../language/${$lang}/awardedshipments.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            edit: false,
            formData: {},
            moment,
            shipment: {},
        }
    },
    computed: {
        ...mapGetters("shipment", ['awardedshipments', 'pagination', 'errors']),
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("shipment", ["getUserAwardedShipments","completemarkShip","getOpenBids"]),
        async init() {
            
        },
        addShipmentModal(data) {
            this.formData = data; 
            $('#shipmentModal').modal('show');
        },
        closeShipmentModal() {
            $('#shipmentModal').modal('hide');
        },
        async editBid() {
            this.formData.expiration = this.moment(this.formData.expiration).format('YYYY-MM-DD');
            let resp = await this.updateBid(this.formData);
            if(resp == 'success') {
                this.getUserAwardedShipments(this.page);
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
            this.getUserAwardedShipments(this.page);
        },
         async markasComplete(shipment,id){
             await Swals.dialog1(
                this.language.are_you_sure,
                this.language.mark_as_complete,
                this.language.yes+', '+this.language.continue,
                'Cancelar',
                this.language.completed,
                this.language.shipment_completed_successfully,
                this.completemarkShip,
                id
            );
            this.openReview(shipment);
            this.getUserAwardedShipments(this.page);
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