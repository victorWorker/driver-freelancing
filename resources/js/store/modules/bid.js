import bid from '../../Api/bid';

const state = {
    bidData:[],
    openbids: [],
    oubids: [],
    bidInfo:[],
    bidInfos:[],
    awardedbids: [],
    expiredbids: [],
    completedbids: [],
    shipmentbids: [],
    pagination: {},
    errors: []
}

const getters = {
    bidData:(state) => state.bidData,
    oubids: (state) => state.oubids,
    bidInfo: (state) => state.bidInfo,
    bidInfos: (state) => state.bidInfos,
    openbids: (state) => state.openbids,
    awardedbids: (state) => state.awardedbids,
    expiredbids: (state) => state.expiredbids,
    completedbids: (state) => state.completedbids,
    shipmentbids: (state) => state.shipmentbids,
    pagination: (state) => state.pagination,
    errors: (state) => state.errors,
}

const actions = {
     getOuBids: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            bid.loadtransporteroubids(page).then((data) => {
                commit('SET_OUBIDS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    
    getbidInfo: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            bid.loadbidInfo(id).then((dataq) => {
                commit('SET_BIDINFO', dataq);
               // console.log(dataq);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getbidInfos: ({ commit }, id) => {
        return new Promise((resolve, reject) => {
            bid.loadbidInfos(id).then((dataq) => {
                commit('SET_BIDINFOS', dataq);
                console.log(dataq,"hello this data is comming");
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
     updateOuBid({ commit }, data) {
        return new Promise((resolve, reject)=> {
            bid.updateoubid(data, data.id).then((data)=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    getOpenBids: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            bid.loadtransporteropenbids(page).then((data) => {
                commit('SET_OPEN_BIDS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },

    updateBid({ commit }, data) {
        return new Promise((resolve, reject)=> {
            bid.updatebid(data, data.id).then((data)=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },

    addMessageSubjectbyDriver: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            bid.addMessageSubjectbyDriverurl(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    deleteBid: ({commit}, id) => {
        return new Promise((resolve, reject)=> {
            bid.deletebid(id).then(()=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                reject('error');
            })
        });
    },
    getAwardedBids: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            bid.loadtransporterawardedbids(page).then((data) => {
                commit('SET_AWARDED_BIDS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getExpiredBids: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            bid.loadtransporterexpiredbids(page).then((data) => {
                commit('SET_EXPIRED_BIDS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getCompletedBids: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            bid.loadtransportercompletedbids(page).then((data) => {
                commit('SET_COMPLETED_BIDS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getUserShipmentBids: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            bid.loadusershipmentbids(data.id, data.page).then((data) => {
                commit('SET_USER_SHIPMENT_BIDS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getShipmentBid: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            bidData.loadbid(id).then((data) => {
                commit('SET_BID', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
     getbidData: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            bid.loadbid(id).then((data) => {
                commit('SET_BID', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    promoteTransBid: ({commit}, id) => {
        return new Promise((resolve, reject)=> {
            bid.promotetransbid(id).then((data)=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    }
}

const mutations = {
    SET_BID: (state, bidData) => state.bidData = bidData,
    SET_BIDINFO: (state, bidInfo) => state.bidInfo = bidInfo,
    SET_BIDINFOS: (state, bidInfos) => state.bidInfos = bidInfos,
    SET_OUBIDS: (state, oubids) => state.oubids = oubids,
    SET_OPEN_BIDS: (state, openbids) => state.openbids = openbids,
    SET_AWARDED_BIDS: (state, awardedbids) => state.awardedbids = awardedbids,
    SET_EXPIRED_BIDS: (state, expiredbids) => state.expiredbids = expiredbids,
    SET_COMPLETED_BIDS: (state, completedbids) => state.completedbids = completedbids,
    SET_USER_SHIPMENT_BIDS: (state, bids) => state.shipmentbids = bids,
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