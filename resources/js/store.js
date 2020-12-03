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
      pages: [{
        "id": 2,
        "name": "Page 0"
      }, {
        "id": 7,
        "name": "Page 1"
      }, {
        "id": 1,
        "name": "Page 2"
      }, {
        "id": 17,
        "name": "Page 3"
      }, {
        "id": 22,
        "name": "Page 4"
      }, {
        "id": 27,
        name: "Bablu"
      }],
      tiers: [{
        "id": 2,
        "name": "Petier 0"
      }, {
        "id": 7,
        "name": "Petier 1"
      }, {
        "id": 1,
        "name": "Petier 2"
      }, {
        "id": 17,
        "name": "Petier 3"
      }, {
        "id": 22,
        "name": "Petier 4"
      }],
      countries: [{
        "id": 2,
        "name": "Pakistan"
      }, {
        "id": 7,
        "name": "India"
      }, {
        "id": 1,
        "name": "Bangladesh"
      }, {
        "id": 17,
        "name": "Kerala"
      }, {
        "id": 22,
        "name": "Countryside"
      }],
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
        axios.get("/hehe")

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
         return state.category = data
      }
 }

})