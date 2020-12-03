<template>
  <div>
    <h1>TOTAL</h1>
    <h2>Pages ki ma ki</h2>
    <ul>
      <li v-for="page in store.state.item.page" :key="page">
        {{store.state.pages.filter(d => d.id === page)[0].name}}
        </li>
    </ul>
    <h2>Tiers ki ma ki</h2>
    <ul>
      <li v-for="tier in store.state.item.tier" :key="tier">
        {{store.state.tiers.filter(d => d.id === tier).map(d => d.name)[0]}}
        </li>
    </ul>
    <h2>Countrys ki ma ki</h2>
    <ul>
      <li v-for="countrie in store.state.item.countrie" :key="countrie">
        {{store.state.countries.filter(d => d.id === countrie).map(d => d.name)[0]}}
        </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      store: this.$store,
    };
  },
};
</script>