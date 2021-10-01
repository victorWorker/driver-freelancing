<template>
    <div class="modal" id="SelectRole" ref="rolemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-0 m-0">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="headings mb-sm-5 mb-1 px-5 mt-4 d-flex justify-content-between">
                                    <div class="d-flex text-white">
                                        <!-- <i class="fas fa-gavel me-4 text-white fs-2"></i> -->
                                        <div class="ms-0 ms-sm-5">
                                            <h1>BUS</h1>
                                            <h2>CARGO</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white">
                                <h4 class="bigmargin p-1 mobileheading">PLEASE SELECT YOUR ROLE</h4>
                            </div>
                            <div class="bigmargin mt-5 d-flex justify-content-between rolebox">
                                <a class="w-46 shadow py-4 px-3 bg-white d-flex flex-column align-items-center" href="#" @click.prevent="selectrole('user')">
                                    <i class="fas fa-user-friends fs5rem"></i>
                                    <h3 class="primaryheavyfont">Consumer</h3>
                                    <p class="primarylightfont">Access Site as Consumer</p>
                                </a>
                                <a class="w-46 shadow py-4 px-3 bg-white d-flex flex-column align-items-center" href="#" @click.prevent="selectrole('transporter')">
                                    <i class="fas fa-shuttle-van fs5rem"></i>
                                    <h3 class="primaryheavyfont">Transporter</h3>
                                    <p class="primarylightfont">Access Site as Transporter</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    props:['remount','role'],
    data(){
        return{
            modal: () => {}
        }
    },
    methods:{
        selectrole(role){
            localStorage.setItem("role", role)
            this.modal.hide();
            window.location.reload();
        }
    },
    mounted(){
        if(localStorage.getItem('role') == null){
            this.modal = new bootstrap.Modal(this.$refs.rolemodal);
            this.modal.hide();
        }else{
            this.modal = new bootstrap.Modal(this.$refs.rolemodal);
        }
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
    }
    .w-46{
        width: 46% !important;
        margin-bottom:5rem;
        text-decoration: none;
        color:rgb(51, 51, 51);
    }
    .shadow{
        border-radius: 20px;
    }
    .form-select{
        padding:0px 35px 0px 0px !important;
        border:none !important;
    }
    .fs5rem{
        font-size:5rem;
    }
    @media (max-width: 576px) {
        .bigmargin{
            margin-left: 1.5rem;
            margin-right: 1.5rem;
        }
        .rolebox p{
            text-align: center;
        }   
        .mobileheading{
            margin: 0rem 2rem 0rem 2rem;
        }
    }
</style>