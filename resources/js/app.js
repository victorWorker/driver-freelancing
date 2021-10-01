require('./bootstrap');
// require('./assetnew/css/styles.min.css');
// require('./assetnew/css/magnific-popup.css');
// require('./assetnew/css/aos.css');
import * as bootstrap from 'bootstrap';
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap/dist/css/bootstrap.css'
import Swal from 'sweetalert2';
import VueScreenSize from 'vue-screen-size'
window.Vue = require('vue');
window.Swal = Swal;
window.bootstrap = bootstrap;

import VCalendar from 'v-calendar';
Vue.use(VCalendar);

import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueScreenSize)
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBJ4J2G7btoA72YPSJ2MwBDQde0PTGIjYQ',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
 
    //// If you want to set the version, you can do so:
    // v: '3.26',
  },
 
  //// If you intend to programmatically custom event listener code
  //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
  //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
  //// you might need to turn this on.
  // autobindAllEvents: false,
 
  //// If you want to manually install components, e.g.
  //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
  //// Vue.component('GmapMarker', GmapMarker)
  //// then disable the following:
  // installComponents: true,
});


window.baseURL = "http://localhost:8000/"; // https://www.buscargo.pt/
// window.baseURL = "https://www.buscargo.pt/"; 
window.$ = require('jquery');
window.$lang = (localStorage.getItem('lang') !== null) ? localStorage.getItem('lang') : 'pt';
window.userRole = (localStorage.getItem('role') !== null) ? localStorage.getItem('role') : 'N/A';
window.userName = (localStorage.getItem('userName') !== null) ? localStorage.getItem('userName') : 'N/A';
window.userType = (localStorage.getItem('userType') !== null) ? localStorage.getItem('userType') : 'N/A';
window.userEmail = (localStorage.getItem('userEmail') !== null) ? localStorage.getItem('userEmail') : 'N/A';
window.token = (localStorage.getItem('token') !== null) ? localStorage.getItem('token') : 'N/A';
console.log('from outisde', window.token)

import store from './store';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

let routes = [
    { path: '/', component: require('./components/userfront/home/DriverIndex.vue').default },
    // { path: '/test-page', component: require('./components/userfront/home/TestDriverIndex.vue').default },
    { path: '/test-page-2', component: require('./components/userfront/home/TestDriverIndex.vue').default },
    { path: '/test-page-3', component: require('./components/userfront/home/TestDriverIndex3.vue').default },
    // { path: '/next', component: require('./components/userfront/home/nextstep.vue').default },
    { path: '/consumer', component: require('./components/userfront/home/ConsumerIndex.vue').default },
    { path: '/newsection', component: require('./components/userfront/common/Newsection.vue').default },
    {path: '/how-it-works', component: require('./components/userfront/works/Index.vue').default},
    {path: '/login', name: "login", component: require('./components/userfront/home/DriverIndex.vue').default},
    {path: '/search', component: require('./components/userfront/search/Index.vue').default},
    {path: '/help', component: require('./components/userfront/help/Index.vue').default},
    {path: '/aboutus', component: require('./components/userfront/aboutus/Index.vue').default},
    {path: '/shipment/:id', component: require('./components/userfront/shipment/Index.vue').default},
    {path: '/profile/transporter/:id', component: require('./components/userfront/transporter/Profile.vue').default},
    { path: '/forgot-password', component: require('./components/userfront/fpass/ForgetPassword.vue').default },
    { path: '/reset-password/:id', component: require('./components/userfront/reset/index.vue').default },

    {path: '/dash', name: 'dashboard', component: require('./components/dashboard/home/Index.vue').default},
    {path: '/dash/users', name: 'users', component: require('./components/dashboard/users/Index.vue').default},
    { path: '/dash/users/view/:id', name: 'user', component: require('./components/dashboard/users/View.vue').default },
    { path: '/dash/users/add/:id', name: 'dash_user', component: require('./components/dashboard/users/add.vue').default },
    {path: '/dash/transporters', name: 'transporters', component: require('./components/dashboard/transporters/Index.vue').default},
    {path: '/dash/transporters/nodocument', name: 'dash_transporters', component: require('./components/dashboard/transporters/NotCompleteDocuments.vue').default},
    {path: '/dash/transporters/sendsms', name: 'dash_transporters', component: require('./components/dashboard/transporters/SendsmsTransporters.vue').default},
    {path: '/dash/transporters/view/:id', name: 'transporter', component: require('./components/dashboard/transporters/View.vue').default},
    {path: '/dash/transporters/documents/view/:id', name: 'verify_transporter', component: require('./components/dashboard/transporters/ViewDocuments.vue').default},
    {path: '/dash/shipments', name: 'shipments', component: require('./components/dashboard/shipments/Index.vue').default},
    {path: '/dash/shipments/view/:id', name: 'shipment', component: require('./components/dashboard/shipments/View.vue').default},
    {path: '/dash/shipments/view/bidlist/:id', name: 'shipment_bids', component: require('./components/dashboard/shipments/ShipmentBids.vue').default},
    {
        name: 'showclients',
        path: '/dash/shipments/view/client/:id/',
        component: require('./components/dashboard/shipments/ClientList.vue').default
    },
    {
        name: 'showdriver',
        path: '/dash/shipments/view/driver/:id/',
        component: require('./components/dashboard/shipments/DriverList.vue').default
    },
    {
        name: 'showbid',
        path: '/transporters/view/showbid/:id/',
        component: require('./components/frontdash/show_bids/Index.vue').default
    },
    // {
    //     name: 'showbid',
    //     path: '/showbid/:id/',
    //     component: require('./components/frontdash/show_bids/Index.vue').default
    // },


    {path: '/dash/jobs', name: 'jobs', component: require('./components/dashboard/jobs/Index.vue').default},
    {path: '/dash/expiredjobs', name: 'expired_jobs', component: require('./components/dashboard/jobs/ExpiredJobs.vue').default},
    {path: '/dash/jobs/view/bidlist/:id', name: 'dash_jobs', component: require('./components/dashboard/jobs/JobBids.vue').default},

    {path: '/dash/email', name: 'emails', component: require('./components/dashboard/custom_email/Index.vue').default},
    {path: '/dash/transactions', name: 'transactions', component: require('./components/dashboard/transactions/Index.vue').default},

    {path: '/dash/settings/categories', name: 'categories', component: require('./components/dashboard/settings/Categories.vue').default},

    {path: '/transporter/dashboard/myprofile', name: 'transporter_profile', component: require('./components/frontdash/myprofile/Index.vue').default},
    {path: '/transporter/dashboard/messages', name: 'messages', component: require('./components/frontdash/messaging/Index.vue').default},
    {path: '/transporter/dashboard/guia/:id', name: 'guia', component: require('./components/frontdash/guia/Index.vue').default},
    {path: '/transporter/dashboard/verify', name: 'trans_verify', component: require('./components/frontdash/verify/Index.vue').default},
    {path: '/transporter/dashboard/subscribe', name: 'trans_subscribe', component: require('./components/frontdash/subscribe/Index.vue').default},
    {path: '/transporter/dashboard', name: 'trans_dash', component: require('./components/frontdash/home/Index.vue').default},
     {path: '/transporter/dashboard/oubids', name: 'trans_oubids', component: require('./components/frontdash/oubids/Index.vue').default},
    {path: '/transporter/dashboard/openbids', name: 'trans_openbids', component: require('./components/frontdash/open_bids/Index.vue').default},
    {path: '/transporter/dashboard/awardedbids', name: 'trans_awardedbids', component: require('./components/frontdash/awarded_bids/Index.vue').default},
    {path: '/transporter/dashboard/expiredbids', name: 'trans_expiredbids', component: require('./components/frontdash/expired_bids/Index.vue').default},
    {path: '/transporter/dashboard/completedjobs', name: 'trans_completedbids', component: require('./components/frontdash/completed_jobs/Index.vue').default},

    {path: '/user/dashboard/myprofile', name: 'user_profile', component: require('./components/frontdash/myprofile/Index.vue').default},
    {path: '/user/dashboard', name: 'user_dash', component: require('./components/frontdash/userhome/Index.vue').default},
    {path: '/user/dashboard/redirect', name: 'user_dash', component: require('./components/frontdash/userhome/Index.vue').default},
    {path: '/user/dashboard/messages', name: 'user_messages', component: require('./components/frontdash/usermessaging/Index.vue').default},
    {path: '/user/dashboard/newshipment', name: 'user_new_shipment', component: require('./components/frontdash/new_shipment/Index.vue').default},
    {path: '/user/dashboard/openshipments', name: 'user_openshipments', component: require('./components/frontdash/open_shipments/Index.vue').default},
    {path: '/user/dashboard/awardedshipments', name: 'user_awardedshipments', component: require('./components/frontdash/awarded_shipments/Index.vue').default},
    {path: '/user/dashboard/completedshipments', name: 'user_completedshipments', component: require('./components/frontdash/completed_shipments/Index.vue').default},
    {path: '/user/dashboard/expiredshipments', name: 'user_expiredshipments', component: require('./components/frontdash/expired_shipments/Index.vue').default},
    {path: '/user/dashboard/shipment/view/:id', name: 'user_viewshipment', component: require('./components/frontdash/open_shipments/ViewShipment.vue').default},
    {path: '/user/dashboard/bidlist/view/:id', name: 'user_viewbidlist', component: require('./components/frontdash/open_shipments/BidList.vue').default},
    {path: '/user/dashboard/bid/award/:id', name: 'user_awardbid', component: require('./components/frontdash/open_shipments/AwardBid.vue').default},
];

Vue.component('site-header', require('./components/userfront/common/Header.vue').default);
Vue.component('site-footer', require('./components/userfront/common/Footer.vue').default);
Vue.component('mobile-menu-an', require('./components/userfront/common/MobileMenu.vue').default);
// Vue.component('site-role', require('./components/userfront/common/SelectRole.vue').default);
Vue.component('site-reg-modal', require('./components/userfront/common/RegisterModal.vue').default);
Vue.component('site-login-modal', require('./components/userfront/common/LoginModal.vue').default);
Vue.component('login-screen', require('./components/userfront/common/LoginScreen.vue').default);

Vue.component('dashboard-sec-nav', require('./components/dashboard/common/SecNav.vue').default);
Vue.component('dashboard-main-nav', require('./components/dashboard/common/MainNav.vue').default);

Vue.component('front-dashboard-sec-nav', require('./components/frontdash/common/SecNav.vue').default);
Vue.component('front-dashboard-main-nav', require('./components/frontdash/common/MainNav.vue').default);


window.Swals = {
    dialog(title, text, confirmText, successTitle, successMsg, callback, callbackParams) {
        return new Promise((resolve, reject) => { 
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmText
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let resp = await callback(callbackParams);
                    if(resp == 'success'){
                        Swal.fire(
                            successTitle,
                            successMsg,
                            'success'
                        );
                        resolve('success');
                    }else{
                        Swal.fire(
                            'Error',
                            'Something went wrong!',
                            'error'
                        )
                        reject('error');
                    }
     
                }
            })
        });
    },
    dialog1(title, text,  confirmText, cancelText, successTitle, successMsg, callback, callbackParams) {
        return new Promise((resolve, reject) => { 
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmText, 
                cancelButtonText: cancelText,
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let resp = await callback(callbackParams);
                    if(resp == 'success'){
                        Swal.fire(
                            successTitle,
                            successMsg,
                            'success'
                        );
                        resolve('success');
                    }else{
                        Swal.fire(
                            'Error',
                            'Something went wrong!',
                            'error'
                        )
                        reject('error');
                    }
     
                }
            })
        });
    },
    toast(message, type) {
        Swal.fire({
            position: 'top-end',
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 1500
        });
    },
    message(title, message, type) {
        Swal.fire(title, message, type);
    }
}

export const router = new VueRouter({
    mode: 'history',
    routes,
    scrollBehavior() {
        document.getElementById('app').scrollIntoView();
    } 
});


const containerHandle = (remove = false) => {
    const parent = document.getElementById('appContent');
    if (!parent) return;
    remove ? parent.classList?.remove("container") : parent.classList?.add("container");
}

// Guarding
router.beforeEach(async (to, from, next) => {
    const token = localStorage.getItem('token');
    console.log('token', token);
    let resourceRole = to.path.split('/')[1];
    const strictRoles = ['user', 'transporter', 'dash']
    if (token) {
        try {
            const response = await axios.get(`${baseURL}api/user`, { headers: { Authorization: `Bearer ${token}`, Accept: 'application/json' } })
            store.dispatch('common/tokenAlreadyInBrowser');
            store.dispatch('user/setAuthUser', response.data);
            let type = response.data.type.toLowerCase();
            let pathPart = (type == 'root') ? 'dash' : type;
            console.log('path part',pathPart);
            if(resourceRole != pathPart && strictRoles.includes(resourceRole)) {
                window.location.href = baseURL;
            }
            strictRoles.includes(resourceRole) ? containerHandle() : containerHandle(true)
            next()
        } catch {
            localStorage.clear()
            window.location.href = baseURL;
        }
    } else {
        containerHandle(true)
        if (strictRoles.includes(resourceRole)) {
            console.log('Reached in Hemant Else');
             window.location.href = baseURL;
        } else {
            next();
        }
    }
});

router.afterEach(() => {
    const toggleBtn = document.getElementsByClassName('navbar-toggler')
    const nav = document.getElementById("navbarText")
    if(toggleBtn.length && !nav.classList?.contains("show")) return;
    toggleBtn[0] && toggleBtn[0].click()
})



 const app = new Vue({
    el: '#app',
    router,
    store,
    mounted(){
        console.log(router.currentRoute.path)
    }
});
