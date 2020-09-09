import Vue from 'vue';
import Vuex from 'vuex';
import request from '../request';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        categories: []
    },
    mutations: {
        GET_CATEGORIES: (state) => {
            request.get('/categories')
                .then(response => {
                    state.categories = response.data;
                })
        }
    },
    actions: {
        getCategories({commit}) {
            commit('GET_CATEGORIES');
        }
    }
})

export default store;
