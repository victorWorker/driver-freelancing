import Api from './Api';

export default {
    loadlistings(page) {
        return Api.get(`/enduser/listings?page=${page}`);
    },
    loadlisting(id){
        return Api.get(`/enduser/listings/${id}`);
    },
    loadlistingAuto(id){
        return Api.get(`enduser/listings/auto/${id}`);
    },
    loadloggedinlisting(id){
        return Api.get(`/enduser/listings/${id}`);
    },
    loadbid(id){
        return Api.get(`transporter/get/bids/${id}`);
    },
    loadcats(){
        return Api.get(`/enduser/get/categories`);
    },
    getvehicles(){
        return Api.get('/enduser/get/vehicles');
    },
    submitbid(form){
        return Api.post('/transporter/submit/bid',form);
    },
    search(data){
        return Api.post(`/enduser/listings/search?page=${data.page}`,data)
    },
    submitlisting(form){
        return Api.post('/enduser/submit/shipment',form);
    },
    upload(base64,commit){
        return Api.post('/enduser/upload/image',{image:base64}, {onUploadProgress: (progressEvent) => {
            commit('SET_PROGRESS',Math.floor(progressEvent.loaded * 100 / progressEvent.total))
        }});
    },
    loaddriver(id){
        if(!id) return Promise.resolve({});
        return Api.get('/profile/transporter/'+id);
    }, 
   
    loadsubjects(){
        return Api.get('/transporter/get/subjects')
    },
    loadmessages(subject){
        return Api.post('/transporter/get/messages',{subject_id: subject.id, to_id:subject.user_id})
    },
    sendmessage(form){
        return Api.post('/transporter/send/message',form)
    },
    loadusersubjects(){
        return Api.get('/user/get/subjects')
    },
    loadusermessages(subject){
        return Api.post('/user/get/messages',{subject_id: subject.id, to_id:subject.driver_id})
    },
    sendusermessage(form){
        return Api.post('/user/send/message',form)
    },
    loaduserunreadmessagecount() {
        return Api.get('/user/unread/get');
    },
    markmessagesread(data) {
        return Api.patch('/user/read/messages', { subject_id: data });
    },
    marktransportermessagesread(data) {
        return Api.patch('/transporter/read/messages', { subject_id: data });
    },
    loadtransporterunreadcount(){
        return Api.get('/transporter/unread/get');
    },
    gethelp(data) {
        return Api.post('/enduser/get/help', data);
    },
    updatebid(data, id) {
        return Api.patch(`/transporter/bids/${id}`, data);
    },
    Saverequest(data) {
        return Api.post('/enduser/saverequest', data);
    }
}