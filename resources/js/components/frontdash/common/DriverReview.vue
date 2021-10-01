<template>
    <!-- <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" v-if="data.awarded != undefined">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ language.provide_review }}</h5>
                    <p class="modal-title" id="exampleModalLabel">{{ language.shipment }} #{{ data.id }}</p>
                </div>
                <div class="modal-body">
                    <div>
                        <p class="text-black-50 font-weight-bold mb-2">{{ language.provide_rating_to }} {{ data.awarded.name }}</p>
                        <Rating :grade="0" :maxStars="5" :hasCounter="true" />
                    </div>
                   
                   <div class="form-group mt-4">
                       <p class="text-black-50 font-weight-bold mb-2">{{ language.enter_review }}</p>
                       <textarea rows="3" class="form-control" :placeholder="language.enter_review_placeholder" v-model="review"></textarea>
                   </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="close">{{ language.close }}</button>
                    <button type="button" class="btn btn-success" @click="submit">{{ language.submit }}</button>
                </div>
            </div>
        </div>
    </div> -->
      
</template>
<script>
import {mapActions, mapGetters} from 'vuex';
import Rating from './DriverStarRating';
export default {
    props:['data', 'language'],
    components: { Rating },
    data() {
        return {
            review: ''
        }
    },
    computed: {
        ...mapGetters("shipment", ["rating"])
    },
    methods:{
        ...mapActions("shipment", ['addDriverReview']),
        close(){
            $('#reviewModal1').modal('hide');
        },
        async submit(){
            this.data.rating = this.rating;
            this.data.review = this.review;
            await Swals.dialog(
                'Are You Sure?',
                'This Will Add Shipment Review!',
                'Yes, Continue',
                'Updated',
                'Shipment Reviewed Successfully.',
                this.addDriverReview,
                this.data
            );
            $('#reviewModal').modal('hide');
            this.$router.push('/transporter/dashboard/completedjobs');
        }
    }
}
</script>
