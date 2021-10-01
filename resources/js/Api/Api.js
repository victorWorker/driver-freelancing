import axios from 'axios';

let Api = ()=> {
    let token = localStorage.getItem('token');
    if(token != null){
        // console.log('Token');
        return `Bearer ${token}`;
    }else{
        // console.log('No Token');
        return 'No Token';
    }
    
}

var BaseApi = axios.create({
    baseURL: "http://localhost:8000/api/",
    // baseURL: "https://buscargo.pt/api/",
    headers: {
        Authorization: Api()
    }
});


export default BaseApi;
