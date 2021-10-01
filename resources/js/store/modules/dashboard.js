import dashboard from '../../Api/dashboard';

const state = {
    transDashData: [],
    userDashData: [],
}

const getters = {
    transDashData: (state) => state.transDashData,
    userDashData: (state) => state.userDashData,
}

const actions = {
    getTransDashData: ({commit}) => {
        return new Promise((resolve, reject) => {
            dashboard.loadtransdashdata().then((data) => {
                commit('SET_TRANS_DASH', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getUserDashData: ({commit}) => {
        return new Promise((resolve, reject) => {
            dashboard.loaduserdashdata().then((data) => {
                commit('SET_USER_DASH', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
}

const mutations = {
    SET_TRANS_DASH: (state, data) => state.transDashData = data,
    SET_USER_DASH: (state, data) => state.userDashData = data,
    PAGINATION: (state, pagination) => state.pagination = pagination,
    ERRORS: (state, errors) => state.errors = errors
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}