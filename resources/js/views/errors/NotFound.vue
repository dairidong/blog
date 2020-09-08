<template>
    <div class="error">
        <div class="code">
            404
        </div>

        <div class="message">
            没有找到此页面
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotFound"
    }
</script>

<style scoped>

    .error {
        height: 90vh;
        align-items: center;
        display: flex;
        justify-content: center;
        position: relative;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 100;
    }

    .code {
        border-right: 2px solid;
        font-size: 26px;
        padding: 0 15px 0 15px;
        text-align: center;
    }

    .message {
        font-size: 18px;
        text-align: center;
        padding: 10px;
    }

</style>
