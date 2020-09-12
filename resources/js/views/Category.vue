<template>
    <div>
        <div class="container">
            <el-card>
                <h5>当前分类：{{ category.title }}</h5>
            </el-card>
            <ArticleItemBox :category="categoryId"></ArticleItemBox>
        </div>
    </div>
</template>

<script>
    import ArticleItemBox from "../components/ArticleItemBox";

    export default {
        data() {
            return {
                category: [],
            }
        },
        components: {
            ArticleItemBox
        },
        computed: {
            categoryId: function () {
                return parseInt(this.$route.params.id)
            }
        },
        beforeRouteEnter(to, from, next) {
            next(vm => {
                vm.getCategory();
            });
        },
        beforeRouteUpdate(to, from, next) {
            this.getCategory();
            next();
        },
        methods: {
            getCategory() {
                let that = this;
                this.$http.get(`/categories/${this.categoryId}`)
                    .then(response => {
                        that.category = response.data
                    })
            }
        }
    }
</script>

<style scoped>

</style>
