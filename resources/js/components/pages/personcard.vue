<template>
  <div id="demo">
  <Tabs/></Tabs>
    <h2>Select Page:</h2>
  <div v-for="page in store.state.pages">
    <input type="checkbox" v-model="store.state.item.page" :id="'page_' + page.id" :value="page.id"  />
    <label> {{ page.name }}</label>
    <img :src="store.state.images[page.id-1].string" width="200"/>
    <p>Page Rate: {{store.state.rates.pages[page.id-1].rate}}</p>
    <p>Average Page Views: {{store.state.pages[page.id-1].views}}</p>
  </div>
    <h2>Ad Type:</h2>
    <input type="radio" v-model="store.state.imageOrText" value="0">Text Link
    <input type="radio" v-model="store.state.imageOrText" value="1">Image Link<br>
    <label>Ad text:</label><input v-model="store.state.adText">
    <label>Ad link:</label><input v-model="store.state.adLink" >
    <span v-if="store.state.imageOrText == 1">
    <label>Choose Image:</label><input type="file">
    </span>
    <select v-model="store.state.views">
      <option disabled value="">Please select one</option>
      <option v-for="item in store.state.rates.views" :value="item.id">{{item.count}} views for {{item.cost}}$</option>
    </select>
    <button><router-link to="/admin/secondpg">Click Me!</router-link></button>
</div>
</template>

<script>
import Tabs from '../Tabs'

export default {
  data(){
    return {
      store: this.$store
    }
  },
  components: {
    Tabs
  },
  mounted() {
        this.$store.dispatch("getDATAFROMTHEMADAFUCKINGAPI")
      }
}
</script>
