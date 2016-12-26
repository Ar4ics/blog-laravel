<template>
    <div class="column">
        <div class="tile is-ancestor" v-if="!error">
            <div class="tile is-vertical is-8">
                <div class="tile">

                    <div class="tile is-parent">
                        <div class="tile is-child notification hero box">

                            <div class="hero-body">
                                <figure class="image is-128x128" style="margin: auto">
<img :src="user.avatar" />
</figure>
<p class="has-text-centered">
    <span class="tag is-dark is-medium">
                                        {{ user.name }}
                                    </span>
    <span class="tag is-info is-medium"><router-link :to="{ name: 'user_posts', params: { name: user.name }}">
        Посты - {{ user.count}} 
        </router-link></span>
</p>
</div>
</div>
</div>

<div class="tile is-parent is-vertical">
    <article class="tile is-child notification is-primary">
        <p class="title">Краткая информация</p>
        <p class="subtitle">{{user.info == null ? "Пока пусто" : user.info}}</p>
    </article>
    <article class="tile is-child notification is-warning">
        <p class="title">Звание / Должность</p>
        <p class="subtitle">{{user.rank == null ? "Нету" : user.rank}}</p>
    </article>
</div>

</div>
</div>
<div class="tile is-parent" v-if="$root.authenticated && $root.user.id == user.id">
    <article class="tile is-child notification is-success">
        <div class="content">
            <p class="title">Настройки</p>
            <div class="content">

                <form @submit.prevent="send">

                    <label class="label">Звание</label>
                    <p class="control">
                        <input type="text" class="input" v-model.trim="rank" />
                    </p>
                    <label class="label">Информация</label>
                    <p class="control">
                        <textarea class="textarea" v-model.trim="info" rows="5"></textarea>
                    </p>
                    <label class="label">Картинка</label>
                    <p class="control">
                        <input ref="avatar" class="input" type="file" />
                    </p>
                    <p class="control">
                        <button type="submit" class="button is-info">Сохранить 
                                
                                </button>
                    </p>
                </form>

            </div>
        </div>
    </article>
</div>
</div>

<div v-else>
    <p class="notification is-dark">Пользователь не найден</p>
</div>

</div>




</template>

<script>
    export default {
        data() {
            return {
                user: {},
                info: "",
                rank: "",
                error: false,
                fileUploadFormData: new FormData()
            }
        },

        watch: {
            '$route'(to, from) {
                this.load()
            }
        },



        methods: {

            load() {

                if (this.$root.authenticated && this.$route.params.name == this.$root.user.name) {
                    this.user = this.$root.user;
                }
                else {
                    this.fetch()
                }
            },



            fetch() {
                this.$http.get('/api/users/' + this.$route.params.name)
                    .then((response) => {
                        console.log(response);
                        this.user = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                        this.error = true;

                    })


            },

            send(e) {
                this.fileUploadFormData.append('avatar', e.target[2].files[0]);
                this.fileUploadFormData.append('info', this.info);
                this.fileUploadFormData.append('rank', this.rank);
                //console.log(e)
                this.$http.post('/api/users/' + this.$root.user.id, this.fileUploadFormData)
                    .then((response) => {
                        console.log(response);
                        this.user.avatar = response.data.avatar;
                        this.user.info = response.data.info;
                        this.user.rank = response.data.rank;
                        this.info = "";
                        this.rank = "";
                        this.$refs.avatar.value = "";
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }


        },
        created() {

            this.load();
        }
    }
</script>