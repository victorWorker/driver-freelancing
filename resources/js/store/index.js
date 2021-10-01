import Vue from 'vue';
import Vuex from 'vuex';
import common from './modules/common';
import dashboard from './modules/dashboard';
import user from './modules/user';
import shipment from './modules/shipment';
import transaction from './modules/transaction';
import settings from './modules/settings';
import bid from './modules/bid';
import front from './modules/front';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        common,
        dashboard,
        user,
        shipment,
        transaction,
        settings,
        bid,
        front
    },
       state: {
        count: 0,
        //title:'hello',
    },
    mutations: {
        INCREASE_COUNT(state, amount = 1) {
            state.count += Number(amount)
        },
        DECREASE_COUNT(state, amount = 1) {
            state.count -= Number(amount)
        }
    },
    actions: {
        updateCount({ commit }, amount) {
            if (amount >= 0) {
                commit('INCREASE_COUNT', amount)
            } else {
                commit('DECREASE_COUNT', amount)
            }
        }
    }
});