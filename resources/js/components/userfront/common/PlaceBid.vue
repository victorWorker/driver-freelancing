<template>
    <!-- Modal -->
    <div class="modal fade" ref="bid" id="placeBid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="headings mb-5 mt-4 d-flex justify-content-between">
                                <div class="d-flex">
                                    <i class="fas fa-gavel me-4 text-secondary fs-2"></i>
                                    <div>
                                        <h1>{{ language1.putproposal }}</h1>
                                    </div>
                                </div>
                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row flex-column">
                            <div class="inputingroup bg-white">
                                <label>{{ language.bidamount }}</label>
                                <input type="text" v-model="form.amount" placeholder="Enter your minimum bid amount">
                            </div>
                            <div class="inputingroup bg-white">
                                <label>{{ language.vehicletype }}</label>
                                <select class="form-select border-0" aria-label="Default select example" v-model="form.vehicle">
                                    <option selected>Select Vehicle Type</option>
                                    <option v-for="(vehicle,index) in vehicles" :key="index" :value="vehicle.name">{{vehicle.name}}</option>
                                </select>
                            </div>
                            <div class="inputingroup bg-white">
                                <label>{{ language.expiredate }}</label>
                                <v-date-picker v-model="form.expiry" :input-debounce="500" :masks="masks">
                                    <template v-slot="{ inputValue, inputEvents }">
                                        <input
                                            class="bg-white border px-2 py-1 rounded border-0"
                                            :value="inputValue"
                                            v-on="inputEvents"
                                            placeholder="Enter Expiration Date"
                                            
                                        />
                                    </template>
                                </v-date-picker>
                            </div>
                            <div class="inputingroup bg-white">
                                <label>{{ language.proposal }}</label>
                                <textarea rows="6" type="text" v-model="form.proposal" placeholder="Enter your Proposal"> </textarea>
                            </div>
                            <!-- <input type="hidden" v-model="form.sid" :value="this.shipment"> -->
                            <input type="hidden" v-model="form.sid">
                            <button class="yellowbtn w-25 mb-4" @click="submit">{{ language.submitbid }}</button>
                           <!--  <span>{{this.shipment}}</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
            // form:{sid: this.shipment},
import {mapGetters,mapActions} from 'vuex';
import moment from 'moment';
export default{
    props:['shipment'],
    data(){
        return {
            moment,
            form:{sid: this.shipment},
            date: new Date(),
            masks: {
                input: 'YYYY-MM-DD',
            },
            language: require(`../language/${$lang}/register.json`),
            language1: require(`../language/${$lang}/listing.json`),
            modal: () => {}
        }
    },
    computed:{
        ...mapGetters("front", ["vehicles"])
    },
    methods:{
        ...mapActions("front", ["getVehicles","submitBid"]),
        submit(){
            let timerInterval
            Swal.fire({
                title: 'A submeter licitação!',
                html: 'Aguarde <b></b> milissegundos',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        const content = Swal.getContent()
                        if (content) {
                            const b = content.querySelector('b')
                            if (b) {
                                b.textContent = Swal.getTimerLeft()
                            }
                        }
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                this.form.expiry = this.moment(this.form.expiry).format('YYYY-MM-DD');
                console.log(this.form);
                this.form.sid = this.shipment;
                console.log(this.form);
                this.submitBid(this.form).then( () => {
                    Swal.fire(
                        'Sucesso!',
                        'A sua licitação foi submetida',
                        'success'
                    )
                    this.modal.hide();

                    // location.reload();
                }).catch( (error) => {
                    console.log(error);
                    console.log('Reached in error');
                    Swal.fire(
                        'Error!',
                        'Bid Was Not Placed, Try Again',
                        'error'
                    )   
                }) ;
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
        }
    },
    mounted(){
        this.getVehicles();
        this.modal = new bootstrap.Modal(this.$refs.bid);
    }
}
</script>