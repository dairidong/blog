import axios from 'axios';
import router from '../router';
import {Message} from "element-ui";

const service = axios.create({
    baseURL: '/api',
    timeout: 5000,
});

service.interceptors.response.use(
    response => {
        return Promise.resolve(response.data);
    },
    error => {
        switch (error.response.status) {
            case 404:
                router.push({name: 'notFound'});
                break;
            default:
                Message({
                    type: "error",
                    message: '发生错误，自动返回首页',
                    duration: 5000,
                    center: true,
                    onClose: (obj) => {
                        router.push({name: 'index'});
                    }
                });
        }
    }
);

export default service;
