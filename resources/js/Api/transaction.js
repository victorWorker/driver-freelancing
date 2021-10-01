import Api from './Api';

export default {
    loadtransactions(page) {
        return Api.get(`/admin/transactions?page=${page}`);
    },
    addsubscriptiontransaction(data) {
        return Api.post(`/payment/generate`, data);
    },

    loadlastshiptransactioGET() {
        return Api.get(`/loadlastshiptransaction`);
    },

    loadtransportertransactions(page) {
        return Api.get(`/transporter/transactions?page=${page}`);
    },    

    loadlastsubscriptiontransaction() {
        return Api.get(`/transporter/transaction/last/subscription`);
    },
    confirmpaypalpayment(data) {
        return Api.post('/paypal/confirm/payment', data);
    },
    checkmultibancostatus(data) {
        return Api.post('/multibanco/status', data);
    }
}