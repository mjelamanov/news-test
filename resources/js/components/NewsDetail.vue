<template>
    <div class="container">
        <div class="row">
            <div class="text-center" v-if="loading">Loading...</div>

            <div class="col-md-8 offset-md-2" v-else>
                <h1 class="text-center">{{ data.name }}</h1>

                <div class="text-center my-3">
                    <img class="img-thumbnail" :src="data.picture" :alt="data.name">
                </div>

                <div class="justify-content">{{ data.content }}</div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center">Comments</h2>
                <br>

                <div class="alert alert-success text-center" v-if="comment.message">{{ comment.message }}</div>

                <form class="card card-body" @submit.prevent="addComment()" v-else>
                    <h3 class="text-center">Add a new comment</h3>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" :class="{'form-control': true, 'is-invalid': comment.errors.name}" id="name" placeholder="Name" required v-model="comment.newName">
                        <small class="invalid-feedback" v-if="comment.errors.name">{{ comment.errors.name[0] }}</small>
                    </div>

                    <div class="form-group">
                        <label for="comment">Text</label>
                        <textarea :class="{'form-control': true, 'is-invalid': comment.errors.comment}" id="comment" required v-model="comment.newComment"></textarea>
                        <small class="invalid-feedback" v-if="comment.errors.comment">{{ comment.errors.comment[0] }}</small>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="text-center" v-if="comment.loading">Loading...</div>

                <ul class="list-unstyled" v-else>
                    <li class="media border p-3 mb-3" v-for="comment in comment.items" :key="comment.id">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">{{ comment.name }}</h5>
                            {{ comment.comment }}
                        </div>
                    </li>
                </ul>

                <div class="text-center" v-if="!comment.loading && comment.items.length && comment.currentPage !== comment.lastPage">
                    <button class="btn btn-primary" @click="loadMoreComments()">Load more</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../axios';

export default {
    name: 'NewsDetail',
    data () {
        return {
            loading: true,
            data: {
                name: '',
                picture: '',
                content: '',
            },
            comment: {
                items: [],
                currentPage: 1,
                lastPage: null,
                newName: '',
                newComment: '',
                loading: false,
                message: '',
                errors: {},
            },
        };
    },

    computed: {},

    methods: {
        async addComment () {
            const id = this.$route.params.id;

            this.comment.loading = true;
            this.comment.errors = {};

            try {
                await axios.post('/api/v1/news/' + id + '/comments', {
                    name: this.comment.newName,
                    comment: this.comment.newComment,
                });
            } catch (e) {
                this.comment.errors = e.response.data.errors;
                this.comment.loading = false;
                return;
            }

            await this.fetchData();

            this.newName = '';
            this.newComment = '';
            this.comment.message = 'Your comment has been added';
            this.comment.loading = false;
        },

        async loadMoreComments () {
            this.loading = true;
            this.comment.loading = true;

            const items = await this.fetchData(++this.comment.currentPage);

            this.comment.items.push(...items);
            this.loading = false;
            this.comment.loading = false;
        },

        async fetchData (page) {
            const id = this.$route.params.id;

            this.data = await axios.get('/api/v1/news/' + id).then(res => res.data.data);
            const commentsData = await axios.get('/api/v1/news/' + id + '/comments', {params: {page}});

            this.comment.items = commentsData.data.data;
            this.comment.lastPage = commentsData.data.meta.last_page;
        }
    },

    async created () {
        await this.fetchData();
        this.loading = false;
        this.comment.loading = false;
    }
};
</script>

<style scoped>

</style>
