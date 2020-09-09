<template>
    <el-menu class="el-menu" mode="horizontal" :router="true">
        <!--    logo 开始    -->
        <el-menu-item index="1" :route="{name:'index'}">
            <img :src="logo" class="page-logo">
        </el-menu-item>
        <!--    logo 结束    -->

        <!--    文章开始    -->
<!--        <el-submenu index="2" :show-timeout="100" :hide-timeout="100">-->
<!--            <template slot="title"><i class="el-icon-notebook-1"></i>文章</template>-->
<!--            <div v-if="categories.length">-->
<!--                <el-menu-item v-for="(category,key) in categories" :key="key" :index="category.title"-->
<!--                              :route="{name: 'categories',params: {id:category.id}}">-->
<!--                    {{category.title}}-->
<!--                </el-menu-item>-->
<!--            </div>-->
<!--            <div v-else>-->
<!--                <el-menu-item>无</el-menu-item>-->
<!--            </div>-->
<!--        </el-submenu>-->
        <!--    文章结束    -->
    </el-menu>
</template>

<script>
    import {mapState, mapActions} from 'vuex';

    export default {
        data() {
            return {
                logo: '/storage/logo.png',
                logFit: 'contain',
            };
        },
        computed: {
            ...mapState([
                'categories'
            ])
        },
        created() {
            this.getCategories();
        },
        methods: {
            ...mapActions([
                'getCategories'
            ])
        },
    }
</script>

<style scoped>
    .page-logo {
        width: 100px;
    }

    .el-menu {
        padding-left: 200px;
    }
</style>
