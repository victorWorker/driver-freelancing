<template>
    <div>
        <!--- Listing Info Box -->
        <div class="container-fluid find p-0 extrabgbright">
            <div class="container tpcontainer">

                <div class="row ltrow">

                   <div class="col-8 d-flex align-items-center">

                        <router-link :to="`/profile/transporter/${listing.data.user_id}`" class="text-decoration-none">
                        <img v-if="listing.data.image != null && listing.data.image != ''" :src="baseURL+'shipments/'+listing.data.image"  class="listing-hero me-4"/>
                        <img v-else :src="baseURL+'images/nia.jpg'" class="listing-hero me-4"/>
                        <!-- <img :src="baseURL+'images/demo.jpg'" class="listing-hero me-4"> -->
                         </router-link>
                        <div class="d-flex flex-column">
                         <router-link :to="`/profile/transporter/${listing.data.user_id}`" class="text-decoration-none">
                            <h1 class="primaryboldfont fs-3 text-white mb-4">{{listing.data.title}}</h1>
                             </router-link>
                            <div class="infobox d-flex ">
                                <i class="fas fa-map-marker-alt me-2 text-white mt-1"></i>
                                <p class="text-white m-0">{{ language.collection }}:  {{listing.data.collection}}</p>
                            </div>
                            <div class="infobox d-flex">
                                <i class="fas fa-map-marker-alt me-2 text-white mt-1"></i>
                                <p class="text-white">{{ language.delivery }}:  {{listing.data.delivery}}</p>
                            </div>
                        </div>
                       
                    </div>

                    <div class="col-4 d-flex align-items-center justify-content-end">
                        <button class="btn btn-lg btn-light rounded-pill primaryboldfont blacktext">{{language.active}}</button>
                        <!-- <button class="btn btn-lg btn-light rounded-pill primaryboldfont blacktext">{{listing.data.status}}</button> -->
                    </div>
                </div>
            </div> 
        </div>
        <!--- Listing Info Box -->

        <!--- Actual Page -->
        <div class="container-fluid">
            <div class="container pt-5">
                <div class="row ptrow">
                    <div class="col-md-8">
                        <div class="competitors-box mb-3" v-if="listing.data.competitors !== undefined && listing.data.competitors !== null">
                            <h4 class="fw-lighter">{{ language.uppercontent }}</h4>
                            <div class="comp-box primarylightfont mt-3">
                                <ul class="m-0 p-0">
                                    <li>{{ language.DPD }} will charge €{{ listing.data.competitors.dpd }}</li>
                                    <li>{{ language.FedEx }} will charge €{{ listing.data.competitors.fedex }}</li>
                                    <li>{{ language.LocalDriver }} will charge €{{ listing.data.competitors.local }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="shadow-lg p-4 rounded" v-if="listing.data.status === 'AWARDED'">
                            <div class="topline d-flex justify-content-between">
                                <div class="awardbox d-flex">
                                    <img v-if="listing.awarded.image != null" :src="baseURL+listing.awarded.image" width="100px" class="rounded-pill me-4"/>
                                    <img v-else :src="baseURL+'images/nia.jpg'" width="100px" class="rounded-pill me-4"/>
                                    <div>
                                        <h1 class="m-0 fs-5">{{listing.awarded.name}}</h1>
                                        <h3 class="m-0 fs-5 fw-lighter text-black-50">@transporter1</h3>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardandamount d-flex flex-column">
                                    <div class="d-flex">
                                        <i class="fas fa-award fs-2 me-3"></i>
                                        <div>
                                            <h4 class="m-0 lh-1 fs-6 fw-bolder">AWARDED</h4>
                                            <p class="m-0 lh-1 fs-6">BID</p>
                                        </div>
                                    </div>
                                    <div class="fw-bolder secondarybg align-self-end mt-3 text-right rounded-start">
                                        <p class="m-0 text-right text-end fs-5 p-2 text-white fw-lighter">€ <span class="fw-bolder">{{listing.awardedbid.amount}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3">{{listing.awardedbid.proposal}}</p>
                        </div>

                        <div class="headofbid mt-5 mb-4" v-if="token !== null && listing.mybid !== null">
                            <h1 class="fw-bolder primaryheavyfont">YOUR <span class="primarylightfont">BID</span></h1>
                        </div>
                        
                        <div class="shadow-lg p-4 rounded" v-if="token !== null && listing.mybid !== null">
                            <div class="topline d-flex justify-content-between">
                                <div class="awardbox d-flex">
                                    <img :src="baseURL+'images/user.jpg'" width="100px" class="rounded-pill me-4" v-if="listing.mybid.transporter.profileimage === null">
                                    <img :src="baseURL+'storage/images/user/'+listing.mybid.transporter.profileimage" width="100px" class="rounded-pill me-4" v-else>
                                    <div>
                                        <h1 class="m-0 fs-5">{{listing.mybid.transporter.name}}</h1>
                                        <h3 class="m-0 fs-5 fw-lighter text-black-50">@transporter1</h3>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardandamount d-flex flex-column">
                                    <div class="fw-bolder secondarybg align-self-end mt-3 text-right rounded-start">
                                        <p class="m-0 text-right text-end fs-5 p-2 text-white fw-lighter">€ <span class="fw-bolder">{{listing.mybid.amount}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3">{{listing.mybid.proposal}}</p>
                        </div>
                        <div class="headofbid mt-4 mb-4" >
                            <div class="d-flex flex-column">
                                <h1 class="primaryboldfont fs-3 mb-4">DESCRIPTION</h1>
                                <div class="infobox d-flex ">
                                    
                                    <p class="m-0"> {{listing.data.description}}</p>
                                </div>
                                
                            </div>
                      </div>
                        <div class="headofbid mt-4 mb-4" v-if="token !== null && userType === 'TRANSPORTER'">
                            <h1 class="fw-bolder primaryheavyfont">OTHER <span class="primarylightfont uppercase">{{ language.bids }}</span></h1>
                        </div>
                        <div class="headofbid mt-8 mb-4" v-else>
                            <h1 class="fw-bolder primaryheavyfont"> <span class="primarylightfont uppercase">{{ language.bids }}</span></h1>
                        </div>
                        <!-- <div class="shadow-lg p-4 mb-5 rounded" v-for="(bid, index) in listing.bids" :key="index"> -->
                        <div class="shadow-lg p-4 mb-5 rounded" v-for="(bid, index) in bidsList" :key="index">
                            <div class="topline d-flex justify-content-between">
                                <div class="awardbox d-flex">
                                    <img v-if="bid.transporter.profileimage != null" :src="baseURL+'shipments/'+bid.transporter.profileimage" width="100px" class="rounded-pill me-4"/>
                                    <img v-else :src="baseURL+'images/nia.jpg'" width="100px" class="rounded-pill me-4"/>
                                    <div>
                                        <h1 class="m-0 fs-5"><router-link :to="`/profile/transporter/${bid.transporter.id}`" class="text-decoration-none">{{bid.transporter.name}}</router-link></h1>
                                        <img v-if="bid.transporter.badge != null" :src="baseURL+bid.transporter.badge" width="40px" class="rounded-pill me-4"/>
                                        <h3 class="m-0 fs-7 fw-lighter text-black-50">Expiration : {{bid.expiration}}</h3>
                                        <!-- <div class="rating" v-if="listing.ratings[index] !== 0">
                                            <i v-for="n in 5" :key="n" :class="(listing.ratings[index] >= n) ? 'fas fa-star text-warning' : 'far fa-star'"></i>
                                        </div> -->
                                        <div class="rating" v-if="bid.rating!== 0">
                                            <i v-for="n in 5" :key="n" :class="(bid.rating >= n) ? 'fas fa-star text-warning' : 'far fa-star'"></i>
                                        </div>
                                        <div class="rating" v-else>
                                            <p>New User (Not Rated Yet)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="awardandamount d-flex flex-column">
                                    <div class="recommendedBadge" v-if="index == 0">
                                        <div class="recommendText"> recommended <i class="fas fa-medal"></i> </div>
                                    </div>
                                    <div class="fw-bolder align-self-end mt-3">
                                        <p class="m-0 text-right text-end fs-2 p-2 secondarycolor primarylightfont">€ <span class="primaryheavyfont">{{bid.amount}}</span></p>
                                    </div>
                                    <div v-if="listing.data.user_id == user_id">
                                        <router-link :to="`/user/dashboard/messages?bid_id=${bid.id}&driver_id=${bid.driver_id}&shipment_id=${bid.shipment_id}&shipmentName=${listing.data.title}`">
                                        <button class="btn btn-primary btn-sm text-uppercase fw-bold px-3"><i class="fas fa-comment-dots"></i> Chat</button>
                                        </router-link>
                                        <button class="btn btn-success btn-sm text-uppercase fw-bold px-3" @click="$router.push(`/user/dashboard/bid/award/${bid.id}`)">Award</button>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3">{{bid.proposal}} <a v-if="user_id === bid.driver_id" href="#" class="small text-primary" 
                                    @click.prevent="addBidModal({ id: bid.id, proposal: bid.proposal, amount: bid.amount, expiration: bid.expiration })">
                                    edit
                                </a></p>
                        </div>
                        <!-- <div class="d-flex flex-column justify-content-center align-items-center mb-4 " v-if="listing.bids.length === 0"> -->
                        <div class="d-flex flex-column justify-content-center align-items-center mb-4 " v-if="bidsList.length === 0">
                            <img :src="baseURL+'images/noresults.svg'" class="w-25" />
                            <img :src="baseURL+'images/connecting.gif'" class="w-50"/>
                            <!-- <h1 class="primaryboldfont mt-4 mtcolor"><span class="primarylightfont">{{ language.nobids }}</span></h1> -->
                            <h1 class="primaryboldfont mt-4 mtcolor  text-center"><span class="primarylightfont text-dark uppercase">wait we are contacting our drvier network</span></h1>
                        </div>
                    </div>
                    <div class="col-md-4 ps-5 leftside mb-5">
                        <div class="secondarybg rootbox">
                            <h1 class="primaryheavyfont secondarybg fs-4 py-3 px-4 text-white uppercase">{{ language.project }} <span class="primarylightfont">{{ language.details }}</span></h1>
                            <div class="whitebox bg-white p-4 shadow">
                                <div class="graybox bg-black-50 rounded-3 p-4">
                                    <div class="d-flex flex-column">
                                        <h1 class="fs-1 primaryheavyfont m-0">{{listing.data.distance}}</h1>
                                        <p class="fs-5">KM</p>
                                    </div>
                                    
                                    <div class="infoboxx mb-4">
                                        <p class="m-0">{{ language.date_listed }}</p>
                                        <span class="badge rounded-pill bg-success">{{moment(listing.data.created_at).format('DD MMMM YYYY')}}</span>
                                    </div>
                                    <div class="infoboxx mb-4">
                                        <p class="m-0">{{ language.expires_on }}</p>
                                        <span class="badge rounded-pill bg-danger">{{moment(listing.data.delivery_date).format('DD MMMM YYYY')}}</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p class="fs-4 m-0">{{ language.budget }}</p>
                                    <p class="text-black-50">€{{listing.data.budget}}</p>
                                </div>
                                <div class="mt-3">
                                    <p class="fs-4 m-0">{{ language.bids }}</p>
                                    <p class="text-black-50">{{listing.bidcount}}</p>
                                </div>
                                <div class="mt-3">
                                    <p class="fs-4 m-0">{{ language.average_bid }}</p>
                                    <p class="text-black-50">€ {{listing.average}}</p>
                                </div>
                            </div>
                            <div class="placebid d-flex justify-content-center py-4 px-3" v-if="userType === 'TRANSPORTER'">
                                <button class="btn btn-lg blackbg w-75 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#placeBid" v-if="token !== null">
                                    <i class="fas fa-gavel me-4 text-white fs-2"></i>
                                    <div class="d-flex flex-column justify-content-start align-items-start text-white">
                                        <!-- <p class="m-0 lh-1">PLACE</p> -->
                                        <p class="m-0 lh-1 fs-6 uppercase">{{ language.putproposal }}</p>  
                                    </div>    
                                </button>
                                <button class="btn btn-lg blackbg w-75 d-flex justify-content-center" v-else>
                                    <i class="fas fa-gavel me-4 text-white fs-2"></i>
                                    <div class="d-flex flex-column justify-content-start align-items-start text-white">
                                        <p class="m-0 lh-1">LOGIN TO</p>  
                                        <p class="m-0 lh-1 fs-6 uppercase">{{ language.bid }}</p>  
                                    </div>    
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
            <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="border-radius:0px !important;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ language.edit_bid }}</h5>
                        <button type="button" class="close" @click.prevent="closeBidModal">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="background:transparent !important;margin-left:0px;">
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
                        <button type="button" @click.prevent="editBid" class="btn btn-primary"> update bid </button>
                    </div>
                    </div>
                </div>
            </div>
        <!--- Actual Page -->
        <PlaceBid :shipment="listing.data.id" />
        <!-- <span>{{listing.data.id}}</span> -->
    </div>
</template>
<script>
import moment from 'moment';
import PlaceBid from '../common/PlaceBid';
import {mapGetters, mapActions} from 'vuex';
export default {
    components:{
        PlaceBid,
    },
    data(){
        return{
            firstPost: false,
            moment,
            baseURL,
            userType,
            bidsList: [],
            user_id:'1',
            token: localStorage.getItem('token'),
            language: require(`../language/${$lang}/listing.json`),
            formData:{},
            sortInterval: null,
        }
    },
    computed:{
        ...mapGetters('front', ['listing']),
        ...mapGetters('user', ['authUser']),
    },
    methods:{
        ...mapActions("front",["getListing","updateBid", "getAutolistings"]),
        async init() {
            let resp = await this.getListing({id:this.$route.params.id,token:this.token});
            if(resp == 'success') {
                this.sortBids();
            }
            this.user_id=this.authUser.id;
            console.log('this ownerUser', this.user_id);
            if(this.listing.bids.length == 0){
                this.firstPost = true;
                // let autoBids = await self.getAutolistings({id:self.$route.params.id,token:self.token});
                // console.log('autoBids', autoBids);
            }
        },
        sortBids () {
            console.log('allthings', this.listing);
            this.bidsList = [];
            this.listing.bids.map((item, index) => {
                console.log(item, index);
                const bidObject = {
                    amount: item.amount,
                    created_at: item.created_at,
                    discount: item.discount,
                    driver_id: item.driver_id,
                    expiration: item.expiration,
                    id: item.id,
                    promoted: item.promoted,
                    proposal: item.proposal,
                    shipment_id: item.shipment_id,
                    status: item.status,
                    subject_id: item.subject_id,
                    transporter: item.transporter,
                    updated_at: item.updated_at,
                    user_id: item.user_id,
                    rating: this.listing.ratings[index],
                };
                this.bidsList.push(bidObject);
                this.bidsList.sort((a,b) => (a.amount < b.amount) ? -1 : ((a.amount < b.amount) ? 1 : 0))
                this.bidsList.sort((a,b) => (a.rating > b.rating) ? -1 : ((b.rating > a.rating) ? 1 : 0))
            })
            console.log('updated',this.bidsList);
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
            
            let resp = await this.updateBid(this.formData);
            if(resp == 'success') {
                Swals.toast('Bid Updated Successfully', 'success');
                // window.location.reload();
            }else{
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swals.message('Error', errors, 'error');
            }
        },
    },
    mounted(){
        this.init();
        let self = this;
        this.sortInterval = setInterval(async function (){ 
            // console.log('pres', self.$route)
            if(self.firstPost == true){
                let autoBids = await self.getAutolistings({id:self.$route.params.id,token:self.token});
                console.log('autoBids', autoBids);
            }
            
            let updatework = await self.getListing({id:self.$route.params.id,token:self.token});
            console.log("Hello", updatework); 
            console.log(self.listing);
            self.sortBids();
            }, 8000);
    },
    beforeDestroy () {
     // clear the timeout before the component is destroyed
     clearTimeout(this.sortInterval)
    }
}
</script>
<style lang="css">
    .mtcolor{
        color: #d1d1d1;
    }
    .mt-8{
        margin-top: 8rem !important;
    }
    .leftside .graybox{
        background-color: #e1e1e1;
    }
    .leftside .whitebox{
        border-radius: 0rem 0rem 2rem 2rem;
    }
    .leftside .rootbox{
        border-radius: 0rem 0rem 2rem 2rem;
    }
    .shadow-lg{
        box-shadow: 0px 1px 6px rgba(0,0,0,0.17) !important;
        border-radius: 15px !important; 
    }
    .comp-box{
        padding: 20px 50px;
        background: #ffdcb9;
        border-radius: 20px;
    }
    .recommendedBadge {
        border-bottom: 12px solid #29b2fe;
        border-left: 25px solid transparent;
        border-top: 12px solid #29b2fe;
        height: 0;
        width: 180px;
        text-align: end;
        align-items: center;
        justify-content: center;
        padding: 0px 5px 0px 0;
        margin-right: -30px;
    }
    .recommendText {
        color: white;
        margin-top: -10px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .btn-chat{
        background-color:#198754; 
        color: white;
    }
    .btn-award{
        background-color:#198754; 
        color: white;
    }
    @media (max-width: 576px) {
        .tpcontainer{
            margin-top:4.5rem;
            padding: 20px 30px 20px 30px;
        }
        .ltrow{
            flex-direction:column;
            align-items:center;
        }
        .ltrow > .col-8{
            flex-direction:column;
            width:90% !important;
        }
        .ltrow > .col-8 h1{
            text-align: center;
            margin-top: 10px;
        }
        .ltrow .infobox{
            justify-content: center;
        }
        .listing-hero{
            margin:0px !important;
        }
        .ptrow{
            flex-direction: column-reverse;
        }
        .ptrow > .leftside{
            padding: 0px 30px 0px 30px !important;
        }
        .topline{
            flex-direction: column;

        }
        .awardandamount {
            margin-top: -40px;
        }
        .awardbox img{
            margin-right:1.2rem;
        }
    }
</style>