<template>
    <div class="container-fluid">
        <div class="row">
            <audio id="myAudio">
                <source :src="baseURL+'assets/notification.mp3'" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
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
                        v-for="(subject,index) in subjects" :key="index" v-on:click="connect(subject)">
                        <img class="rounded-pill" :src="baseURL+'dashboard/assets/images/faces/face8.jpg'" width="50px" height="50px" >
                        <div class="textholder px-3">
                            <h3 class="titlepg">{{subject.title.substring(0,18)}}<span v-if="subject.title.length > 18">...</span></h3>
                            <p class="mb-0">{{ subject.user.name }}</p>
                        </div>
                        <p class="mb-0 mr-2">08:45 AM 
                             <router-link :to='{name:"showbid",params:{id:subject.shipment_id}}' class="btn btn-success">{{subject.checkaward[0] && subject.checkaward[0].status}}</router-link>
                        </p>
                        <span class="badge badge-pill badge-success">{{subject.count}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8 p-0" v-if="subject_id !== null">
                <div class="name d-flex px-3 py-3 m-0">
                    <img class="rounded-pill mr-3" :src="baseURL+'dashboard/assets/images/faces/face8.jpg'" width="50px" height="50px" >
                    <div>
                        <h1 class="fs-2 m-0 font-weight-bold" v-if="messages[0] !== undefined">{{messages[0].from_user.name}}</h1>
                        <p class="m-0" style="font-size:12px">{{ current.title }}</p>
                    </div>
                    <i @click="back" aria-hidden="true" class="fas fa-caret-right" style="font-size: 35px;margin-left:auto;text-align:left"></i>
                </div>

                <div class="messages px-3">
                    <div class="message d-flex" :class="(message.from_id !== authUser.id) ? 'message d-flex' : 'message d-flex flex-row-reverse'"         
                        v-for="(message,index) in messages" :key="index" >
                        <img :class="(message.from_id !== authUser.id) ? 'rounded-pill mr-3' : 'rounded-pill ml-3'" 
                            :src="baseURL+'dashboard/assets/images/faces/face8.jpg'" width="50px" height="50px" >
                        <div>
                            <div class="msgtextbox px-4 py-3 rounded-pill">
                                {{message.message}}
                            </div>
                            <p class="text-right">{{moment(message.created_at).format('LLL')}}</p>
                        </div>
                    </div>
                </div>

                <div class="typemsg px-3">

                    <textarea v-if="subjectstatus=='AWARDED'" type="text" :placeholder="language.message_placeholder" rows="2" class="bg-transparent border-0 form-control w-75" v-model="form.messagebody" v-on:keyup.enter="sendMessage"></textarea>
                    <textarea v-if="subjectstatus!=='AWARDED'" type="text" :placeholder="language.message_placeholder" rows="2" class="bg-transparent border-0 form-control w-75" v-model="form.messagebody"></textarea>

                    <i class="fas fa-paper-plane" v-if="subjectstatus=='AWARDED'" v-on:click="sendMessage"></i>
                    <i class="fas fa-paper-plane" v-if="subjectstatus!=='AWARDED' && subjectaddedd_by=='driver' && checksendbyclient>0" v-on:click="sendMessage"></i>

                    <i class="fas fa-paper-plane" v-if="subjectstatus!=='AWARDED' && subjectaddedd_by=='driver' && checksendbyclient==0" v-on:click="addmessageModal()"></i>

                    <i class="fas fa-paper-plane" v-if="subjectstatus!=='AWARDED' && subjectaddedd_by!=='driver'" v-on:click="sendMessage"></i>
                    
                </div>
            </div>

            <!--message modal start-->
            <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                        <button type="button" class="close" @click.prevent="closemessageModal">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <div class="form-group">
                        <label   style="border:1px solid gray;padding: 10px;"  :class="{ active : active_el == 1 }" for="no" @click.prevent="getmessage(language.question1,1)">{{language.question1}}</label><br>
                        <label  style="border:1px solid gray;padding: 10px;" :class="{ active : active_el == 2 }" for="no" @click.prevent="getmessage(language.question2,2)">{{language.question2}}</label><br>
                        <label style="border:1px solid gray;padding: 10px;"  :class="{ active : active_el == 3 }" for="no" @click.prevent="getmessage(language.question3,3)">{{language.question3}}</label><br>
                        <label style="border:1px solid gray;padding: 10px;"  :class="{ active : active_el == 4 }" for="no" @click.prevent="getmessage(language.question4,4)">{{language.question4}}</label><br>
                        <label style="border:1px solid gray;padding: 10px;"  :class="{ active : active_el == 5 }" for="no" @click.prevent="getmessage(language.question5,5)">{{language.question5}}</label><br>
                        <label style="border:1px solid gray;padding: 10px;"   :class="{ active : active_el == 6 }" for="no" @click.prevent="getmessage(language.question6,6)">{{language.question6}}</label><br>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="sendPresetMessage" class="btn btn-primary">Send Message</button>
                    </div>
                    </div>
                </div>
            </div>
            <!--message modal close-->
        </div>

    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
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
                shipment_id:'',
                
            },
            premessage:{
                to_id: '',
                subject_id:'',
                messagebody:'',
                shipment_id:'',
            },
            current:{},
            subjectstatus:'',
            subjectaddedd_by:'',
            checksendbyclient:'',
            active_el:0,
            showsubjects:true,
            updateMessageInterval: null,
        }
    },
    computed:{
        ...mapGetters('front',["subjects","messages","showall"]),
        ...mapGetters('user',["authUser"]),
    },
    methods:{
        ...mapActions('front',["getSubjects","getMessages","send","markTransporterMessagesRead"]),
        async connect(subject){
            if(this.$vssWidth < 560){
                this.showsubjects = false;
            }


            window.Echo.leave('chat.'+this.subject_id);
            var x = document.getElementById("myAudio");
            let vm = this;
            this.subject_id = subject.id;
            this.current = subject;
            this.subjectstatus = subject.checkaward[0]?.status;
            this.subjectaddedd_by=subject.addedd_by;
            this.checksendbyclient=subject.checksendbyclient;

            await this.getMessages(subject);
            await this.markTransporterMessagesRead(subject.id);
            await this.markTransporterMessagesRead(subject.id);
            var objDiv = document.querySelector(".messages");
            objDiv.scrollTop = objDiv.scrollHeight
            window.Echo.private("chat."+subject.id)
            .listen('.message.event', async e => {
                // console.log(e);
                await vm.getMessages(subject);
                await vm.markTransporterMessagesRead(subject.id);
                objDiv.scrollTop = objDiv.scrollHeight
                if(vm.authUser.id === e.message.to_id){
                    x.play();
                }
                
                
            })
        },
        addmessageModal(){
            $('#messageModal').modal('show');
        },
        closemessageModal(data){
            $('#messageModal').modal('hide');
        },
        getmessage(msg,el){
            this.active_el = el;
            this.premessage.messagebody=msg;
        },
        back(){
            this.subject_id = null
            this.showsubjects = true
        },
        async sendMessage(){
            //alert();
            this.form.to_id = this.current.user_id
            this.form.subject_id =  this.subject_id
            this.form.shipment_id = this.current.shipment_id
            let responsed=await this.send(this.form)
             console.log(responsed)
            this.form.messagebody = ''
        },

        async sendPresetMessage(){
            this.premessage.to_id = this.current.user_id
            this.premessage.subject_id =  this.subject_id
            this.premessage.shipment_id = this.current.shipment_id
            await this.send(this.premessage)
            $('#messageModal').modal('hide');
            this.premessage.messagebody = ''
        }
    },
    async mounted(){
        let self = this;
        await this.getSubjects();
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
        this.updateMessageInterval = setInterval(async function () {
            await self.getMessages(self.current);
            console.log('This is messages',messages);
        }, 3000);
        
    },
    destroyed() {
        window.Echo.leave('chat.'+this.subject_id);
        clearTimeout(this.updateMessageInterval)
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
    @media (max-width: 570px){
        .messages{
            height: calc(100vh - 284px);
        }
    }
</style>
