<template>
    <div class="container bg-white">
        <h1 class="post-title">{{ post.title }}</h1>
        <div class="post-info">
            分类：
            <router-link
                v-if="post.category"
                :to="{name:'category',params: {id: post.category.id}}"
            >{{ post.category.title }}
            </router-link>
            <span v-else>无</span>
            <el-divider direction="vertical"></el-divider>
            发布时间：{{ post.published_at }}
            <el-divider direction="vertical"></el-divider>
            最后更新时间：{{ post.updated_at }}
        </div>
        <el-divider/>
        <div class="markdown-body" v-html="content"></div>
        <el-row class="foot">
            <el-button round
                       class="prev-button"
                       :disabled="!Boolean(post.prev_id)"
                       @click="$router.push({name:'postShow',params: {id:post.prev_id}})"
            >
                <i class="el-icon-back"></i>上一篇
            </el-button>
            <el-button
                round
                class="next-button"
                :disabled="!Boolean(post.next_id)"
                @click="$router.push({name:'postShow',params: {id:post.next_id}})"
            >
                下一篇<i class="el-icon-right"></i>
            </el-button>
        </el-row>
    </div>
</template>

<script>
    import marked from '../utils/marked';
    import formatTime from '../utils/formatTime';

    export default {
        data() {
            return {
                post: [],
                idReg: /^\d+$/,
                content: '',// HTML 格式的文章内容
            }
        },
        beforeRouteEnter(to, from, next) {
            next(vm => {
                vm.getPost();
            })
        },
        beforeRouteUpdate(to, from, next) {
            next();
            let id = this.$route.params.id;
            // 正则判断使用 post 的 id 或者 slug 是否被更新，如果被更新，则说明文章发生变化，需要重新获取文章
            if (this.idReg.test(id)) {
                if (this.post && this.post.id != id) {
                    this.getPost();
                }
            } else {
                if (this.post && this.post.slug != id) {
                    this.getPost();
                }
            }
        },
        methods: {
            getPost() {
                let id = this.$route.params.id
                let that = this;
                this.$http.get(`/posts/${id}`)
                    .then(response => {
                        that.post = response.data;
                        that.markdownToHtml(that.post.content)
                        // 改变标签标题
                        document.title = that.post.title;
                        // 优化时间格式
                        that.post.published_at = formatTime(that.post.published_at);
                        that.post.updated_at = formatTime(that.post.updated_at);
                        // 判断路由参数是否数字 id 并且 slug 不为空时，路由跳转到 slug 为参数的地址
                        if (that.idReg.test(id) && that.post.slug !== '') {
                            // 使用 replace ，防止跳转回 数字id 为参数的地址
                            that.$router.replace({name: 'postShow', params: {id: that.post.slug}});
                        }
                    });
            },
            // 获取格式化后的文章内容
            markdownToHtml(value) {
                this.content = marked(value);
            },
        }
    }
</script>

<style scoped>
    @import "~github-markdown-css";
    @import '~highlight.js/styles/googlecode.css';

    @media (max-width: 767px) {
        .markdown-body {
            padding: 15px;
        }
    }

    .container {
        position: relative;
        padding: 1.5rem 1.5rem 100px;
    }

    .foot {
        position: absolute;
        bottom: 0;
        left: 15px;
        right: 15px;
        height: 60px;
    }

    .post-info {
        color: #606266;
    }

    .next-button {
        float: right;
    }
</style>
