<template>
  <div id="demo">
    <h2>Select Tiers:</h2>
  <div v-for="tier in store.state.tiers">
    <input type="checkbox" v-model="store.state.item.tier" :id="'tier_' + tier.id" :value="tier.id"  />
    <label>{{ tier.name }}</label>
  </div>
    <h2>Select Countries:</h2>
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
