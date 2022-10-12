export default {
  namespaced: true,

  state:
  {
    selectedId: null,
    userPermission: [],
    rs_overlay: false,
  },

  getters:{
    selectedId(state){
        return state.selectedId
    },
    getPermisssion(state){
      return state.userPermission
    },
    rs_overlay(state){
      return state.rs_overlay
    },
  },

  mutations: 
  {
      updateResources: (state,payload) =>{
          state.resources = payload
      },
      updateId: (state,payload) =>{
          state.selectedId = payload
      },
      updaters_overlay: (state,payload) =>{
        state.rs_overlay = payload
      },
      assignRoles: (state,menus) => {
          state.rs_overlay = true
          let data = JSON.stringify(menus)
          axios.post('assign/permission', {'permission' : data, role_id: state.selectedId}).then((response) =>{
            if(response.status == 200){
              toast.fire({
                icon: 'success',
                title: "Permission successfully updated"
            })
              state.rs_overlay = false
            }
          }).catch(error => console.log(error))
      },
      setUserPermission(state, data){
        state.userPermission = data
    }
  },

  actions: 
  {
    updateResources({commit},payload){
        commit('updateResources',payload);
    },
    updateId({commit},payload){
        commit('updateId',payload);
    },
    updaters_overlay({commit},payload){
      commit('updaters_overlay', payload);
    },
    updatersoverlay({commit},payload){
      commit('updatersoverlay',payload);
  },
    assignRoles({commit},menus){
        // location.reload();
        commit('assignRoles',menus);
    },
    getUserPermission({commit}){
      axios.get('permission').then((response) =>{
        commit('setUserPermission', response.data)
    }).catch(error => console.log(error))
    }
  },
};
