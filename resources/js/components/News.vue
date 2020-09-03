<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center" v-if="loading">Loading...</div>

            <div class="col-md-8" v-else>
                <h1 class="text-center">News</h1>

                <div class="card-columns">
                    <div class="card my-3" v-for="item in items">
                        <img class="card-img-top" :src="item.picture" :alt="item.name">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <router-link :to="'/news/' + item.id">{{ item.name }}</router-link>
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" @click="loadMore()" v-if="currentPage !== lastPage">Load more</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../axios';

export default {
    name: 'News',
    data () {
        return {
            loading: true,
            items: [],
            currentPage: 1,
            lastPage: null,
        };
    },

    computed: {},

    methods: {
        async loadMore () {
            this.loading = true;

            const items = await this.fetchData(++this.currentPage);

            this.items.push(...items);
            this.loading = false;
        },

        async fetchData (page = 1) {
            console.log('Loading page', page)

            const data = await axios.get('/api/v1/news', {params: {page}});

            this.currentPage = data.data.meta.current_page;
            this.lastPage = data.data.meta.last_page;

            return data.data.data;
        }
    },

    async created () {
        this.items = await this.fetchData();
        this.loading = false;

        console.log(this.data)
    }
};
</script>

<style scoped>

</style>
