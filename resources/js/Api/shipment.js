import Api from './Api';

export default {
    loadshipments(page){
        return Api.get(`admin/shipments?page=${page}`);
    },
    
    loadadminexpiredshipments(page){
        return Api.get(`admin/shipments/fetch/expired?page=${page}`);
    },
    loadjobs(page){
        return Api.get(`admin/shipments/fetch/jobs?page=${page}`);
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
    markcompleteshipment(id){
        return Api.patch('/admin/shipments/complete/shipment/'+id);
    },
    suspendbid(id){
        return Api.patch('/admin/shipments/suspend/bid/'+id);
    },
    updatepayment(id){
        return Api.patch('/admin/transactions/approve/'+id);
    },
     deleteShipment(id){
       // return Api.patch('/admin/shipments/delete/shipment/'+id);
         return Api.delete(`/admin/shipments/${id}`);
    },
     deleteusershipment(id){
      
         return Api.delete(`/user/shipments/${id}`);
    },
    activatebid(id){
        return Api.patch('/admin/shipments/activate/bid/'+id);
    },
    updatebid(data){
        return Api.patch('/admin/shipments/update/bid',data.data);
    },
    //  updatedashshipment(data, id) {
    //     return Api.patch(`/admin/shipments/${id}`, data);        
    // },
    updatedashshipment(data, id) {
        return Api.patch(`/admin/shipments/update_shipment/${id}`, data);        
    },
    updatedashshipments(data, id) {
        return Api.patch(`/admin/shipments/update_shipments/${id}`, data);        
    },
    updateshipment(data, id) {
        return Api.patch(`/user/shipments/${id}`, data);        
    },
     markcompleteship(id){
        return Api.patch('user/shipments/markcompleteship/'+id);
    },
    sendCoupon(data){
        return Api.patch('user/shipments/sendcoupon', data);
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
    dashupload(base64,commit){
        return Api.post('admin/shipments/upload',{image:base64}, {onUploadProgress: (progressEvent) => {
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
    adddriverreview(data) {
        return Api.post(`/transporter/shipments/review`, data);
    },
    generateguia(id) {
        return Api.get(`/transporter/generate/guia/${id}`);
    },
    addShipmentForm(data) {
    	return Api.post(`/user/shipments/add`, data)
    }
}
