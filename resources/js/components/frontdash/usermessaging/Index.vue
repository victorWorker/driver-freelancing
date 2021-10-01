<template>
    <div class="container-fluid">
        <div class="row">
            <audio id="myAudio">
                <source :src="baseURL+'assets/notification.mp3'" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <div class="col-md-12 mt-4"> 
                <p class="alert alert-primary small d-flex justify-content-between align-items-center"> Alerta: Não divulgue o seu contacto telefónico/email com o motorista e não discuta os valores da licitação. A sua conta será automaticamente suspensa ou banida. </p>
            </div>
            <div class="col-md-4 px-3 bgdash text-white projectside" v-if="showsubjects">
                <div class="tophead py-4">
                    <h1 class="font-weight-bolder fs-2">{{ language.messages }}</h1>
                    <div class="searchholder">
                        <!-- <input type="text" class="border-0 bg-transparent text-white" :placeholder="`${language.search}...`" />
                        <i class="fas fa-search"></i> -->
                    </div>
                </div>
                <div class="projectnames">
                    <div class="project d-flex align-items-center py-3" 
                        v-for="(subject,index) in subjects" :key="index" @click="connect(subject)">
                        <img class="rounded-pill" :src="baseURL+'dashboard/assets/images/faces/face8.jpg'" width="45px" height="50px" >
                        <div class="textholder px-3">
                            <h3 class="titlepg">{{subject.title.substring(0,18)}}<span v-if="subject.title.length > 18">...</span></h3>
                            <p class="mb-0">{{ subject.transporter.name }}</p>
                        </div>
                        <p class="mb-0 mr-2">08:45 PM</p>
                        <span class="badge badge-pill badge-success">10</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8 p-0" v-if="subject_id !== null">
                <div class="name d-flex px-3 py-3 m-0">
                    <img class="rounded-pill mr-3" :src="baseURL+'dashboard/assets/images/faces/face8.jpg'" width="50px" height="50px" >
                    <div>
                        <h1 class="fs-2 m-0" v-if="messages[0] !== undefined">{{messages[0].to_user.name}}</h1>
                        <p class="m-0" style="font-size:12px">{{ current.title }}</p>
                    </div>
                    <i @click="back" aria-hidden="true" class="fas fa-caret-right" style="font-size: 35px;margin-left:auto;text-align:left"></i>
                </div>
                <div class="messages px-3">


                    <div :class="(message.from_id !== authUser.id) ? 'message d-flex' : 'message d-flex flex-row-reverse' " 
                          v-for="(message,index) in messages" 
                          :key="index" >
                        <img :class="(message.from_id !== authUser.id) ? 'rounded-pill mr-3' : 'rounded-pill ml-3'" 
                             :src="baseURL+'dashboard/assets/images/faces/face8.jpg'" 
                             width="50px" height="50px" >
                        <div>
                            <div class="msgtextbox px-4 py-3 rounded-pill">
                                {{message.message}}
                            </div>
                            <p class="text-right">{{moment(message.created_at).format('LLL')}}</p>
                        </div>
                    </div>
                </div>
                <div class="typemsg px-3">
                    <textarea type="text" :placeholder="language.message_placeholder" rows="2" class="bg-transparent border-0 form-control w-75" v-model="form.messagebody" v-on:keyup.enter="sendMessage"></textarea>
                    <i class="fas fa-paper-plane" @click="sendMessage"></i>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import moment from 'moment';
import { mapActions, mapGetters } from 'vuex';
import chatSocketMixin from "../../../mixins/chat-socket.js"
export default {
    mixins: [chatSocketMixin],
    data(){
        return {
            moment,
            language: require(`../language/${$lang}/messaging.json`),
            baseURL,
            subject_id:null,
            form:{
                to_id: '',
                subject_id:'',
                messagebody:'',
                shipment_id:''
            },
            current:{},
            showsubjects:true,
            updateChartInterval: null,
        }
    },
    computed:{
        ...mapGetters('front',["subjects","messages"]),
        ...mapGetters('user',["authUser"]),
    },
    methods:{
        ...mapActions('front',["getUserSubjects","getUserMessages","sendUserMessage", "markMessagesRead", "getTransporter"]),
        ...mapActions('shipment', ["addMessageSubject"]),
        async connect(subject){
            if(this.$vssWidth < 560){
                this.showsubjects = false;
            }

            window.Echo.leave('chat.'+this.subject_id);
            var x = document.getElementById("myAudio");
            let vm = this;
            this.subject_id = subject.id;
            this.current = subject;
            await this.getUserMessages(subject);
            await this.markMessagesRead(subject.id);
            var objDiv = document.querySelector(".messages");
            objDiv.scrollTop = objDiv.scrollHeight;
            window.Echo.private("chat."+subject.id)
            .listen('.message.event', async e => {
                await vm.getUserMessages(subject);
                await vm.markMessagesRead(subject.id);
                objDiv.scrollTop = objDiv.scrollHeight;

                if(vm.authUser.id === e.message.to_id){
                    x.play();
                }
                
            })
        },
        async sendMessage(){
            this.form.to_id = this.current.driver_id
            this.form.subject_id =  this.subject_id
            this.form.shipment_id = this.current.shipment_id
            await this.sendUserMessage(this.form);
            this.form.messagebody = '';
        },
        back(){
            this.subject_id = null
            this.showsubjects = true
        },
    },
    async mounted(){
        let self = this;
        await this.getUserSubjects();
        console.log('checker worker', this.$route.query);
        console.log('all users', this.subjects);
        if(this.$route.query.subject_id != undefined) {
            this.subject_id = this.$route.query.subject_id;
            let subject = this.subjects.filter((sub, index) => {
                return sub.id == this.subject_id;
            });
            if(subject.length <= 0){
                Swals.message('Error 404', 'No such subject found', 'error');
                return;
            }else{
                this.connect(subject[0]);
            }    
        }
        if(this.$route.query.bid_id != undefined && this.$route.query.driver_id != undefined && this.$route.query.shipment_id != undefined) {
            const dirverId = this.$route.query.driver_id;
            const shipmentId =  this.$route.query.shipment_id;
            const bidId = this.$route.query.bid_id;
            const shipmentName = this.$route.query.shipmentName;
            let check_subject = this.subjects.filter((sub, index) => {
                return sub.driver_id == dirverId && sub.shipment_id == shipmentId;
            });
            if(check_subject.length <= 0){
                const addNewSubject = {
                    bid_id: bidId,
                    subject: shipmentName,
                    shipment_id: shipmentId,
                    driver_id: dirverId,
                    message: 'Thanks for your interested in my project',
                }
                this.addMessageSubject(addNewSubject);
                await this.getUserSubjects();
                check_subject = this.subjects.filter((sub, index) => {
                    return sub.driver_id == dirverId && sub.shipment_id == shipmentId;
                });
                if(check_subject.length > 0){
                    this.connect(check_subject[0]);    
                }
                // Swals.message('Error 404', 'No such subject found', 'error');
                // return;
            }else{
                this.connect(check_subject[0]);
            }  
            // await this.getTransporter(dirverId);
            this.updateChartInterval = setInterval(async function () {
                console.log(self.subject_id)
                // self.connect(self.subject_id);
                await self.getUserMessages(self.current);
            }, 3000);
        }
    },
    destroyed() {
        window.Echo.leave('chat.'+this.subject_id);
        clearTimeout(this.updateChartInterval)
    }
}
</script>
<style scoped>
    .projectside{
        height: calc(100vh - 116px) !important;
        overflow: scroll;
    }
    .bgdash{
        background:#3051f0;
    }
    .bgdash p{
        color:#eee;
        font-size: 12px;;
    }
    .fs-2{
        font-size: 16px !important;
    }
    .titlepg{
        font-size: 13px;
        font-weight: 900;
    }
    .project{
        border-top: 1px solid rgba(207, 207, 207, 0.2);
        transition: .7s;
    }
    .project:hover{
        background: #ff9224;
        padding: 20px;
        cursor: pointer;
    }
    .name{
        background: #f6f6f6;
        align-items: center;
    }
    .name > p{
        color:#a7a7a7;
    }
    .name > h1{
        font-weight: 900;
    }
    .msgtextbox{
        background: #f2f2f2;
        display: flex;
        align-items: center;
        font-size: 12px;
    }
    .messages{
        overflow: scroll;
        height: calc(100vh - 263px);
    }
    .message p{
        font-size: 10px;
        color: #b7b7b7 !important;
    }
    .typemsg{
        background: #f2f2f2;
        height: 65px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .fa-paper-plane{
        font-size: 30px;
        color:#ff9224;     
    }
    .fa-paper-plane:hover{
        color: #0f25d5;
        font-size: 40px;
        transition: 0.5s;
        cursor: pointer;
    }
</style>
