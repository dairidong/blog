<template>
    <div class="container">
        <span>
            ©Copyright
            <span v-if="copyright">
                <el-link
                    :href="copyright_link"
                    :underline="false"
                    target="_blank"
                >
                    {{ copyright }}
                </el-link>
            </span>
            <span class="none-text" v-else>无</span>
        </span>
        <el-divider direction="vertical"></el-divider>
        <span>
            <el-link
                :href="icp_link"
                :underline="false"
                target="_blank"
            >
                {{ icp_beian ? icp_beian : '暂未设置备案号' }}
            </el-link>
        </span>
        <el-divider direction="vertical"></el-divider>
        <span>
            <img :src="police_icon"/>
            <el-link :href="police_link"
                     :underline="false"
                     target="_blank"
            >
                {{ police_beian ? police_beian : '暂未设置公安备案'}}
            </el-link>
        </span>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                copyright: '',
                copyright_link: '',
                icp_beian: '',
                icp_link: 'http://beian.miit.gov.cn/',
                police_icon: '/police.png',
                police_beian: '',
                police_link: '',
            }
        },
        created() {
            this.getWebSettings();
        },
        methods: {
            getWebSettings() {
                let that = this;
                this.$http.get('/settings')
                    .then(response => {
                        that.copyright = response.copyright;
                        that.copyright_link = response.copyright_link;
                        that.icp_beian = response.icp_beian;
                        that.police_beian = response.police_beian;
                        that.police_link = response.police_link;
                    })
            }
        }
    }
</script>

<style scoped>
    .container {
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .el-divider {
        background-color: #909399;
    }
</style>
