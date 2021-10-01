 import Api from './Api';

 export default {
     loadtransdashdata() {
         return Api.get('/transporter/dashboard/data');
     },
     loaduserdashdata() {
        return Api.get('/user/dashboard/data');
    }
 }