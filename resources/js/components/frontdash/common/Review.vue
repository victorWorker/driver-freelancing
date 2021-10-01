<template>
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex';
import Rating from './StarRating';
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
        ...mapActions("shipment", ['addReview']),
        close(){
            $('#reviewModal').modal('hide');
        },
        async submit(){
            this.data.rating = this.rating;
            this.data.review = this.review;
            let resp = await this.addReview(this.data);
             if(resp === 'error') {
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swals.message('Error', errors, 'error');
            }else {
                if(Swals.toast(this.language.shipment_reviewed_succesfully, 'success')){ 
                
                    $('#reviewModal').modal('hide');
                    this.$router.push('/user/dashboard/completedshipments'); 
                }
            }
        }
    }
}
</script>
