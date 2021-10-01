<template>
  <div class="modal fade brand-modal" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="headings mb-5 mt-4 uppercase">
                                <h1>{{ language.signin }}</h1>
                                <h2>{{ language.to_your }}</h2>
                            </div>
                            <button type="button" class="btn-close d-sm-none" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row flex-column mt-5">
                            <div class="inputingroup">
                                <label class="uppercase">{{ language.email }}</label>
                                <input type="text" v-model="email" :placeholder="language.email_placeholder">
                            </div>
                            <div class="inputingroup">
                                <label class="uppercase">{{ language.password }}</label>
                                <input type="password"  v-model="password" :placeholder="language.password_placeholder">
                            </div>
                            <button :disabled="loading" class="yellowbtn w-25 mt-5 mb-4 uppercase" @click="login()">
                                <div v-if="loading" class="spinner-border spinner-border-sm text-light mr-1" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div v-else>{{ language.login }}</div> 
                            </button>
                            <a href="/forgot-password" class="mb-5">{{ language.forgot_password }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import loginMixin from "../../../mixins/login"
export default {
    mixins: [loginMixin],
    data() {
        return {
            email: '',
            password: '',
            language: require(`../language/${$lang}/register.json`),
            modal: () => {},
        }
    },
    mounted() {
        this.modal = new bootstrap.Modal(this.$refs.vuemodal)
    },
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