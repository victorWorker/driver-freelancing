<template>
    <div>
    <!-- First modal dialog -->
        <div class="modal fade" id="ship1" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-0 m-0">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="headings mb-4 mb-sm-5 px-5 mt-4 d-flex justify-content-between">
                                    <div class="d-flex text-white">
                                        <i class="fas fa-gavel me-4 text-white fs-2"></i>
                                        <div>
                                            <h1 class="uppercase">{{ language.get }}</h1>
                                            <h2 class="uppercase">{{ language.quotes }}</h2>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="bg-white text-center text-sm-start mb-4 mb-sm-0">
                                <h4 class="bigmargin p-1 uppercase">{{ language.modal_1_title }}</h4>
                            </div>
                            <div class="catsholder bigmargin d-flex flex-wrap mb-5">
                                <div class="fbox" 
                                    data-bs-target="#ship2" 
                                    data-bs-toggle="modal" 
                                    data-bs-dismiss="modal" 
                                    v-for="(category,index) in categories" :key="index" 
                                    @click="setCategory(category.id)">
                                    <i :class="`${category.icon} fs-1`"></i>
                                    <p>{{category.title}}</p>
                                </div>
                            </div>
                            <input type="hidden" name="userid" id="userid" v-model="form.userid">
                            <input type="hidden" name="shipid"  id="shipid" v-model="form.shipid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second modal dialog -->
        <div class="modal fade" id="ship2" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body p-0 m-0">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="headings mb-4 mb-sm-5 px-5 mt-4 d-flex justify-content-between">
                                    <div class="d-flex text-white">
                                        <i class="fas fa-gavel me-4 text-white fs-2"></i>
                                        <div>
                                           <h1 class="uppercase">{{ language.get }}</h1>
                                           <h2 class="uppercase">{{ language.quotes }}</h2>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="bg-white text-center text-sm-start mb-4 mb-sm-0">
                                <h4 class="bigmargin p-1 uppercase">{{ language.modal_2_title }}</h4>
                            </div>
                            <div class="bigmargin mt-5 fixedbox">
                                <div class="inputingroup w-100 bg-white px-3 py-1" style="display:none">
                                    <label class="uppercase">{{ language.what_need_move }}</label>
                                    <input type="text" id="title" :placeholder="language.what_need_move_placeholder" v-model="form.title">
                                </div>
                                <div class="inputingroup w-100 bg-white px-3 py-1">
                                    <label class="uppercase">{{ language.describe_shipment }}</label>
                                    <textarea rows="6" :placeholder="language.describe_shipment_placeholder" v-model="form.description"></textarea>
                                </div>
                                <div class="d-flex justify-content-between bg-white" >
                                    <div class="inputingroup w-46 px-3 py-1" >
                                        <label>{{ language.collection_location }}</label>
                                        <GmapAutocomplete
                                            @place_changed='setCollectionPlace'
                                            :placeholder="language.collection_location_placeholder" :value="form.collection"
                                        />
                                         <div class='inp-div-2'></div>
                                    </div>
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.delivery_location }}</label>
                                        <GmapAutocomplete
                                            @place_changed='setDeliveryPlace'
                                            :placeholder="language.delivery_location_placeholder" :value="form.delivery"
                                        />
                                    </div>
                                </div>
                                <div class="inputingroup px-3 py-1 w-100 ">
                                    <label>{{ language.preferred_deadline }}</label>
                                    <v-date-picker v-model="form.delivery_date" :input-debounce="500" :masks="masks">
                                        <template v-slot="{ inputValue, inputEvents }">
                                            <input
                                                class="bg-white border px-2 py-1 rounded border-0"
                                                :value="inputValue"
                                                v-on="inputEvents"
                                                :placeholder="language.preferred_deadline_placeholder"
                                                
                                            />
                                        </template>
                                    </v-date-picker>
                                </div>
                                <div class="d-flex justify-content-between bg-white" >
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.email }}</label>
                                        <input type="text" id="email" :placeholder="language.email_placeholder" v-model="form.email">
                                    </div>
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.password }}</label>
                                        <input type="password" id="password_r" :placeholder="language.password_placeholder" v-model="form.password">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between bg-white" >
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.budget }}</label>
                                        <input type="text" :placeholder="language.budget_placeholder" v-model="form.budget">
                                    </div>
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.shipment_size }}</label>
                                        <select class="form-select" aria-label="Default select example" v-model="form.delivery_size">
                                            <option selected>{{ language.shipment_select_1 }}</option>
                                            <option value="S">{{ language.shipment_select_2 }}</option>
                                            <option value="M">{{ language.shipment_select_3 }}</option>
                                            <option value="L">{{ language.shipment_select_4 }}</option>
                                            <option value="XL">{{ language.shipment_select_5 }}</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="yellowbtn w-100 mb-4 uppercase" data-bs-target="#ship3" data-bs-toggle="modal" data-bs-dismiss="modal">{{ language.next_step }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- Second Modal End -->
        <!-- Third modal dialog -->
        <div class="modal fade" id="ship3" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body p-0 m-0">
                        <div class="container-fluid p-sm-0 px-4 pb-5 pb-sm-0">
                            <div class="row">
                                <div class="headings mb-5 px-5 mt-4 d-flex justify-content-between">
                                    <div class="d-flex text-white">
                                        <i class="fas fa-gavel me-4 text-white fs-2"></i>
                                        <div>
                                            <h1 class="uppercase">{{ language.get }}</h1>
                                            <h2 class="uppercase">{{ language.quotes }}</h2>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="bg-white text-center text-sm-start mb-4 mb-sm-0">
                                <h4 class="bigmargin p-1 uppercase">{{ language.modal_3_title }}</h4>
                            </div>
                            <div class="bigmargin mt-5 mx-5 d-flex flex-column align-items-center">
                                <div class="w-50 d-flex flex-column justify-content-center align-items-center">
                                    <img :src="`${url}`" v-if="form.image == undefined || form.image == ''" class="mb-4 imgupld"/>
                                    <img :src="`${baseURL}shipments/${form.image}`" v-else class="mb-4 imgupld"/>
                                    <div class="progress mb-3 w-100">
                                        <div class="progress-bar" role="progressbar" :style="'width:'+progress+'%'" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
                                    </div>
                                    <div class="file-input pb-4 pb-sm-0">
                                        <input type="file" id="file" class="file" @change="uploadImage('#file')">
                                        <label for="file">{{ language.select_file }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4" v-if="loaded">
                                <button class="yellowbtn w-25 mb-4 uppercase" data-bs-target="#ship4" data-bs-toggle="modal" data-bs-dismiss="modal">
                                    {{ language.next_step }}
                                </button>
                            </div>
                            <div class="px-4" v-else>
                                <button class="yellowbtn w-100 mb-4 uppercase" data-bs-target="#ship4" data-bs-toggle="modal" data-bs-dismiss="modal">
                                {{ language.skip_step }}
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- Thord Modal End -->
        <!-- Fourth modal dialog -->
        <div class="modal fade" id="ship4" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body p-0 m-0">
                        <div class="container-fluid px-4 px-sm-0">
                            <div class="row">
                                <div class="headings mb-5 px-5 mt-4 d-flex justify-content-between">
                                    <div class="d-flex text-white">
                                        <i class="fas fa-gavel me-4 text-white fs-2"></i>
                                        <div>
                                            <h1 class="uppercase">{{ language.get }}</h1>
                                            <h2 class="uppercase">{{ language.quotes }}</h2>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="bg-white text-center text-sm-start mb-4 mb-sm-0">
                                <h4 class="bigmargin p-1 uppercase">{{ language.modal_4_title }}</h4>
                            </div>
                            <div class="bigmargin shadow-holder mt-5 d-flex justify-content-between flex-column flex-sm-row">
                                <div class="w-46 w-70 shadow py-4 px-3 bg-white mb-5 mb-sm-0">
                                    <h2 class="primaryheavyfont fs-4 uppercase"> {{ language.pickup }} <span class="primarylightfont">{{ language.point  }}</span></h2>
                                    <div class="inputingroup px-3 py-1 w-100 ">
                                        <label>{{ language.floor }}</label>
                                        <select class="form-select" aria-label="Default select example" v-model="form.pickup_floor">
                                            <option selected>{{ language.floor_select }}</option>
                                            <option v-for="n in 30" :key="n" :value="n">{{n}}</option>
                                        </select>
                                    </div>
                                    <div class="inputingroup px-3 py-1 w-100 ">
                                        <label>{{ language.lift }}</label>
                                        <select class="form-select" aria-label="Default select example" v-model="form.pickup_lift">
                                            <option selected>{{ language.lift_select }}</option>
                                            <option value="1">{{ language.available }}</option>
                                            <option value="0">{{ language.not_available }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-46 w-70 shadow py-4 px-3 bg-white">
                                    <h2 class="primaryheavyfont fs-4 uppercase">{{ language.delivery }} <span class="primarylightfont">{{ (lang == 'pt') ? language.point_d : language.point }}</span></h2>
                                    <div class="inputingroup px-3 py-1 w-100 ">
                                        <label>{{ language.floor }}</label>
                                        <select class="form-select" aria-label="Default select example" v-model="form.delivery_floor">
                                            <option selected>{{ language.floor_select }}</option>
                                            <option v-for="n in 30" :key="n" :value="n">{{n}}</option>
                                        </select>
                                    </div>
                                    <div class="inputingroup px-3 py-1 w-100 ">
                                        <label>{{ language.lift }}</label>
                                        <select class="form-select" aria-label="Default select example" v-model="form.delivery_lift">
                                            <option selected>{{ language.lift_select }}</option>
                                            <option value="1">{{ language.available }}</option>
                                            <option value="0">{{ language.not_available }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5">
                                <button class="yellowbtn w-100 mb-4 uppercase" data-bs-target="#ship5" data-bs-toggle="modal" data-bs-dismiss="modal">
                                    {{ language.next_step }}
                                </button>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Third Modal End-->
        <!-- Second modal dialog -->
        <div class="modal fade" id="ship5" ref="lastmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body p-0 m-0">
                        <div class="container-fluid p-0 px-4 px-sm-0">
                            <div class="row">
                                <div class="headings mb-5 px-5 mt-4 d-flex justify-content-between">
                                    <div class="d-flex text-white">
                                        <i class="fas fa-gavel me-4 text-white fs-2"></i>
                                        <div>
                                            <h1 class="uppercase">{{ language.get }}</h1>
                                            <h2 class="uppercase">{{ language.quotes }}</h2>
                                        </div>
                                    </div>
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="bg-white text-center text-sm-start mb-4 mb-sm-0">
                                <h4 class="bigmargin p-1 uppercase">{{ language.your_information }}</h4>
                            </div>
                            <div class="bigmargin mt-5">
                                <div class="inputingroup w-100 bg-white px-3 py-1">
                                    <label>{{ language.name }}</label>
                                    <input type="text" :placeholder="language.name_placeholder" v-model="form.name">
                                </div>
                                <div class="inputingroup w-100 bg-white px-3 py-1">
                                    <label>{{ language.address }}</label>
                                    <textarea rows="3" :placeholder="language.address_placeholder" v-model="form.address"></textarea>
                                </div>
                                
                                <div class="d-flex justify-content-between bg-white" >
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.state }}</label>
                                        <input type="text" :placeholder="language.state_placeholder" v-model="form.state">
                                    </div>
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.country }}</label>
                                        <input type="text" :placeholder="language.country_placeholder" v-model="form.country">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between bg-white" >
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.phone }}</label>
                                        <input type="text" :placeholder="language.phone_placeholder" v-model="form.phone">
                                    </div>
                                    <div class="inputingroup w-46 px-3 py-1">
                                        <label>{{ language.zip }}</label>
                                        <input type="text" :placeholder="language.zip_placeholder" v-model="form.zip">
                                    </div>
                                </div>
                                <button class="yellowbtn w-100 mb-4 uppercase" @click="submit">{{ language.submit_listing }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- fifth modal -->

        

    </div>
</template>
<script>
import {mapGetters,mapActions,mapState} from 'vuex';
import moment from 'moment';
    export default{
        props: ['cstdata'],
        data(){
            return {
                baseURL,
                loading:false,
                moment:moment,
                form:{
                    phone:this.cstdata.phone,
                    title: this.cstdata.title,
                    email: this.cstdata.email,
                    collection:this.cstdata.collection,
                    delivery:this.cstdata.delivery,
                    password: this.cstdata.password,
                    userid: this.cstdata.userid,
                    shipid: this.cstdata.shipid,
                    distance: this.cstdata.distance,

                    geometry:{
                        collection:{
                            'location': this.cstdata.clocation,
                            'latitude': this.cstdata.clatitude,
                            'longitude': this.cstdata.clongitude,
                        },
                        delivery:{
                            'location': this.cstdata.dlocation,
                            'latitude': this.cstdata.dlatitude,
                            'longitude': this.cstdata.dlongitude,
                        }
                    }
                },
                masks: {
                    input: 'YYYY-MM-DD',
                },
                loaded: false,
                barstart:false,
                language: require(`../language/${$lang}/getquotes.json`),
                lang: $lang,
            }
        },
        computed:{
            ...mapGetters("front", ["categories"]),
            ...mapState("front", ['progress'] ),
            url(){
                return this.baseURL+'images/nia.jpg'
            }
        },
        methods:{
            ...mapActions("front",["getCategories","submitListing","uploadImg", "authLogin"]),
			...mapActions("common",["authLogin"]),
			
			async login() {
			//let loginData = {'email': this.cstdata.email, 'password': this.cstdata.password};
            let resp = await this.authLogin({ email: this.cstdata.email, password: this.cstdata.password});
            if(resp != 'error'){
                //Login user
                localStorage.setItem('token', resp.token);
                localStorage.setItem('userId', resp.user.id);
                localStorage.setItem('userName', resp.user.name);
                localStorage.setItem('userType', resp.user.type);
                localStorage.setItem('userEmail', resp.user.email);
                localStorage.setItem('role', resp.user.type.toLowerCase());
                let url = this.baseURL;
                if(resp.user.type === 'ROOT'){
                    url = url + 'dash';
                }else{
                    url = url + resp.user.type.toLowerCase() + '/dashboard';
                }
                window.location.href = url;
            }else{
                //Display Error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Incorrect Username/Password',
                })
            }
        },
			
			
			
			
            setCategory(category){
                this.form.category_id = category;
            },
            setCollectionPlace(place){
                console.log(place)
                this.form.collection = place.formatted_address;
                this.form.geometry.collection.location = place.geometry.location;
                this.form.geometry.collection.latitude = place.geometry.location.lat();
                this.form.geometry.collection.longitude = place.geometry.location.lng();
                if(this.form.delivery != ""){
                    this.form.distance = this.getDistance(place.geometry.location, this.form.geometry.delivery.location);
                }
            },
            setDeliveryPlace(place){
                console.log(place);
                this.form.delivery = place.formatted_address;
                this.form.geometry.delivery.location = place.geometry.location;
                this.form.geometry.delivery.latitude = place.geometry.location.lat();
                this.form.geometry.delivery.longitude = place.geometry.location.lng();
                console.log('all geo');
                console.log(this.form.geometry);
                if(this.form.collection != ""){
                    this.form.distance = this.getDistance(this.form.geometry.delivery.location, this.form.geometry.collection.location);
                    console.log(this.form.distance);
                }
            },
            getDistance(p1, p2) {
                var R = 6378137; // Earth’s mean radius in meter
                var dLat = this.rad(p2.lat() - p1.lat());
                var dLong = this.rad(p2.lng() - p1.lng());
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(this.rad(p1.lat())) * Math.cos(this.rad(p2.lat())) *
                Math.sin(dLong / 2) * Math.sin(dLong / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c;
                return (d/1000).toFixed(3); // returns the distance in kilo-meter
            },
            rad(x) {
                return x * Math.PI / 180;
            },
            submit(){
                let timerInterval
                Swal.fire({
                    title: 'A carregar o pedido!',
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
                this.loading = true;
                this.form.delivery_date = this.moment(this.form.delivery_date).format('YYYY-MM-DD')
                let loginData = {'email': this.cstdata.email, 'password': this.cstdata.password};
                
                this.submitListing(this.form).then(()=>{
                    var hdnbtn = document.getElementById('hidnform');
                    hdnbtn.click();
                }
                
                ).catch(
                    () => {
                        this.loading = false;
                    }
                );
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                }
            })
                
            },
            uploadImage(id){
                let file = document.querySelector(id).files[0];
                if(file.type.includes('jpg') || file.type.includes('png') || file.type.includes('jpeg')){
                    let reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onloadend = (e) => {
                        this.url = e.target.result
                        this.barstart = true;
                        this.uploadImg(reader.result).then((response) => {
                            this.form.image = response;
                            this.barstart = false;  
                            this.loaded = true; 
                        }).catch(
                            (error) => {
                                console.log(error)
                            }
                        );
                    }; 
                }else{
                    alert('only jpg & png file is allowed')
                }
            
            }
        },

        mounted(){
            this.getCategories();
            this.modal = new bootstrap.Modal(this.$refs.lastmodal);             
        },

        beforeUpdate(){
            $(".pac-container").appendTo($(".inp-div-2"));
            $("body").children(".pac-container").remove();
            $('.pac-container:last').addClass('dorp_cls2');
        }

    }

</script>
<style scoped>
    .modal-body{
        background: url('https://www.buscargo.pt/images/ev.png');
        background-repeat: no-repeat;
        background-size: contain;
        background-position: top;
    }
    .bigmargin{
        margin-left: 95px;
        margin-right:4rem;
    }
    .fbox{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: white;
        padding: 1rem;
        margin-left:16px;
        margin-right:16px;
        border-radius:30px;
        margin-top:20px;
        box-shadow: 0px 0px 14px #d4d4d4;
        cursor: pointer;
        min-width:20%;
        min-height:130px;
    }
    .w-46{
        width: 46% !important;
    }
    .shadow{
        border-radius: 20px;
    }
    .form-select{
        padding:0px 35px 0px 0px !important;
        border:none !important;
    }
    .file {
        opacity: 0;
        width: 0.1px;
        height: 0.1px;
        position: absolute;
    }
    .file-input label {
        display: block;
        position: relative;
        width: 200px;
        height: 50px;
        border-radius: 25px;
        background: linear-gradient(40deg, #ff9224, #c0680e);
        box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: transform .2s ease-out;
    }
    input:hover + label,
    input:focus + label {
        transform: scale(1.02);
    }
    input:focus + label {
        outline: 1px solid #000;
        outline: -webkit-focus-ring-color auto 2px;
    }
    .imgupld{
        border-radius:15px;
        max-width:100%;
    }
    .progress-bar{
        background: #ff9224;
    }
    label {
        text-transform: uppercase !important;
    }
    @media (max-width:550px) {
        .fbox{
            margin-left: 10px !important;
            margin-right: 10px !important;
            width:25%;
            min-height: 100px !important;
            margin-bottom: 28px;
            height:100px;
        }
        .catsholder{
            justify-content: center;
            flex-wrap: wrap;
        }
        .bigmargin{
            margin: 0px !important;
        }
        .fixedbox{
            padding: 0px 25px;
        }
        .w-70{
            width:75% !important;
        }
        .shadow-holder {
            align-items: center;
        }
    }

</style>