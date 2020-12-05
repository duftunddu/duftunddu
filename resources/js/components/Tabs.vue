<template>
  <div>
    <div class="tabs">
      <div class="tabs-card">
        <span class="item">Upload Ad and choose Ad page</span>
        <span class="item">Choose demographic</span>
        <span class="item">Receipt</span>
      </div>
    </div>
    <!-- <router-link to="/ad/first"> Upload Ad and choose Ad page</router-link>
    <router-link to="/ad/second">Choose demographic</router-link>
    <router-link to="/ad/third"> Receipt</router-link> -->
  </div>
</template>

<style scoped>
.tabs {
  display: flex;
  justify-content: center;
  /* width: 100%; */
}
.tabs-card {
  /* display: flex; */
  /* width: 100%; */
  /* justify-content: center; */
  justify-content: space-evenly;
}

.item {
  /* flex: 1; */
  flex: 33%;
  /* width: 33%; */
}
</style>
