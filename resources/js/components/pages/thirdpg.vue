<template>
  <div>
    <h1>Summary</h1>
    <h2>Selected Pages:</h2>
    <ul>
      <li v-for="page in store.state.item.page" :key="page">
        {{store.state.pages.filter(d => d.id === page)[0].name}} - {{store.state.rates.pages.filter(d => d.id === page)[0].rate}}$
        </li>
    </ul>
    <h2>Selected Tiers:</h2>
    <ul>
      <li v-for="tier in store.state.item.tier" :key="tier">
        {{store.state.tiers.filter(d => d.id === tier).map(d => d.name)[0]}} - {{store.state.rates.tiers.filter(d => d.id === tier)[0].rate}}$
        </li>
    </ul>
    <h2>Selected Countrys:</h2>
    <ul>
      <li v-for="countrie in store.state.item.countrie" :key="countrie">
        {{store.state.countries.filter(d => d.id === countrie).map(d => d.name)[0]}}- {{store.state.rates.countries.filter(d => d.id === countrie)[0].rate}}$
        </li>
    </ul>
    <h2>Views:</h2>
    {{store.state.rates.views[store.state.views-1].count}} - {{store.state.rates.views[store.state.views-1].cost}}
    <h2>Total Cost:</h2>
    {{total}}
  </div>
</template>

<script>
export default {
  data() {
    return {
      store: this.$store,
    };
  },
  computed: {
    total(){
      let total = 0;
      let pagesum = 0;
      let tiersum = 0;
      let contsum = 0;
      this.$store.state.item.page.map(d => pagesum += parseFloat(this.$store.state.rates.pages[d-1].rate));
      this.$store.state.item.tier.map(d => tiersum += parseFloat(this.$store.state.rates.tiers[d-1].rate));
      this.$store.state.item.countrie.map(d => contsum += parseFloat(this.$store.state.rates.countries[d-1].rate));
      console.log(pagesum);
      console.log(tiersum);
      console.log(contsum);
      return this.$store.state.rates.views[this.$store.state.views-1].cost * pagesum * tiersum * contsum;
    }
  }
};
</script>