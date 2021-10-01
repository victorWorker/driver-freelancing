<template>
  <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="/">
            <img :src="`${baseURL}images/yellowlogo.png`" alt="logo" /> </a>
          <a href="/" class="navbar-brand brand-logo-mini" to="/">
            <img :src="`${baseURL}dashboard/assets/images/logo-mini.svg`" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block">{{ language.help }} : 210 203 206</li>
            <li class="nav-item dropdown language-dropdown">
              <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="d-inline-flex mr-0 mr-md-3">
                  <div class="flag-icon-holder">
                    <i :class="`flag-icon flag-icon-${flag}`"></i>
					
                  </div>
                </div>
                <span class="profile-text font-weight-medium d-none d-md-block" v-if="lang == 'en'">{{ language.en }}</span>
                <span class="profile-text font-weight-medium d-none d-md-block" v-if="lang == 'pt'">{{ language.pt }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                <a href="#" class="dropdown-item" @click.prevent="changeLanguage('en')">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-us"></i>
                  </div>{{ language.en }}
                </a>
                <a href="#" class="dropdown-item" @click.prevent="changeLanguage('pt')">
                  <div class="flag-icon-holder">
                    <i class="flag-icon flag-icon-pt"></i>
                  </div>{{ language.pt }}
                </a>
              </div>
            </li>
          </ul>
          <form class="ml-auto search-form d-none d-md-block" action="#">
            <div class="form-group">
              <!-- <input type="search" class="form-control" placeholder="Search Here"> -->
            </div>
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <!-- <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count">7</span>
              </a> -->
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img :src="`${baseURL}dashboard/assets/images/faces/face10.jpg`" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img :src="`${baseURL}dashboard/assets/images/faces/face12.jpg `" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img :src="`${baseURL}dashboard/assets/images/faces/face1.jpg`" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <router-link 
                v-if="userType === 'TRANSPORTER' || userType === 'USER' " :to="(userType === 'TRANSPORTER') ? '/transporter/dashboard/messages' : '/user/dashboard/messages'" 
                class="nav-link count-indicator" id="notificationDropdown" data-toggle="dropdown">
                <i class="mdi mdi-email-outline"></i>
                <span class="count bg-success" v-if="unreadCount !=  undefined">{{ unreadCount }}</span>
              </router-link>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                  <span class="badge badge-pill badge-primary float-right">View all</span>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-alert m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                    <p class="font-weight-light small-text mb-0"> Just now </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-settings m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                    <p class="font-weight-light small-text mb-0"> Private message </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-airballoon m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                    <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold">{{ userName }}</p>
                  <p class="font-weight-light text-muted mb-0">{{ userEmail }}</p>
                </div>
                <router-link v-if="userType === 'TRANSPORTER' || userType === 'USER' " :to="(userType === 'TRANSPORTER') ? '/transporter/dashboard/myprofile' : '/user/dashboard/myprofile'" 
                            class="dropdown-item">{{ language.profile }}<i class="dropdown-item-icon ti-dashboard"></i></router-link>
                <a href="" heref="" class="dropdown-item" @click.prevent="logout">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" @click="showMenu">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
</template>

<script>
import { mapActions, mapGetters, mapState } from 'vuex';
export default {
    data() {
        return{
            baseURL,
            language: require(`../language/${$lang}/common.json`),
            lang: $lang,
            flag: ($lang == 'en') ? 'us' : 'pt',
            userName,
            userType,
            userEmail
        }
    },
    computed: {
        ...mapGetters("common",["menu"]),
        ...mapGetters("front", ['unreadCount']),
        ...mapGetters("user", ['authUser']),
        
    },
    methods: {

      ...mapActions("common", ['logoutUser','showMenu']),
      ...mapActions("user", ['getAuthUser']),
      ...mapActions("front", ['getUserUnreadCount','getTransporterUnreadCount']),
        changeLanguage(lang) {
          localStorage.setItem('lang', lang);
          window.location.href = window.location.pathname;
        },
        async logout() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Tem a certeza?',
                text: "Irá fazer o logout da sua conta!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, fazer logout',
                cancelButtonText: 'Não, cancelar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    this.logoutUser().then((resp)=> {
                        return resp;
                    }).then((resp)=> {
                        if(resp === 'success') {
                          localStorage.clear();
                          window.location.href= this.baseURL;
                        }
                        swalWithBootstrapButtons.fire(
                            'Logged out!',
                            'Your have been successfully logged out.',
                            'success'
                        )
                    }).catch(() => {
                        console.log('Error in logging out');
                    })
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                   
                }
                })
        },
        
    },
    async mounted() {
        if(this.userType === "USER"){
          await this.getUserUnreadCount();
        }else if(this.userType === "TRANSPORTER"){
          await this.getTransporterUnreadCount();
        }
        
        await this.getAuthUser();
        let vm = this;
        var x = $("#myAudio")[0];

        window.Echo.private("general."+vm.authUser.id)
                .listen(".general.event",  async e => {
                  if(this.userType === "TRANSPORTER"){
                      await vm.getTransporterUnreadCount();
                      x.play();
                  }else if(this.userType === "USER"){
                      await vm.getUserUnreadCount();
                      x.play();
                  }
                  
        })       
    }
}
</script>

<style>

</style>
