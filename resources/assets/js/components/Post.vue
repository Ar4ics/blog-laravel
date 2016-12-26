<template>
    <div>

        <div class="column">
            <h1 class="title is-1 has-text-centered">
                {{ post.title }}
            </h1>
            <p style="text-align: justify">{{ post.content }}</p>
<p>
    <small>@<router-link :to="{ name: 'user', params: { name: post.user.name }}">{{post.user.name}}</router-link></small>
    <small>{{post.created_at}}</small>
</p>
</div>
<div class="column">
    <router-link v-for="tag in post.tags" :to="{ name: 'tag', params: { name: tag.name }}" class="tag is-info">{{ tag.name }}</router-link>
</div>



<div class="column">
    <div v-for="comment in post.comments">
        <article class="media">
            <div class="media-left" @click="view(comment.user.name)">
                <figure class="image is-32x32">
                    <img :src="comment.user.avatar" alt="avatar">
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{comment.user.name}}</strong> <small>{{comment.created_at}}</small>
                        <br> {{comment.comment}}
                    </p>
                </div>

            </div>
        </article>
    </div>
</div>


<div class="column">
    <form @submit.prevent="send">

        <label class="label">Ваш коммент</label>
        <p class="control">
            <textarea class="textarea" v-model.trim="comment" rows="5"></textarea>
            <span class="help is-danger" v-if="response.hasOwnProperty('comment')">{{ response.comment[0] }}</span>
        </p>

        <p class="control" v-if="$root.authenticated">
            <button type="submit" class="button">
                        Добавить
                    </button>
        </p>
        <p v-else>Войдите, чтобы оставить коммент!</p>
    </form>
</div>
</div>
</template>

<script>

    export default {


        data() {
            return {
                post: {
                    user: {},
                    comments: []
                },
                response: {},

                comment: ""



            }
        },

        created() {
            this.fetch();
        },

        methods: {

            view(name) {
                this.$router.push(
                    { name: 'user', params: { name: name } }
                )
            },


            fetch() {
                this.$http.get('/api/posts/' + this.$route.params.slug)
                    .then((response) => {
                        console.log(response);
                        this.post = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });


            },

            send(event) {



                this.$http.post('/api/comment/' + this.$route.params.slug, { comment: this.comment })
                    .then((response) => {
                        console.log(response);
                        let comment = response.data.comment;
                        this.post.comments.push(comment);
                        this.comment = "";
                        this.response = {};
                    })
                    .catch((error) => {
                        let e = {...error};
                        console.log(e.response.data);
                        this.response = e.response.data
                    });
            }
        }



    }
</script>