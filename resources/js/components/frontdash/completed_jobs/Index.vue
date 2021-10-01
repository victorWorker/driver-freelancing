<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.completed}}</span>  {{ language.jobs }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{language.job}}</th>
                        <th>{{language.status}}</th>
                        <th>{{language.bid_amount}}</th>
                        <th>{{language.rating}}</th>
                        <th>{{language.completed_on}}</th>
                         <th>{{language.actions}}</th>

                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(bid, index) in completedbids" :key="index">
                            <td>{{ (index + 1) }}</td>
                            <td>{{ bid.shipment.title }}</td>
                            <td>
                                <span class="badge badge-success text-white">{{ bid.status }}</span>
                            </td>
                            <td><h5 class="font-weight-bold text-dark">€{{ bid.amount }}</h5></td>
                            <td>
                                 <i v-for="item in bid.dreview.rating" :key="item"  class="fa fa-star text-warning"></i>
                            </td>
                            <td><span class="date small">{{ moment(bid.updated_at).format('LL') }}</span></td>
                            <td> <a href="#" v-if="bid.dreview.rating =='' && bid.dreview.rating ==0" class="mr-1 bg-secondary text-warning circle-btn" title="Provide Rating" @click.prevent="openReview(bid)"><i class="fa fa-star"></i></a>
                                </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>


        </div>
       <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ language.provide_review }}</h5>
                    <p class="modal-title" id="exampleModalLabel">{{ language.shipment }} #<span id="ship_id"></span></p>
                    <input type="hidden" id="review_id">
                </div>
                <div class="modal-body">
                    <div>
                        <p class="text-black-50 font-weight-bold mb-2">{{ language.provide_rating_to }} <span id="ship_name"></span></p>
                        <Rating  :grade="0" :maxStars="5" :hasCounter="true" />
                    </div>
                   
                   <div class="form-group mt-4">
                       <p class="text-black-50 font-weight-bold mb-2">{{ language.enter_review }}</p>
                       <textarea rows="3" class="form-control" :placeholder="language.enter_review_placeholder" v-model="formData.review"></textarea>
                   </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="close">{{ language.close }}</button>
                    <button type="button" class="btn btn-success" @click="submit">{{ language.submit }}</button>
                </div>
            </div>
        </div>
    </div>

        <Pagination :pagination="pagination" route="transporter/dashboard/completedjobs" :fetch="getCompletedBids" />
        <Review :data="shipment" :language="language"/>
  </div>



</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
import Review from '../common/DriverReview';
import Rating from '../common/DriverStarRating';
import Pagination from '../common/Pagination';

export default {
  //   name: 'Rating',
//  props: ['grade', 'maxStars', 'hasCounter'],
    components: { Pagination,Rating,Review },
    data() {
        return {
            language: require(`../language/${$lang}/completedjobs.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            moment,
            formData: {},
            bid: {},           
            shipment: {},
              review: '',
         //     stars: this.grade,
        
        }
    },
    computed: {
        ...mapGetters("bid", ['completedbids', 'pagination', 'errors']),
        ...mapGetters("shipment", ["rating"]),
    },
    mounted() {
        
    },
    methods: {
        ...mapActions("bid", ["getCompletedBids"]),
         ...mapActions("shipment", ['addDriverReview']),
      
         async init() {
            let resp = await this.getCompletedBids(this.page);
        },
       
       close(){
            $('#reviewModal').modal('hide');
        },
        async submit(){
            this.formData.rating = this.rating;
            this.formData.review = this.formData.review;
            this.formData.review_id = $("#review_id").val();
            await Swals.dialog(
                'Are You Sure?',
                'This Will Add Shipment Review!',
                'Yes, Continue',
                'Updated',
                'Shipment Reviewed Successfully.',
                this.addDriverReview,
                this.formData
            );
            $('#reviewModal').modal('hide');
             this.getCompletedBids(this.page);
           // this.$router.push('/transporter/dashboard/completedjobs');
        } ,
    openReview(bid) {
          $("#review_id").val(bid.dreview.id);
          $("#ship_id").text(bid.shipment.id);
          $("#ship_name").text(bid.shipment.title);
            $('#reviewModal').modal('show');
            this.bid = bid;
        }
    }
}
</script>

<style>
.date{
    color: #b7b7b7;
}
</style>