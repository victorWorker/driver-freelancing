import settings from '../../Api/settings';

const state = {
    pagination: {},
    categories: [],
    errors: [],
}

const getters = {
    categories: (state) => state.categories,
    pagination: (state) => state.pagination,
    errors: (state) => state.errors
}


const actions = {
    getCategories: ({commit}, page) => {
        return new Promise((resolve, reject) => {
            settings.loadcategories(page).then((data) => {
                commit('SET_CATEGORIES', data.data.data);
                let pagination = data.data;
                delete pagination.data;
                commit('PAGINATION', pagination);
                resolve('success');
            }).catch((err) => {
                reject('error');
            });
        });
    },
    addCategory: ({commit}, data) => {
        return new Promise((resolve, reject)=> {
            settings.addcategory(data).then(()=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    updateCategory({ commit }, data) {
        return new Promise((resolve, reject)=> {
            settings.updatecategory(data, data.id).then((data)=> {
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                resolve('error');
            });
        });
    },
    deleteCategory: ({commit}, id) => {
        return new Promise((resolve, reject)=> {
            settings.deletecategory(id).then(()=> {
                // commit('DELETE_OPERATION', id);
                resolve('success');
            }).catch((err)=> {
                commit('ERRORS', err.response.data.errors);
                reject('error');
            })
        });
    },
}

const mutations = {
    SET_CATEGORIES: (state, categories) => state.categories = categories,
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