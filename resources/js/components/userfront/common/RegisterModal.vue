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
                                    <!-- <input type="text" :placeholder="language.vehicle"> -->
                                    <select name="vehicle" id="">
                                        <option value="">Carrinha gigante</option>
                                        <option value="">Carrinha grande</option>
                                        <option value="">van média</option>
                                        <option value="">Van pequena</option>
                                        <option value="">carro</option>
                                        <option value="">motocicleta</option>
                                    </select>
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.vehiclePrice }}</label>
                                    <input type="text" :placeholder="language.vehiclePrice">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.serviceLocation }}</label>
                                    <input type="text" :placeholder="language.serviceLocation">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.serviceRate }}(USD/KM)</label>
                                    <input type="text" :placeholder="language.serviceRate">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.favoriteZone }}</label>
                                    <input type="text" :placeholder="language.favoriteZone">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.favoriteZonePrice }}</label>
                                    <input type="text" :placeholder="language.favoriteZonePrice">
                                </div>
                            </div>
                            <div class="step3" v-if="formStep == 2">
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.lookingJobs }}</label>
                                    <b-form-select
                                        :options="transports"
                                    />
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.helperable }}</label>
                                    <input type="checkbox">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.helperPrice }}</label>
                                    <input type="text" :placeholder="language.helperPrice">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.workDays }}</label>
                                    <input type="text" :placeholder="language.workDays">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.weekendPrice }}</label>
                                    <input type="text" :placeholder="language.weekendPrice">
                                    
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.urgentworkAble }}</label>
                                    <input type="checkbox">
                                </div>
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.urgentworkPrice }}</label>
                                    <input type="text" :placeholder="language.urgentworkPrice">
                                </div>
                            </div>
                            <div class="step3" v-if="formStep == 3">
                                <div class="inputingroup">
                                    <label class="uppercase">{{ language.bidText }}</label>
                                    <textarea :placeholder="language.bidText" rows="4"></textarea>
                                </div>
                            </div>
                            
                            <button class="yellowbtn w-25 mb-4 uppercase" v-if="formStep == finalStep" @click.prevent="registerTransporter">{{ language.register }}</button>
                            <button class="bluebtn w-25 mb-4 uppercase" v-else @click="nextStep">{{ language.next }}</button>
                            
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
            modal: () => {},
            language: require(`../language/${$lang}/register.json`),
            finalStep: 3,
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
        this.modal = new bootstrap.Modal(this.$refs.vuemodal)
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