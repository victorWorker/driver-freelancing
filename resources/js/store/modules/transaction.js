import transaction from '../../Api/transaction';
import shipment from '../../Api/shipment';

const state = {
    transactions: [],
    pagination: {},
    transporterTransactions: {},
    lastSubTransaction: {},
    getloadlastshiptransaction: {},
    loadlastshiptransaction: [],
    transData: {},
    errors: []
}

const getters = {
    transactions: (state) => state.transactions,
    transporterTransactions: (state) => state.transporterTransactions,
    lastSubTransaction: (state) => state.lastSubTransaction,
    getloadlastshiptransaction: (state) => state.getloadlastshiptransaction,
    loadlastshiptransaction: (state) => state.loadlastshiptransaction,
    pagination: (state) => state.pagination,
    transData: (state) => state.transData,
    errors: (state) => state.errors,
}

const actions = {
    getTransactions: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            transaction.loadtransactions(page).then((data) => {
                commit('SET_TRANSACTIONS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    addSubscriptionTransaction: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            transaction.addsubscriptiontransaction(data).then((resp) => {
                commit('SET_TRANS_DATA', resp.data);
                resolve('success');
            }).catch((err)=> {
                resolve('error');
            });
        });
    },
    // approvePayment: ({commit}, id) => {
    //     return new Promise((resolve, reject) => {
    //         transaction.approvepayment(id).then((response) => {
    //             resolve('success');
    //         }).catch((err) => {
    //         });
    //     });
    // },
     updatePayment: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.updatepayment(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    getTransporterTransactions: ({ commit }, page) => {
        return new Promise((resolve, reject) => {
            transaction.loadtransportertransactions(page).then((data) => {
                commit('SET_TRANSPORTER_TRANSACTIONS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getLastSubscriptionTransactions: ({ commit }) => {
        return new Promise((resolve, reject) => {
            transaction.loadlastsubscriptiontransaction().then((data) => {
                commit('SET_LAST_SUBSCRIPTION_TRANSACTIONS', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },

    loadlastshiptransaction: ({ commit }) => {
        return new Promise((resolve, reject) => {
            transaction.loadlastshiptransactioGET().then((data) => {
                console.log(data);
                commit('SET_LAST_SHIP_TRANSACTIONS', data.data);
                resolve(data.data);
            }).catch((err) => {
                reject('error');
            });
        });
    },

    confirmPayPalPayment: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            transaction.confirmpaypalpayment(data).then((resp) => {
                commit('SET_TRANS_DATA', resp.data);
                resolve('success');
            }).catch((err)=> {
                resolve('error');
            });
        });
    },
    checkMultibancoStatus: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            transaction.checkMultibancoStatus(data).then((resp) => {
                commit('SET_TRANS_DATA', resp.data);
                resolve('success');
            }).catch((err)=> {
                resolve('error');
            });
        });
    }
}

const mutations = {
    SET_TRANSACTIONS: (state, transactions) => state.transactions = transactions,
    SET_TRANSPORTER_TRANSACTIONS: (state, transactions) => state.transporterTransactions = transactions,
    SET_LAST_SUBSCRIPTION_TRANSACTIONS: (state, transaction) => state.lastSubTransaction = transaction,
    SET_LAST_SHIP_TRANSACTIONS: (state, getloadlastshiptransaction) => state.getloadlastshiptransaction = getloadlastshiptransaction,
    SET_TRANS_DATA: (state, data) => state.transData = data,
    PAGINATION: (state, pagination) => state.pagination = pagination,
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}