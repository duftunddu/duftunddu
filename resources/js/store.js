import Vue from 'vue'
import Vuex from 'vuex'
import first from './components/pages/personcard.vue'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [createPersistedState({
      storage: window.sessionStorage,
    })], 
    state: {
      imageOrText: 0,
      adText: "",
      adLink: "",
      views: "",
      pages: [],
      tiers: [],
      countries: [],
      item: {
              page: [],
              tier: [],
              countrie: []
            }
    },
    mutations: {
        updateName (state, message) {
          state.name = message
        }
      },
    actions: {
      getDATAFROMTHEMADAFUCKINGAPI(context){
        axios.get("/ad_api")

               .then((response)=>{
                  console.log(response.data)
                  context.commit("addDataToStore",response.data) //categories will be run from mutation

               })

               .catch(()=>{
                  
                  console.log("Error........")
                  
               })
      }
    },
    mutations: {
      addDataToStore(state,data) {
         return [state.pages, state.tiers, state.countries, state.rates, state.images] = [data.pages, data.tiers, data.countries, data.rates, data.images]
      }
 }

})