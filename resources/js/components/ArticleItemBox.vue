<template>
    <div v-if="posts.length > 0">
        <el-card :shadow="shadow" v-for="(post,key) in posts" :key="key">
            <router-link :to="{name:'postShow',params: {id: post.id}}">
                <el-image
                    style="width: 100%;height: 300px"
                    :src="post.cover"
                    :lazy="true"
                    :fit="fit"
                >
                    <!--错误提示-->
                    <div slot="error">
                        <div class="el-image__error" style="height: 300px">
                            <h3><i class="el-icon-picture-outline"></i>&nbsp;&nbsp;暂无图片</h3>
                        </div>
                    </div>
                </el-image>
            </router-link>
            <el-divider></el-divider>
            <div>
                <router-link :to="{name:'postShow',params: {id: post.id}}">
                    <el-link :underline="false">
                        <h4 class="post-title"><b>{{post.title}}</b></h4>
                    </el-link>
                </router-link>
                <div style="float: right;">
                    <span v-if="(post.category && post.category.id > 0)">
                        分类：
                        <router-link :to="{name:'category',params:{id:post.category.id}}">
                        <el-link type="primary" :underline="false">{{ post.category.title }}</el-link>
                    </router-link>
                    </span>
                    <span v-else>分类： <span class="none-text">无</span></span>
                </div>
            </div>
        </el-card>
        <center>
            <el-pagination
                background
                layout="prev, pager, next"
                :total="postsTotal"
                :page-size="pageSize"
                :hide-on-single-page="true"
                :current-page="page"
                @current-change="pageChange"
            >
            </el-pagination>
        </center>
    </div>
    <div v-else class="no-posts">
        <h1 class="no-posts-message">暂时没有文章~</h1>
    </div>
</template>

<script>
    export default {
        props: {
            category: Number,
        },
        data() {
            return {
                shadow: 'hover',
                fit: "cover",
                posts: [],
                postsTotal: 0,
                pageSize: 6,
            }
        },
        computed: {
            page: function () {
                let page = this.$route.query.page;
                return page ? parseInt(page) : 1;
            }
        },
        watch: {
            '$route'(to, from) {
                // query 的变化不会触发 beforeRouteUpdate
                this.getPosts(this.page, this.pageSize)
            }
        },
        created() {
            this.getPosts(this.page, this.pageSize);
        },
        methods: {
            getPosts(page, pageSize) {
                let that = this;
                let url = `/posts?page=${parseInt(page)}&pageSize=${parseInt(pageSize)}`;
                if (this.category) {
                    url += `&category=${this.category}`;
                }

                this.$http.get(url)
                    .then(function (response) {
                        that.posts = response.data;
                        that.postsTotal = response.meta.total;
                    });
            },
            pageChange(page) {
                this.$router.push({path: this.$route.path, query: {page}})
            }
        },

    }
</script>

<style scoped>
    .el-card {
        margin-bottom: 5%
    }

    .post-title {
        display: inline-block;
    }

    .no-posts {
        position: relative;
    }

    .no-posts-message {
        text-align: center;
        position: relative;
        margin-top: 30%;
        color: #909399;
    }

</style>
