import { data } from 'jquery';
import shipment from '../../Api/shipment';

const state = {
    errors: [],
    shipments: [],
    pagination: {},
    shipment:{},
    openshipments:[],
    awardedshipments:[],
    completedshipments:[],
    expiredshipments:[],
    expiredadminshipments:[],
    guia: {},
    progress: 0,
    rating: 0,
    bids:[],
    //jobs:[],
}

const getters = {
    errors: (state) => state.errors,
    shipments: (state) => state.shipments,
    openshipments: (state) => state.openshipments,
    awardedshipments: (state) => state.awardedshipments,
    completedshipments: (state) => state.completedshipments,
    expiredshipments: (state) => state.expiredshipments,
    expiredadminshipments: (state) => state.expiredadminshipments,
    pagination: (state) => state.pagination,
    shipment: (state) => state.shipment,
    guia: (state) => state.guia,
    progress: (state) => state.progress,
    rating: (state) => state.rating,
    bids: (state) => state.bids,
    //jobs: (state) => state.jobs
}

const actions = {
    
    getShipments: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            shipment.loadshipments(page).then((data) => {
                commit('SET_SHIPMENTS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
      getAdminExpiredShipments: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            shipment.loadadminexpiredshipments(page).then((data) => {
                commit('SET_SHIPMENTS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getJobs: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            shipment.loadjobs(page).then((data) => {
                commit('SET_SHIPMENTS', data.data.data);
                console.log(data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getShipment: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.loadshipment(id).then((data) => {
                commit('SET_SHIPMENT', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getShipmentBids: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            shipment.loadshipmentbids(data).then((data) => {
                commit('SET_SHIPMENT_BIDS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
   
    deleteShipment: ({commit}, id) => {
        return new Promise((resolve, reject)=> {
            shipment.deleteShipment(id).then(()=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                reject('error');
            })
        });
    },
    deleteUserShipment: ({commit}, id) => {
        return new Promise((resolve, reject)=> {
            shipment.deleteusershipment(id).then(()=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                reject('error');
            })
        });
    },
     suspendBid: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.suspendbid(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    completemarkJob: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.markcompleteshipment(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
      completemarkShip: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.markcompleteship(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    activateBid: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.activatebid(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    updateBid: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            shipment.updatebid(data).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    sendCoupon: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            shipment.sendCoupon(data).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    updateDashShipment({ commit }, data) {
        return new Promise((resolve, reject)=> {
           
            shipment.updatedashshipment(data, data.id).then((data)=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    }, 
    updateShipment({ commit }, data) {
        return new Promise((resolve, reject)=> {
           
            shipment.updateshipment(data, data.id).then((data)=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
     updateDashShipments({ commit }, data) {
        return new Promise((resolve, reject)=> {
           
            shipment.updatedashshipments(data, data.id).then((data)=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    getUserOpenShipments: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            shipment.loaduseropenshipments(page).then((data) => {
                commit('SET_OPEN_SHIPMENTS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getUserAwardedShipments: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            shipment.loaduserawardedshipments(page).then((data) => {
                commit('SET_AWARDED_SHIPMENTS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getUserCompletedShipments: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            shipment.loadusercompletedshipments(page).then((data) => {
                commit('SET_COMPLETED_SHIPMENTS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getUserExpiredShipments: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            shipment.loaduserexpiredshipments(page).then((data) => {
                commit('SET_EXPIRED_SHIPMENTS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },  
   
    getUserShipment: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.loadusershipment(id).then((data) => {
                commit('SET_SHIPMENT', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    addUserShipment: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            shipment.addusershipment(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    uploadImage:({commit}, base64) =>{
        return shipment.upload(base64,commit).then(
            (response) => {
                return response.data;
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    }, 
    uploadDashImage:({commit}, base64) =>{
        return shipment.dashupload(base64,commit).then(
            (response) => {
                return response.data;
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    updateActualDetails: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            shipment.updatebid(data).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    setDriverRating: ({ commit }, rating) => {
        commit('SET_RATING', rating);
    },
    setRating: ({ commit }, rating) => {
        commit('SET_RATING', rating);
    },
    addReview: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            shipment.addreview(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
     addDriverReview: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            shipment.adddriverreview(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    addMessageSubject: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            shipment.addmessagesubject(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    generateGuia: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.generateguia(id).then((data) => {
                commit('SET_GUIA', data.data);
                resolve('success');
            }).catch((err) => {
                resolve('error');
            });
        });
    },
    addPrices: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            shipment.addprices(data).then((response) => {
                resolve('success');
            }).catch((err) => {
                resolve('error');
            });
        });
    },
}

const mutations = {
    SET_SHIPMENTS: (state, shipments) => state.shipments = shipments,
    SET_SHIPMENT_BIDS: (state, bids) => state.bids = bids,
    SET_JOBS: (state, jobs) => state.jobs = jobs,
    SET_SHIPMENT: (state, shipment) => state.shipment = shipment,
    SET_OPEN_SHIPMENTS: (state, shipments) => state.openshipments = shipments,
    SET_AWARDED_SHIPMENTS: (state, shipments) => state.awardedshipments = shipments,
    SET_COMPLETED_SHIPMENTS: (state, shipments) => state.completedshipments = shipments,
    SET_EXPIRED_SHIPMENTS: (state, shipments) => state.expiredshipments = shipments,
   // SET_ADMIN_EXPIRED_SHIPMENTS: (state, shipments) => state.expiredadminshipments = shipments,
    SET_GUIA: (state, data) => state.guia = data,
    SET_ERRORS: (state, errors) => state.errors = errors,
    SET_PROGRESS: (state,progress) => state.progress = progress,
    PAGINATION: (state, pagination) => state.pagination = pagination,
    SET_RATING: (state, rating) => state.rating = rating,
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}