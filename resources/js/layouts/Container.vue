<template>
    <el-container>
        <el-header>
            <!--引入导航栏-->
            <Navbar></Navbar>
        </el-header>
        <el-main>
            <slot name="main"></slot>
        </el-main>
        <el-footer>
            <Footer></Footer>
        </el-footer>
    </el-container>
</template>

<script>
    import Navbar from './Navbar';
    import Footer from './Footer';

    export default {
        components: {
            Navbar, Footer
        }
    }
</script>

<style scoped>
    .el-container {
        /*铺满屏幕*/
        min-height: 100vh;
    }

    .el-header {
        padding: 0;
    }

    .el-main {
        padding: 0;
    }

    .el-footer {
        background: #1b1c1d;
        display: flex;
        align-items: center;
    }
</style>
