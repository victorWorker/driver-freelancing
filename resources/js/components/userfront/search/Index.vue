<template>
<div class="vue-container">
    <!--- Find Box -->
    <div class="container-fluid find p-0 secondarybg">
        <div class="container yellobigbox paddedcontainer">
            <div class="row">
                <div class="col-md-3 d-flex searchinfo">
                    <i class="fas fa-search"></i>
                    <div class="ps-2">
                        <h2 class="fw-bold primaryboldfont mb-0 uppercase">{{ language.search }}</h2>
                        <h2 class="primarylightfont uppercase">{{ language.shipments }}</h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="inputs d-flex justify-content-between">
                        <div class="inputcontainer d-flex flex-column bg-white">
                            <label>{{ language.pickup }}</label>
                            <GmapAutocomplete
                                @place_changed='setCollectionPlace'
                                :placeholder="language.pickup_placeholder"
                            />
                        </div>
                        <div class="inputcontainer d-flex flex-column bg-white">
                            <label>{{ language.delivery }}</label>
                            <GmapAutocomplete
                                @place_changed='setDeliveryPlace'
                                :placeholder="language.delivery_placeholder"
                            />
                        </div>
                    </div>
                    <div class="tags my-3">
                        <span class="badge bg-secondary me-2" v-for="(filter,index) in mock" :key="index">{{filter}}  
                            <a href="#" @click.prevent="removeFilter(index,filter)">x</a>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-md extrabg text-white findbtn primaryboldfont uppercase" @click="search({filters:filters,form:form,page:page})">{{ language.find_button }} </button>
                </div>
            </div>
        </div> 
    </div>
    <!--- Find Box -->

    <!--- Actual Page -->
    <div class="container-fluid">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="filter">
                        <div class="head d-flex">
                            <i class="fas fa-filter fs-4 me-2"></i>
                            <h1 class="primaryboldfont fs-4 uppercase">{{ language.filters }}</h1>
                        </div>
                        <div class="navibox mt-5 mb-4">
                            <div class="main extrabg d-flex px-3 py-2 justify-content-between align-items-center" @click="showHide(1)">
                                <div>
                                    <h3 class="mb-0 primaryheavyfont fs-5 text-white uppercase">{{ language.categories }}</h3>
                                    <p class="mb-0 text-white">{{ language.vehicles_boats_haulage }}</p>
                                </div>
                                <i class="fas fa-sort-down text-white"></i>
                            </div>
                            <ul class="drop" v-if="current === 1">
                                <li class="mb-2" v-for="(category,index) in categories" :key="index">
                                    <a href="#"  @click.prevent="addFilter('category_id',category.id,category.title)">
                                        <i :class="category.icon"></i>
                                        {{category.title}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="navibox mb-4">
                            <div class="main extrabg d-flex px-3 py-2 justify-content-between align-items-center" @click="showHide(2)">
                                <div>
                                    <h3 class="mb-0 primaryheavyfont fs-5 text-white uppercase">{{ language.weight }}</h3>
                                    <p class="mb-0 text-white">{{ language.all_weights }}</p>
                                </div>
                                <i class="fas fa-sort-down text-white"></i>
                            </div>
                            <ul class="drop" v-if="current === 2">
                                <li class="mb-2">
                                    <a href="#" @click.prevent="addFilter('delivery_size','S')">
                                        <i class="fas fa-car"></i>
                                        {{ language.small }}
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" @click.prevent="addFilter('delivery_size','M')">
                                        <i class="fas fa-car"></i>
                                         {{ language.medium }}
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" @click.prevent="addFilter('delivery_size','L')">
                                        <i class="fas fa-car"></i>
                                         {{ language.large }}
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" @click.prevent="addFilter('weight','XL')">
                                        <i class="fas fa-car"></i>
                                         {{ language.xlarge }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="navibox mb-4 ">
                            <div class="main extrabg d-flex px-3 py-2 justify-content-between align-items-center" @click="showHide(3)">
                                <div>
                                    <h3 class="mb-0 primaryheavyfont fs-5 text-white uppercase">{{ language.location_type }}</h3>
                                    <p class="mb-0 text-white">{{ language.all_location_types }}</p>
                                </div>
                                <i class="fas fa-sort-down text-white"></i>
                            </div>
                            <ul class="drop" v-if="current === 3">
                                <li class="mb-2">
                                    <a href="#" @click.prevent="addFilter('location','cities')">
                                        <i class="fas fa-car"></i>
                                        {{ language.city }}
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a href="#" @click.prevent="addFilter('location','countries')">
                                        <i class="fas fa-car"></i>
                                        {{ language.country }}
                                    </a>
                                </li>
                                <li class="mb-2" @click.prevent="addFilter('location','near')">
                                    <a href="#">
                                        <i class="fas fa-car"></i>
                                        {{ language.near }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="columnhead d-flex justify-content-between mb-4">
                        <h5>{{ language.displaying }} {{pagination.per_page}} {{ language.of }} {{pagination.total}} {{ language.shipments }}</h5>
                        <p><span class="uppercase">{{ language.page }}</span>: <span class="secondarycolor">{{pagination.current_page}} {{ language.of }} {{pagination.last_page}}</span></p>
                    </div>
                    <div v-if="loading" class="d-flex align-items-center justify-content-center flex-column">
                        <img :src="baseURL+'images/loading.gif'" />
                        <p>Loading...</p>
                    </div>
                    <div class="listingcontainer d-flex align-items-center mb-4" v-for="(listing,index) in listings" :key="index" v-else>
                        <div class="col-md-3">
                            <img v-if="listing.image != null" :src="baseURL+'shipments/'+listing.image"  class="w-75 listimg"/>
                            <img v-else :src="baseURL+'images/nia.jpg'" class="w-75 listimg"/>
                            <!-- <img class="w-75 listimg" :src="`${baseURL}images/demo.jpg`"> -->
                        </div>
                        <div class="col-md-7 information">
                            <router-link :to="`/shipment/${listing.id}`"><h1 class="primaryboldfont">{{listing.title}}  
                                </h1></router-link>

                            <p><b> Lances totais: {{listing.bidcount}} </b></p>
                            <div class="infobox d-flex">
                                <i class="fas fa-map-marker-alt me-2 extracolor"></i>
                                <p class="mb-0">{{ language.collection }}: {{listing.collection}}</p>
                            </div>
                            <div class="infobox d-flex">
                                <i class="fas fa-map-marker-alt me-2 secondarycolor"></i>
                                <p>{{ language.delivery }}:  {{listing.delivery}}</p>
                            </div>
                            <span class="badge bg-secondary">
                                <i class="fas fa-calendar-week"></i>
                                {{moment(listing.created_at).format('DD MMMM YYYY')}}
                            </span>
                        </div>
                        <div class="col-md-2 d-flex flex-column align-items-end">
                            <h1 class="primaryheavyfont lh-1 mb-0">{{ getintval(listing.distance) }}</h1>
                            <p class="mb-0">KM</p>
                        </div>
                    </div>
     
                    <SPagination :pagination="spagination" route="search" :fetch="search" :filters="filters" :form="form" v-if="form.collection" :setloading="setloading" :unsetloading="unsetloading" />
                    <Pagination :pagination="pagination" route="search" :fetch="getListings" :setloading="setloading" :unsetloading="unsetloading" v-else />

                    
                </div>
            </div>
        </div>
    </div>
    
    <!--- Actual Page -->
</div>
</template>

<script>
import moment from 'moment';
import {mapActions, mapGetters} from 'vuex';
import Pagination from '../common/Pagination';
import SPagination from '../common/SPagination';
export default {
    components:{
        Pagination,
        SPagination
    },
    data() {
        return {
            loading:false,
            moment,
            baseURL,
            current:1,
            page: (this.$route.
            query.page == undefined) ? 1 : this.$route.query.page,
            filters: {
                category_id:[],
                delivery_size:[],
                location:[]
            },
            mock:[],
            form:{},
            total_bids:'',
            language: require(`../language/${$lang}/search.json`),
        }
    },
    computed: {
        ...mapGetters("front", ['listings','pagination','spagination','categories']),
    },
    mounted(){
        this.getCategories();
        this.init();
    },
    methods:{
        ...mapActions("front", ["getListings","getCategories", "search"]),
        setloading(){
            this.loading = true;
        },
        getBids(ev){
            axios.get('/enduser/bids/count/'+ev)
                .then((response)=>{
                return response.data;
            })
        },
        async init() {
                //alert();
                // axios.get('/enduser/bids/count')
                //      .then((response)=>{
                //         this.total_bids=response.data;
                // })
        },
        getintval(value){
        if(value !=""){
         return parseInt(value);
         }
        else{
                 return 0;
            }
        },
        unsetloading(){
            this.loading = false;
        },
        showHide(id){
            if(this.current === id){
                this.current = 0;
            }else{
                this.current = id;
            }
        },
        addFilter(primary, menu){
            if(!this.duplicate(menu, primary)){
                if(primary === "category_id"){
                    let cat = this.categories.find(category => category.id == menu)
                    this.mock.push(cat.title);
                    this.filters[primary].push(cat.id);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Filter has been added to search',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }else{
                    this.mock.push(menu);
                    this.filters[primary].push(menu);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Filter has been added to search',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
                
            }
            
        },
        removeFilter(index,menu){
            this.mock = this.mock.filter( (item,key) => {
                return key !== index;
            })
            
            if(this.filters.category_id.includes(menu)){
                this.filters.category_id = this.filters.category_id.filter( (item,key) => {
                    return item !== menu;
                })
            }else if(this.filters.delivery_size.includes(menu)){
                this.filters.delivery_size = this.filters.delivery_size.filter( (item,key) => {
                    return item !== menu;
                })
            }else if(this.filters.location.includes(menu)){
                this.filters.location = this.filters.location.filter( (item,key) => {
                    return item !== menu;
                })
            }else{
                let cat = this.categories.find(category => category.title == menu)
                this.filters.category_id = this.filters.category_id.filter( (item,key) => {
                    return item !== cat.id;
                })
            }
        },
        duplicate(menu,primary){
            if(primary === "category_id"){
                let cat = this.categories.find(category => category.id == menu)
                return this.mock.some((item,key) => {
                    return item === cat.title
                });
            }else{
                return this.mock.some((item,key) => {
                    return item === menu
                });
            }
            
        },
        setCollectionPlace(place){
            this.form.collection = place.formatted_address;
        },
        setDeliveryPlace(place){
            this.form.delivery = place.formatted_address;
        },
        initsearch(){
            
            
        }
    },
    
    

}
</script>
<style scoped>
    .pagination-holder{
        display: flex;
        justify-content: flex-end;
        margin-top: 7rem;
    }
    .main{
        cursor: pointer;
    }
    .tags a{
        text-decoration: none;
        color:white;
    }
    @media (max-width: 576px) {
        .yellobigbox{
            /* margin-top: 4.5rem; */
        }
        .listingcontainer{
            flex-direction: column;
            text-align: center;
            border: 1px solid #e5e5e5;
            border-radius: 7px;
            padding:2.5rem 0rem 2.5rem 0rem;
        }
        .listingcontainer .information{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .listingcontainer .information h1{
            margin-top:1rem;
        }
        .listingcontainer .information .badge{
            margin-bottom: 10px;;
        }
    }
    .searchinfo h2{
        font-size: 1.7rem !important;
    }
    .navibox h3 {
        font-size: 1.0rem !important;
    }
    .navibox p {
        font-size: 0.85rem;
    }
</style>
