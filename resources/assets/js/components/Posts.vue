<template>
    <div>


        <div class="column" v-if="$root.authenticated">
            <router-link class="button is-primary" :to="{ name: 'create_post'}">
                Добавить пост
            </router-link>
        </div>
        <div class="column">
            <div class="box" v-for="post in posts">

                <article class="media">
                    <figure class="media-left" @click="view(post.user.name)">
                        <figure class="image is-48x48">
                            <img :src="post.user.avatar" />
                        </figure>
                    </figure>
                    <div class="media-content">
                        <div class="content">

                            <strong>{{ post.user.name}}</strong> <small>{{ post.created_at }}</small>
                            <br/>
                            <strong>
                        <router-link :to="{ name: 'post', params: { slug: post.slug }}">{{ post.title }}</router-link>
                    </strong>
                            <br/>
                            <p style="text-align: justify"> {{ stringLimit(post.content)}}
</p>

</div>

</div>
</article>
</div>
</div>
</div>
</template>

<script>

    export default {


        data() {
            return {
                posts: [

                ]
            }
        },

        watch: {
            '$route'(to, from) {
                this.load();
            }
        },

        created() {
            this.load();

        },

        methods: {


            load() {
                if (this.$route.name == 'user_posts') {
                    this.fetchByUser();
                } else if (this.$route.name == 'tag') {
                    this.fetchByTag();
                } else {
                    this.fetchAll();
                }
            },


            view(name) {
                this.$router.push(
                    { name: 'user', params: { name: name } }
                )
            },

            fetchAll() {




                this.$http.get('/api/posts')
                    .then((response) => {
                        console.log(response);
                        this.posts = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });


            },

            fetchByUser() {




                this.$http.get('/api/users/' + this.$route.params.name + "/posts")
                    .then((response) => {
                        console.log(response);
                        this.posts = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });


            },

            fetchByTag() {


                this.$http.get('/api/tags/' + this.$route.params.name)
                    .then((response) => {
                        console.log(response);
                        this.posts = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });


            },
            stringLimit(str) {
                if (str.length > 100)
                    str = str.substring(0, 100) + "...";
                return str;
            }
        }



    }
</script>