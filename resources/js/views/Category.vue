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
            this.getCategory(to.params.id);
            next();
        },
        methods: {
            getCategory(categoryId) {
                let that = this;
                let id = categoryId ? categoryId : this.categoryId;
                this.$http.get(`/categories/${id}`)
                    .then(response => {
                        that.category = response.data
                    })
            }
        }
    }
</script>

<style scoped>

</style>
