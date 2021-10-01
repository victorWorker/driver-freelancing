import user from '../../Api/user';
import Auth from '../../Api/Auth';

const state = {
    errors: [],
    user: [],
    users:[],
    transporters: [],
    pagination: {},
    progress: 0,
    authUser: {}
}

const getters = {
    errors: (state) => state.errors,
    users: (state) => state.users,
    user: (state) => state.user,
    transporters: (state) => state.transporters,
    authUser: (state) => state.authUser,
    pagination: (state) => state.pagination,
    progress: (state) => state.progress,
}

const actions = {
    getUsers: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            user.loadusers(page).then((data) => {
                commit('SET_USERS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getUser: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            user.loaduser(id).then((data) => {
                commit('SET_USER', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getTransporter: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            user.loadtransporter(id).then((data) => {
                commit('SET_USER', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getTransportersNoDocuments: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            user.loadnotdocumentstransporters(page).then((data) => {
                commit('SET_TRANSPORTERS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getTransporters: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            user.loadtransporters(page).then((data) => {
                commit('SET_TRANSPORTERS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    addTransporter: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            user.saveuser(data).then((response) => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    }, 
    banUser: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            user.banuser(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    setUserSMS: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            user.setusersms(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    unsetUserSMS: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            user.unsetusersms(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
     deleteUser: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            user.deleteuser(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    approveUser: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            user.approveuser(id).then((response) => {
                resolve('success');
            }).catch((err) => {
            });
        });
    },
    searchUser: ({commit}, dta) => {
        return new Promise((resolve, reject) => {
            user.searchuser(dta).then((data) => {
                commit('SET_USERS', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    sendMail: ({commit}, dta) => {
        return new Promise((resolve, reject) => {
            user.sendemail(dta).then((data) => {
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    uploadVerificationDocs:({commit}, base64) =>{
        return user.upload(base64,commit).then(
            (response) => {
                return response.data;
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    addVerificationDocs: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            user.addverificationdocs(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    uploadProfileImage:({commit}, base64) =>{
        return user.uploadprofile(base64,commit).then(
            (response) => {
                return response.data;
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    uploaduserProfileImage:({commit}, base64) =>{
        return user.uploaduserprofile(base64,commit).then(
            (response) => {
                return response.data;
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    getAuthUser: ({commit}) => {
        return new Promise((resolve, reject) => {
            Auth.loadauthuser().then((data) => {
                commit('SET_AUTH_USER', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    setAuthUser: ({commit}, data) => {
        commit('SET_AUTH_USER', data);
    },
    updateTransporter: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            user.updatetransporter(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            })
        });
    },
    updateUser: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            user.updateuser(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            })
        });
    },
    updateBadge: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            user.updatebadge(data).then(() => {
                resolve('success');
            }).catch((err) => {
                commit('SET_ERRORS', err.response.data.errors);
                resolve('error');
            })
        });
    }
}

const mutations = {
    SET_USERS: (state, users) => state.users = users,
    SET_USER: (state, user) => state.user = user,
    SET_TRANSPORTERS: (state, transporters) => state.transporters = transporters,
    SET_ERRORS: (state, errors) => state.errors = errors,
    SET_PROGRESS: (state,progress) => state.progress = progress,
    SET_AUTH_USER: (state, user) => state.authUser = user,
    PAGINATION: (state, pagination) => state.pagination = pagination,
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}