import Auth from '../../Api/Auth';

const state = {
    isAuthenticated: false,
    menu: false,
    routes: [
        { title: 'Dashboard', link: '/dash' },
        { title: 'Transporters', link: '/dash/transporters' },
        { title: 'Users', link: '/dash/users' },
        { title:'Shipments', link:'/dash/shipments'},
        { title:'Transactions', link:'/dash/transactions'},
        { title:'Custom Email', link:'/dash/email'},
        { title:'Jobs', link:'/dash/jobs'},
        { title:'Expired Jobs', link:'/dash/expiredjobs'},
        { type: 'multi', title: 'Settings', links: [ 
            { title: 'Categories', link: '/dash/settings/categories' }
        ] },
    ],
    frontRoutes: [
        { title: 'Dashboard', title_pt: "Painel", link: '/transporter/dashboard', role: 'transporter' },
        { title: 'Messages', title_pt: "Mensagens", link: '/transporter/dashboard/messages', role: 'transporter' },
        { title: 'Oubids', title_pt: "Licitações superadas", link: '/transporter/dashboard/oubids', role: 'transporter' },
        { title: 'Open Bids', title_pt: "Licitações Abertas", link: '/transporter/dashboard/openbids', role: 'transporter' },
        { title: 'Awarded Bids', title_pt: "Lances concedidos", link: '/transporter/dashboard/awardedbids', role: 'transporter' },
        { title: 'Expired Bids', title_pt: "Lances expirados", link: '/transporter/dashboard/expiredbids', role: 'transporter' },
        { title: 'Bid Invitations', title_pt: "Convites de lance",link: '/transporter/dashboard/invitations', role: 'transporter' },
        { title: 'Completed Jobs', title_pt: "Trabalhos Concluídos", link: '/transporter/dashboard/completedjobs', role: 'transporter' },

        { title: 'Dashboard', title_pt: "Painel", link: '/user/dashboard', role: 'user' },
        { title: 'Messages', title_pt: "Mensagens", link: '/user/dashboard/messages', role: 'user' },
        { title: 'Open Shipments', title_pt: "Remessas Abertas", link: '/user/dashboard/openshipments', role: 'user' },
        { title: 'Awarded Shipments', title_pt: "Remessas Concedidas", link: '/user/dashboard/awardedshipments', role: 'user' },
        { title: 'Expired Shipments', title_pt: "Remessas Expiradas", link: '/user/dashboard/expiredshipments', role: 'user' },
        { title: 'Completed Shipments', title_pt: "Remessas Concluídas", link: '/user/dashboard/completedshipments', role: 'user' },
    ]
}

const getters = {
    routes: (state) => state.routes,
    frontRoutes: (state) => state.frontRoutes,
    isAuthenticated: (state) => state.isAuthenticated,
    menu:(state) => state.menu
}

const actions = {
    authLogin: ({commit}, data) => {
        commit('SET_LOADING');
        return new Promise((resolve, reject) => {
            Auth.validateuser(data).then((response)=> {
                if(response.data == 'error'){
                    resolve('error');
                }else{
                    commit('LOGIN_USER', response.data);
                    resolve(response.data);
                }
            }).catch(() => {

            });
        });
    },
    tokenAlreadyInBrowser: ({commit}) => {
        commit('SET_LOGIN');
    },
    tokenExpired: ({commit}) => {
        commit('SET_LOGOUT');
    },
    logoutUser: ({commit}) => {
        return new Promise((resolve, reject)=> {
            Auth.logoutuser().then(() => {
                commit('SET_LOGOUT');
                resolve('success');
            }).catch(() => {
                reject('error');
            });
        });
    },
    hideMenu({commit}){
        commit('SET_MENU',false)
    },
    showMenu({commit}){
        commit('SET_MENU',true)
    },
    forgetPassword: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            Auth.forgotpassword(data).then((response) => {
                if (response.data == 'error') {
                    resolve('error');
                } else {
                    commit('FORGET_USER', response.data);
                    resolve(response.data);
                }
            }).catch(() => {
                reject('error');
            });
        });
    },
    resetPassword: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            Auth.resetpassword(data).then((response) => {
                if (response.data == 'error') {
                    resolve('error');
                } else {
                    commit('RESET_USER', response.data);
                    resolve(response.data);
                }
            }).catch(() => {
                reject('error');
            });
        });
    },
   
}

const mutations = {
    LOGIN_USER: (state, token) => { state.token = token; state.isAuthenticated = true;},
    FORGET_USER: (state, token) => { state.isAuthenticated = true; },
    RESET_USER: (state, token) => { state.isAuthenticated = true; },
    SET_LOADING: (state) => { state.loading = true; },
    SET_LOGIN: (state) => { state.isAuthenticated = true },
    SET_LOGOUT: (state) => { 
        localStorage.removeItem('token'); state.isAuthenticated = false  
    },
    SET_MENU: (state, rsp) => state.menu = rsp
}

export default {
    namespaced: true,
    state,
    getters,
    actions, 
    mutations
}
