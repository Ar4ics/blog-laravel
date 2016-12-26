<template>
    <div class="column">

<table class="table">
  <thead>
    <tr>
      <th>Тег</th>
      <th>Количество постов</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="tag in tags">
      <td><span><router-link :to="{ name: 'tag', params: { name: tag.name }}">{{ tag.name }}</router-link></span></td>
      <td><span class="tag is-info">{{ tag.articles_count }}</span></td>
    </tr>
  </tbody>
</table>

    </div>
</template>

<script>

    export default {


        data() {
            return {
                tags: []
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                


                this.$http.get('/api/tags')
                .then((response) => {
                    console.log(response);
                    this.tags = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });


            }
  }
}

</script>
