import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const routes = [
    {
        path: '',
        component: () => import('../views/Home'),
        children: [
            {
                path: '',
                name: 'index',
                meta: {title: 'DRD 博客'},
                component: () => import('../views/MainPage'),
            },
            {
                path: '/posts/:id',
                name: 'postShow',
                component: () => import('../views/ArticlePage'),
            },
            {
                path: '/categories/:id',
                name: 'category',
                component: () => import('../views/Category'),
            },
            {
                path: '/404',
                name: 'notFound',
                component: () => import('../views/errors/NotFound'),
            },
        ],
    },
    // 不存在的地址，自动重定向到 404 页面
    {path: '*', redirect: '/404',},
];

const router = new Router({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta && to.meta.title) {
        document.title = to.meta.title;
    }
    next();
});

export default router;
