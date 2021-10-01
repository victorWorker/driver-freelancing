import Api from './Api';

export default {
    loadtransporteroubids(page) {
        return Api.get(`/transporter/bids/fetch/oubids?page=${page}`);
    },
    loadtransporteropenbids(page) {
        return Api.get(`/transporter/bids/fetch/open?page=${page}`);
    },
    loadbidInfo(id) {
        return Api.get(`/driver/bid/${id}`);
    },
    loadbidInfos(id) {
        return Api.get(`/driver/bidwithshipment/${id}`);
    },
     updateoubid(data, id) {
        return Api.patch(`/transporter/bids/${id}`, data);
    },
    updatebid(data, id) {
        return Api.patch(`/transporter/bids/updatebid/${id}`, data);
    },

    addMessageSubjectbyDriverurl(data) {
        return Api.post('/transporter/subject/create', data);
    },
    deletebid(id) {
        return Api.delete(`/transporter/bids/${id}`);
    },
    loadtransporterawardedbids(page) {
        return Api.get(`/transporter/bids/fetch/awarded?page=${page}`);
    },
    loadtransporterexpiredbids(page) {
        return Api.get(`/transporter/bids/fetch/expired?page=${page}`);
    },
    loadtransportercompletedbids(page) {
        return Api.get(`/transporter/bids/fetch/completed?page=${page}`);
    },
    loadusershipmentbids(id, page) {
        return Api.get(`/user/shipments/get/bids/${id}?page=${page}`);
    },
    loadbid(id){
        return Api.get(`user/shipments/get/bid/${id}`);
    },
    promotetransbid(id) {
        return Api.patch(`/transporter/bids/promote/${id}`);
    }
}