<template>
  <div class="modal fade brand-modal" ref="vuemodal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row headrow">
                            <div class="headings mb-5 mt-4 uppercase">
                                <h1>{{ language.register }}</h1>
                                <h2>{{ language.new_account }}</h2>
                            </div>
                            <button type="button" class="btn-close d-sm-none" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row flex-column">
                            <div class="step1" v-if="formStep == 0">
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.name }}</label>
                                    <input type="text" v-model="formData.name" :placeholder="language.name_placeholder">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.email }}</label>
                                    <input type="email" v-model="formData.email" :placeholder="language.email_placeholder">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.password }}</label>
                                    <input type="password" v-model="formData.password" :placeholder="language.password_placeholder">
                                </div>
                                <div class="inputingroup halfinput">
                                    <label class="uppercase">{{ language.phone }}</label>
                                    <input type="tel" v-model="formData.phone" :placeholder="language.phone_placeholder">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.address }}</label>
                                    <textarea :placeholder="language.address_placeholder" v-model="formData.address"></textarea>
                                </div>
                                <div class="inputingroup halfinput">
                                    <label class="uppercase">{{ language.country }}</label>
                                    <input type="text" v-model="formData.country"  :placeholder="language.country_placeholder">
                                </div>


                                <div class="inputingroup halfinput">
                                    <label class="uppercase">{{ language.town }}</label>
                                    <input type="text" v-model="formData.state"  :placeholder="language.town_placeholder">
                                </div>

                                <div class="inputingroup halfinput">
                                    <label class="uppercase">{{ language.zip }}</label>
                                    <input type="text" v-model="formData.zip" :placeholder="language.zip_placeholder">
                                </div>
                            </div>
                            <div class="step2"  v-if="formStep == 1">
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.vehicle }}</label>
                                    <div class="row">
                                        <div class="vihicle-choose">
                                            <input type="radio" name="vantype" v-model="driverData.vehicle" id="biggervan" value="biggervan">
                                            <label for="biggervan" class="ms-2"><i class="fas fa-truck-moving"></i></label>
                                        </div> 
                                        <div class="vihicle-choose">
                                            <input type="radio" name="vantype" v-model="driverData.vehicle" id="bigvan" value="biggervan">
                                            <label for="bigvan" class="ms-2"><i class="fas fa-truck"></i></label>
                                        </div> 
                                        <div class="vihicle-choose">
                                            <input type="radio" name="vantype" v-model="driverData.vehicle" id="mediavan" value="biggervan">
                                            <label for="mediavan" class="ms-2"><i class="fas fa-shuttle-van"></i></label>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="vihicle-choose">
                                            <input type="radio" name="vantype" v-model="driverData.vehicle" id="peqvan" value="biggervan">
                                            <label for="peqvan" class="ms-2"><i class="fas fa-truck-pickup"></i></label>
                                        </div> 
                                        <div class="vihicle-choose">
                                            <input type="radio" name="vantype" v-model="driverData.vehicle" id="car" value="biggervan">
                                            <label for="car" class="ms-2"><i class="fas fa-car-side"></i></label>
                                        </div> 
                                        <div class="vihicle-choose">
                                            <input type="radio" name="vantype" v-model="driverData.vehicle" id="motor" value="biggervan">
                                            <label for="motor" class="ms-2"><i class="fas fa-motorcycle"></i></label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.vehiclePrice }}</label>
                                    <input type="text" v-model="driverData.vehiclePrice" :placeholder="language.vehiclePrice">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.serviceLocation }}</label>
                                    <!-- <input type="text" v-model="driverData.serviceLocation" :placeholder="language.serviceLocation"> -->
                                    <div class="map_view">
                                        <GmapMap :center="{lat: 59.33, lng: 18.26}" :zoom="5" ref="workmap" height="300">
                                            <gmap-circle :editable="true" :center="{lat: 59.33, lng: 18.26}" :radius='10' :draggable="true">
                                            </gmap-circle>
                                        </GmapMap>
                                    </div>
                                    
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.serviceRate }}(USD/KM)</label>
                                    <input type="text" v-model="driverData.serviceRate" :placeholder="language.serviceRate">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.favoriteZone }}</label>
                                    <input type="text" v-model="driverData.favoriteZone" :placeholder="language.favoriteZone">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.favoriteZonePrice }}</label>
                                    <input type="text" v-model="driverData.favoriteZonePrice" :placeholder="language.favoriteZonePrice">
                                </div>
                            </div>
                            <div class="step3" v-if="formStep == 2">
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.lookingJobs }}</label>
                                    <b-form-select
                                        :options="transports"
                                        v-model="driverData.lookingJobs"
                                    />
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.helperable }}</label>
                                    <input type="checkbox" v-model="driverData.helperable">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.helperPricedistance }}</label>
                                    <input type="text" v-model="driverData.helperPrice" :placeholder="language.helperPrice">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.helperPricehourly }}</label>
                                    <input type="text" v-model="driverData.helperPricehourly" :placeholder="language.helperPricehourly">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.workDays }}</label>
                                    <input type="text" v-model="driverData.workDays" :placeholder="language.workDays">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.weekendPrice }}</label>
                                    <input type="text" v-model="driverData.weekendPrice" :placeholder="language.weekendPrice">
                                    
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.urgentworkAble }}</label>
                                    <input type="checkbox" v-model="driverData.urgentworkAble">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.urgentworkPrice }}</label>
                                    <input type="text" v-model="driverData.urgentworkPrice" :placeholder="language.urgentworkPrice">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.unwrapedjobable }}</label>
                                    <input type="checkbox" v-model="driverData.unwrapedjobable" :placeholder="language.unwrapedjobable">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.elevatorable }}</label>
                                    <input type="text" v-model="driverData.elevatorable" :placeholder="language.elevatorable">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.elevatorprice }}</label>
                                    <input type="text" v-model="driverData.elevatorprice" :placeholder="language.elevatorprice">
                                </div>
                            </div>
                            <div class="step3" v-if="formStep == 3">
                                <h4>{{ language.weekform }}</h4>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.spacevehicleDay }}</label>
                                    <input type="text" v-model="driverData.spacevehicleDay" :placeholder="language.spacevehicleDay">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.locationDay }}</label>
                                    <input type="text" v-model="driverData.locationDay" :placeholder="language.locationDay">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.jobsmarkedDay }}</label>
                                    <input type="text" v-model="driverData.jobsmarkedDay" :placeholder="language.jobsmarkedDay">
                                </div>                                
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.tipsjobDay }}</label>
                                    <input type="text" v-model="driverData.tipsjobDay" :placeholder="language.tipsjobDay">
                                </div>                             
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.discountDay }}</label>
                                    <input type="text" v-model="driverData.discountDay" :placeholder="language.discountDay">
                                </div>
                            </div>
                            <div class="step4" v-if="formStep == 4">
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.bidText }}</label>
                                    <textarea v-model="driverData.bidText" :placeholder="language.bidText" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="flex">
                              <button class="blackbtn w-25 mb-4 uppercase" v-if="formStep > 0" @click="prevStep">{{ language.prev }}</button>
                              <button class="yellowbtn w-30 mb-4 uppercase" v-if="formStep == finalStep" @click.prevent="registerTransporter">{{ language.register }}</button>
                              <button class="bluebtn w-25 mb-4 uppercase" v-else @click="nextStep">{{ language.next }}</button>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { BFormSelect } from "bootstrap-vue";
import loginMixin from "../../../mixins/login"
import { mapGetters, mapActions } from 'vuex';
import transports from "../../post-order/data/transports";
export default {
    mixins: [loginMixin],
    data: () => ({
            formStep: 0,
            formData: {
                name: '', email: '', password: '', phone: '', address: '', country: '', state: '', zip: ''
            },
            driverData: {
              vehicle: '',
              vehiclePrice: null,
              serviceLocation: '',
              serviceRate: '',
              favoriteZone: '',
              favoriteZonePrice: '',
              lookingJobs: '',
              helperable: false,
              helperPricedistance: '',
              helperPricehourly: '',
              workDays: '',
              weekendPrice: '',
              urgentworkAble: '',
              urgentworkPrice: '',
              unwrapedjobable: false,
              elevatorable: '',
              elevatorprice: '',
              bidText: ''
            },
            weekform: {
              spacevehicleDay: '',
              locationDay: '',
              jobsmarkedDay: '',
              tipsjobDay: '',
              discountDay: '',
            },
            modal: () => {},
            language: require(`../language/${$lang}/register.json`),
            finalStep: 4,
            transports,
            week: ['mon', 'tue', 'opn'],
    }),
    components:{
        BFormSelect
    },
    computed: {
        ...mapGetters('user', ['errors']),
    },
    mounted() {
        this.modal = new bootstrap.Modal(this.$refs.vuemodal);
        console.log(this.$refs);
    },
    methods: {  
        ...mapActions('user', ['addTransporter']),
        async registerTransporter() {
            let resp = await this.addTransporter(this.formData);
            if(resp === 'error') {
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swal.fire('Error', errors, 'error');
            }else if(resp === 'success') {
                Swal.fire('Success', 'Registration Completed Successfully', 'success');
                this.modal.hide();
                // this.login(this.formData.email, this.formData.password)
            }
        },
        nextStep(){
            if(this.formStep < this.finalStep){
                this.formStep = this.formStep + 1;
            }
            if(this.formStep == 1){
                console.log(this.$refs.workmap);
                this.$nextTick(() => {
                    console.log('this is next tic');
                    // console.log(this.$refs.workmap.$mapObject.data.setControls(['Polygon']));
                    // setTimeout(function() {this.$refs.workmap.$mapObject.data.setControls(['Polygon']);}, 3000);
                })
                // setTimeout(function() {this.$refs.workmap.$mapObject.data.setControls(['Polygon']);}, 3000);
            }
        },
        prevStep(){
            this.formStep = this.formStep - 1;
        },
        namewithOption({text, value}){
            console.log(value);
            return text;
        },
        close() {
           this.modal('hide')
        }
    }
}
</script>

<style scoped>
.vihicle-choose{
    font-size: 45px;
    width: auto;
    margin: auto;
}
.map_view{
    height: 40vh;
    width: 100%;
    position: relative;
}
.vue-map-container{
    height: 40vh;
}
@media (max-width: 576px) {
    .modal-body{
        margin-left:30px;
        background:none;
    }
    .modal-content{
        background: rgb(255,146,36);
        background: linear-gradient(125deg, rgba(255,255,255,1) 54%, rgba(255,146,36,1) 54%);
    }
    .yellowbtn{
        border: 2px solid #fff;
        width: 50% !important;
    }
    .bluebtn{
        border: 2px solid #fff !important;
        background: rgb(58, 36, 255) !important;
        color: white !important;
        width: 25% !important;
    }
    .inputingroup{
        width: 90% !important;
    }
    .headrow{
        display: flex;
        flex-direction: row;
    }
    .headrow .headings{
        width:auto;
    }
    .btn-close{
        align-self: flex-start;
        margin-left: auto;
        margin-top: 30px;
    }
}
</style>