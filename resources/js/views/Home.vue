<template>
    <Container>
        <template v-slot:main>
            <router-view></router-view>
        </template>
    </Container>
</template>

<script>
    import Container from "../layouts/Container";

    export default {
        components: {
            Container
        }
    }
</script>

<style scoped>

</style>
