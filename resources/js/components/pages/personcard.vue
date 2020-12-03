<template>
  <!-- <div>
    <h1>first page</h1>
    <td>Input some data:</td>
    <td><input type="text" v-model="name" @keyup.enter="submit" /></td>
    <button><router-link to="/secondpg">Click Me!</router-link></button>
  </div> -->
  <div id="demo">
  <div v-for="page in store.state.pages">
    <input type="checkbox" v-model="store.state.item.page" :id="'page_' + page.id" :value="page.id"  />
    <label>Page# {{ page.id }}</label>
  </div>
    <button><router-link to="/admin/secondpg">Click Me!</router-link></button>
</div>
</template>

<script>
export default {
  data(){
    return {
      store: this.$store
    }
  },
  mounted() {
        this.$store.dispatch("getDATAFROMTHEMADAFUCKINGAPI")
      }
}
</script>
