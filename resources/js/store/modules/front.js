import front from '../../Api/front';
import {sendMessageIO} from "../../mixins/chat-socket.js"

const state = {
    listings: [],
    listing:{},
    showshipment:{},
    pagination:{},
    spagination:{},
    categories:{},
    vehicles:{},
    progress:0 ,
    driver: {},
    subjects:{},
    messages:[],
    title: 'My Custom Title',
    links: [
      'http://google.com',
      'http://coursetro.com',
      'http://youtube.com'
    ],
    bid:{},
    countLinks:'',
    unreadCount: ''
}

const getters = {
    listings: (state) => state.listings,
    countLinks: (state) => {return state.links.length},
    listing: (state) => state.listing,
    shipment: (state) => {return state.showshipment},
    pagination: (state) => state.pagination,
    spagination: (state) => state.spagination,
    categories: (state) => state.categories,
    vehicles: (state) => state.vehicles,
    driver: (state) => state.driver,
    subjects: (state) => state.subjects,
    messages: (state) => state.messages,
    unreadCount: (state) => state.unreadCount,
    bid: (state) => state.bid,
}

const actions = {
    getListings: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            front.loadlistings(page).then((data) => {
                commit('SET_LISTINGS', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getBid:({commit}, id) =>{
        return front.loadbid(id).then(
            (data) => {
                console.log(data);
                commit('bid',data.data);
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },

    updateBid({ commit }, data) {
        return new Promise((resolve, reject)=> {
            front.updatebid(data, data.id).then((data)=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },

    // getShipment:({commit}, id) =>{
    //     return front.loadbid(id).then(
    //         (data) => {
    //             //console.log(data);
    //             commit('SET_LISTING', data.data);
    //             // commit('shipment', data.data);
    //             resolve('success');
    //         }
    //     ).catch( (error) => {
    //         console.log(error.response.data)
    //     })
    // },
    getShipment: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            shipment.loadbid(id).then((data) => {
                commit('SET_SHIPMENT_INFO', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getListing: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            if(data.token === null){
                front.loadlisting(data.id).then((data) => {
                    commit('SET_LISTING', data.data);
                    resolve('success');
                }).catch((err) => {
                    reject('error');
                });
            }else{
                front.loadloggedinlisting(data.id).then((data) => {
                    commit('SET_LISTING', data.data);
                    resolve('success');
                }).catch((err) => {
                    reject('error');
                });
            }
        });
    },
    getAutolistings: ({commit}, data) => {
        front.loadlistingAuto(data.id).then((data) => {
            resolve(data.data);
        }).catch((err) => {
            console.log(err);
            reject('error');
        });
    },
    getCategories: ({commit}) => {
        return new Promise((resolve, reject) => {
            front.loadcats().then((data) => {
                commit('SET_CATEGORIES', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    getVehicles: ({commit}) => {
        return new Promise((resolve, reject) => {
            front.getvehicles().then((data) => {
                commit('SET_VEHICLES', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    submitBid: ({commit,dispatch},form) => {
        return new Promise((resolve, reject) => {
            front.submitbid(form).then((data) => {
                dispatch('getListing', form.sid)
                resolve('success');
            }).catch((error) => {
                if(error.response.data.message === 'Multiple Bid Attempt'){
                    Swal.fire(
                        'Error!',
                        'Mutliple Bid Attempt, Only One Bid is Allowed Per Transporter',
                        'error'
                    )
                }else{
                    reject('error');
                }
               
            });
        });
    },
    submitListing: ({commit,dispatch},form) => {
        return new Promise((resolve, reject) => {
            front.submitlisting(form).then((data) => {
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    search: ({commit,dispatch},data) => {
        return new Promise((resolve, reject) => {
            front.search(data).then((data) => {
                commit('SET_LISTINGS',data.data.data);
                let spagination = data.data;
                delete spagination.data;
                commit('SPAGINATION', spagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    uploadImg:({commit}, base64) =>{
        return front.upload(base64,commit).then(
            (response) => {
                return response.data;
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
 //   async getTransporter({commit}, id) {
 //        if(!id) return null;
	// try {
	//    await front.loaddriver(id)
 //       console.log(data.data);
	//    commit('SET_DRIVER_INFO', data.data)
	// } catch(e) {
	//    console.log(e.response.data);
	// }
 //    },
     getTransporter: ({commit}, id) => {
        return new Promise((resolve, reject) => {
            front.loaddriver(id).then((data) => {
                commit('SET_DRIVER_INFO', data.data);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },

    
    getSubjects:({commit}) => {
        return front.loadsubjects().then(
            (data) => {
                commit('SET_SUBJECTS',data.data);
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    getMessages:({commit},subject) => {
        return front.loadmessages(subject).then(
            (data) => {
                commit('SET_MESSAGES',data.data);
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    send:({commit},form) => {
        return front.sendmessage(form).then(
            (data) => {
                commit('SET_ADD_MESSAGE', data.data)
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    getUserSubjects:({commit}) => {
        return front.loadusersubjects().then(
            (data) => {
                commit('SET_SUBJECTS',data.data);
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    getUserMessages:({commit},subject) => {
        return front.loadusermessages(subject).then(
            (data) => {
                commit('SET_MESSAGES',data.data);
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    sendUserMessage:({commit},form) => {
        return front.sendusermessage(form).then(
            (data) => {
                commit('SET_ADD_MESSAGE', data.data)
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    getUserUnreadCount:({commit},subject) => {
        return front.loaduserunreadmessagecount().then(
            (data) => {
                commit('SET_UNREAD_COUNT',data.data);
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    markMessagesRead: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            front.markmessagesread(data).then(() => {
                resolve('success');
            }).catch((err) => {
                reject('error');
            })
        });
    },
    markTransporterMessagesRead: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            front.marktransportermessagesread(data).then(() => {
                resolve('success');
            }).catch((err) => {
                reject('error');
            })
        });
    },
    getTransporterUnreadCount:({commit},subject) => {
        return front.loadtransporterunreadcount().then(
            (data) => {
                commit('SET_UNREAD_COUNT',data.data);
            }
        ).catch( (error) => {
            console.log(error.response.data)
        })
    },
    getHelp: ({commit}, data) => {
        return new Promise((resolve, reject) => {
            front.gethelp(data).then(() => {
                resolve('success');
            }).catch((err) => {
                resolve('error');
            })
        });
    },
    requestdata: ({ commit }, data) => {
        return new Promise((resolve, reject) => {
            front.Saverequest(data).then((response) => {
                if (response.data == 'error') {
                    resolve('error');
                } else {
                    commit('REQUEST_DATA', response.data);
                    resolve(response.data);
                }
            }).catch(() => {
                reject('error');
            });
        });
    },
    
}

const mutations = {
    SET_LISTINGS: (state, listings) => state.listings = listings,
    SET_LISTING: (state, listing) => state.listing = listing,
    SET_SHIPMENT_INFO: (state, showshipment) => state.showshipment = showshipment,
    SET_CATEGORIES: (state, categories) => state.categories = categories,
    SET_VEHICLES: (state, vehicles) => state.vehicles = vehicles,
    PAGINATION: (state, pagination) => state.pagination = pagination,
    SPAGINATION: (state, spagination) => state.spagination = spagination,
    SET_PROGRESS:(state, progress) => state.progress = progress,
    SET_DRIVER_INFO: (state, driver) => state.driver = driver,
    SET_SUBJECTS: (state,subjects) => state.subjects = subjects,
    SET_MESSAGES: (state,messages) => state.messages = messages,
    SET_ADD_MESSAGE: (state,message) =>  {
        sendMessageIO(message)
        state.messages = [...state.messages, message]
    },
    SET_UNREAD_COUNT: (state, count) => state.unreadCount = count,
    REQUEST_DATA: (state,id) => { state.id = id },
    SET_BIDS_DETAILS: (state, bid) => state.bid = bid,
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
