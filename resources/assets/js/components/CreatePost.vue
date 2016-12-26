<template>
    <div>
        <div v-if="$root.authenticated">
            <div class="column" v-if="error">
                <p class="notification is-danger">Ошибка при добавлении поста</p>
            </div>
            <form class="column" @submit.prevent="send">

                <label class="label">Название поста</label>
                <p class="control">
                    <input type="text" class="input" v-model.trim="title" />
                    <span class="help is-danger" v-if="error && response.hasOwnProperty('title')">{{ response.title[0] }}</span>
                </p>


                <label class="label">Содержание</label>
                <p class="control">
                    <textarea class="textarea" v-model.trim="content" rows="5"></textarea>
                    <span class="help is-danger" v-if="error && response.hasOwnProperty('content')">{{ response.content[0] }}</span>
                </p>

                <label class="label">Теги</label>
                <p class="control">
                    <select multiple v-model="selected_tags">
                        <option v-for="(value, key) in tags" :value="key">{{ value }}</option>
                </select>
                    <span class="help is-danger" v-if="error && response.hasOwnProperty('tags')">
                    {{ response.tags[0] }}
                    </span>
                </p>

                <p class="control">
                    <button class="button is-primary" type="submit">Добавить</button>
                </p>

            </form>
        </div>
        <div class="column" v-else>
            <p class="notification is-dark"> Вы должны зайти в свой профиль</p>
        </div>
    </div>

</template>


<script>

    export default {


        data() {
            return {
                selected_tags: [],
                tags: [],
                title: "",
                content: "",
                error: false,
                response: {}
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {

                this.$http.get('/api/posts/create')
                    .then((response) => {
                        console.log(response);
                        this.tags = response.data;
                    })
                    .catch((error) => {
                        console.log(error)
                    });


            },

            send(event) {
                if (!this.$root.authenticated) {
                    return;
                }
                console.log(this.title);
                console.log(this.content);
                console.log(this.selected_tags);

                this.$http.post('/api/posts', {
                    title: this.title,
                    content: this.content,
                    tags: this.selected_tags
                })
                    .then((response) => {
                        console.log(response);
                        this.$router.push(
                            { name: 'post', params: { slug: response.data.slug } }
                        )
                    })
                    .catch((error) => {
                        let e = {...error};
            this.error = true;
            console.log(e.response.data);
            this.response = e.response.data
        });
    }
        }



    }
</script>