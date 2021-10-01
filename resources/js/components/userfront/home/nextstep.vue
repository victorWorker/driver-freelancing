<template>
             <section class="section" style="background: #ff9224;">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12 top-50 top-lg-0">
                        <div class="form-wrapper">

                              <div class="col-sm-12">
                                 <h4>Item Description</h4>
                              </div>
                              <div class="row">
                                 <div class="col-sm-12">
                                    <input class="form__field" type="text" name="title" placeholder="WHAT_YOU_NEED_TO_MOVE(WHAT_YOU_NEED_TO_MOVE_PLACEHOLDER)">
                                 </div>
                                 <div class="col-12">
                                    <textarea class="form__field form__message" name="description" placeholder="DESCRIBE_YOUR_SHIPMENT (DESCRIBE_YOUR_SHIPMENT_PLACEHOLDER)"></textarea>
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="date" name="delivery_date" placeholder="PREFERRED_DELIVERY_DEADLINE">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="email" name="email" placeholder="EMAIL">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="password" name="password" placeholder="PASSWORD">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="budget" placeholder="BUDGET">
                                 </div>
                                 <div class="col-sm-12">
                                    <select class="form__select" name="delivery_size" style="display: none;">
                                       <option data-display="SHIPMENT_SIZE">IS_LIFT_AVIALBLE</option>
                                       <option value="S" data-display="SMALL">SMALL</option>
                                       <option value="M" data-display="MEDIUM">MEDIUM</option>
                                       <option value="L" data-display="LARGE">LARGE</option>
                                       <option value="XL" data-display="EXTRA_BI">EXTRA_BI</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-12 top-50">
                                    <h4>Upload Image</h4>
                                 </div>
                                 <div class="col-sm-6">
                                    <input type="file" name="image">
                                 </div>
                                 <div class="col-sm-12 top-50">
                                    <h4>Specification of Location</h4>
                                 </div>
                                 <div class="col-sm-6">
                                    <select class="form__select" name="pickup_floor" style="display: none;">
                                        <option data-display="Delivery Point"></option>
                                       <option value="1">1</option>
                                       <option value="2">2</option>
                                       <option value="3">3</option>
                                       <option value="4">4</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-6">
                                    <select class="form__select" name="delivery_floor" style="display: none;">
                                       <option data-display="Delivery Point"></option>
                                       <option value="1">1</option>
                                       <option value="2">2</option>
                                       <option value="3">3</option>
                                       <option value="4">4</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-6">
                                    <select class="form__select" name="pickup_lift" style="display: none;">
                                       <option data-display="ELEVATOR">Elevator Present?</option>
                                       <option value="2">Available</option>
                                       <option value="3">Out of stock</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-6">
                                    <select class="form__select" name="delivery_lift" style="display: none;">
                                       <option data-display="ELEVATOR">Elevator Present?</option>
                                       <option value="2">Available</option>
                                       <option value="3">Out of stock</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-12 top-50">
                                    <h4>Delivery Information</h4>
                                 </div>
                                 <div class="col-sm-12">
                                    <input class="form__field" type="text" name="name" placeholder="Enter Name">
                                 </div>
                                 <div class="col-12">
                                    <textarea class="form__field form__message" name="address" placeholder="Enter Address"></textarea>
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="country" placeholder="Enter State">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="parents" placeholder="Enter country">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="phone" placeholder="Enter Phone">
                                 </div>
                                 <div class="col-sm-6">
                                    <input class="form__field" type="text" name="zip" placeholder="Enter ZIP">
                                 </div>
                                 <div class="col-12">
                                    <button class="quote-form__submit">SUBMIT_LISTINGS</button>
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
</template>


<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    components:{
        Shipment,
        Testimonials
        
    },
    data() {
        return {
            transport: '',
            from: '', 
            to: '',
            baseURL,
            lang: $lang,
            language: require(`../language/${$lang}/home.json`),
        }
    },
     methods: {
        ...mapActions('front', [ 'requestdata' ]),
        async saveDetails() {
            console.log({transport:this.transport,from:this.from,to:this.to})
            if(this.transport!="" && this.from!="" && this.to!=""){
               let resp = await this.requestdata({transport:this.transport,from:this.from,to:this.to});
                console.log(resp);
                Swals.toast('Request added Successfully!', 'success');
                setTimeout(() => {
                    window.location.href="/next/"+resp.data;
                }, 4000);
            }
            else{
                Swals.toast('Please All fields!', 'error');
            }
        }
    }
}
</script>