<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h1 class="display-4">Welcome</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, deleniti distinctio dolores ea illum inventore neque nisi officia pariatur perspiciatis quia tempora vero voluptas! Blanditiis debitis dolores ea iusto quibusdam.</p>
                    <hr class="my-4">
                    <p>Aspernatur aut, deserunt dolore eius enim illum in modi, necessitatibus optio quibusdam quidem voluptatum? Asperiores autem earum facilis harum itaque iusto, possimus quaerat quas reiciendis soluta temporibus, totam unde vitae?</p>
                    <router-link class="btn btn-primary btn-lg" to="/news">Read news</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Home',
    data () {
        return {};
    },

    computed: {},

    methods: {},
};
</script>

<style scoped>

</style>
