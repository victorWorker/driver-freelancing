import Api from './Api';

export default {
    loadshipments(page){
        return Api.get(`admin/shipments?page=${page}`);
    },
    loadjobs(page){
        return Api.get(`admin/jobs?page=${page}`);
    },
    loadshipment(id){
        return Api.get(`admin/shipments/get/shipment/${id}`);
    },
    loadshipmentbids(data){
        return Api.get(`admin/shipments/get/bids/${data.id}?page=${data.page}`);
    },
    addprices(data) {
        return Api.patch('/admin/shipments/add/prices', data);
    },
    suspendbid(id){
        return Api.patch('/admin/shipments/suspend/bid/'+id);
    },
    activatebid(id){
        return Api.patch('/admin/shipments/activate/bid/'+id);
    },
    updatebid(data){
        return Api.patch('/admin/shipments/update/bid',data.data);
    },
    loaduseropenshipments(page){
        return Api.get(`user/shipments/fetch/open?page=${page}`);
    },
    loaduserawardedshipments(page){
        return Api.get(`user/shipments/fetch/awarded?page=${page}`);
    },
    loadusercompletedshipments(page){
        return Api.get(`user/shipments/fetch/completed?page=${page}`);
    },
    loaduserexpiredshipments(page){
        return Api.get(`user/shipments/fetch/expired?page=${page}`);
    },
    loadusershipment(id){
        return Api.get(`user/shipments/get/${id}`);
    },
    addusershipment(data) {
        return Api.post('user/shipments', data);
    },
    upload(base64,commit){
        return Api.post('user/shipments/upload',{image:base64}, {onUploadProgress: (progressEvent) => {
            commit('SET_PROGRESS',Math.floor(progressEvent.loaded * 100 / progressEvent.total))
        }});
    },
    addmessagesubject(data) {
        return Api.post('/user/subject/create', data);
    },
    updateactualdetails(data) {
        return Api.patch(`/user/shipments/actualcontact/${data.id}`, { actualDetails: { phone: data.phone, address: data.address } });
    },
    addreview(data) {
        return Api.post(`/user/shipments/review`, data);
    },
    generateguia(id) {
        return Api.get(`/transporter/generate/guia/${id}`);
    }
}