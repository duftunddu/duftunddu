<template>
  <!-- <div>
    <h1>first tier</h1>
    <td>Input some data:</td>
    <td><input type="text" v-model="name" @keyup.enter="submit" /></td>
    <button><router-link to="/secondpg">Click Me!</router-link></button>
  </div> -->
  <div id="demo">
    <h2>TIERS KI MAA KI</h2>
  <div v-for="tier in store.state.tiers">
    <input type="checkbox" v-model="store.state.item.tier" :id="'tier_' + tier.id" :value="tier.id"  />
    <label>{{ tier.name }}</label>
  </div>
    <h2>countries KI MAA KI</h2>
  <div v-for="countrie in store.state.countries">
    <input type="checkbox" v-model="store.state.item.countrie" :id="'countrie_' + countrie.id" :value="countrie.id"  />
    <label>{{ countrie.name }}</label>
  </div>
    <button><router-link to="/admin/thirdpg">Click Me!</router-link></button>
</div>
</template>

<script>
export default {
  data(){
    return {
      store: this.$store
    }
  }
}
</script>
