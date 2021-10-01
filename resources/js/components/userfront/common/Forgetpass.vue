<template>
  <div class="modal fade" id="exampleModal11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="headings mb-5 mt-4 uppercase">
                                <h1>{{ language.forgot_password }}</h1>
                            </div>
                            <button type="button" class="btn-close d-sm-none" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row flex-column mt-5">
                            <div class="inputingroup">
                                <label class="uppercase">{{ language.email }}</label>
                                <input type="text" v-model="email" :placeholder="language.email_placeholder">
                            </div>
                            <button class="yellowbtn w-25 mt-5 mb-4 uppercase" @click.prevent="login">{{ language.login }}</button>
                            <a href="/about" class="mb-5">{{ language.forgot_password }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    data() {
        return {
            email: '',
            language: require(`../language/${$lang}/register.json`),
            modal: () => {},
            baseURL,
        }
    },
    computed: {
        ...mapGetters('common', ['errors']),
    },
    mounted() {
        this.modal = new bootstrap.Modal(this.$refs.vuemodal)
    },
    methods: {
        ...mapActions('common', ['authLogin']),
        async login() {
            let resp = await this.authLogin({ email: this.email});
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
    .headings{
        width:auto;
    }
}
</style>