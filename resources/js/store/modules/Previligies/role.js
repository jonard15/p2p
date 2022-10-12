export default {
    namespaced: true,

    state:
    {
        roles: [],
        editedIndex: -1,
        defaultItem: {
          role_id: '',
          roleName: '',
        },
        editedItem: {
            role_id: '',
            roleName: '',
          },

    },

    getters:{
        roles: state => {
            return state.roles
        },
        editedIndex: state => {
            return state.editedIndex
        },
        defaultItem: state => {
            return state.defaultItem
        },
        editedItem: state => {
            return state.editedItem
        }
    },

    mutations: 
    {
        updateDialog: (state,payload) =>{
            state.dialog = payload
        },
        updateDialogDelete: (state,payload) =>{
            state.dialogDelete = payload
        },
        updateEditedIndex: (state,payload) =>{
            state.editedIndex = payload
        },
        updateDefaultItem: (state,payload) =>{
            state.defaultItem = payload
        },
        updateEditItem: (state,payload) =>{
            state.editedItem = payload
        },
        add_role(state,data){
            state.roles.push(data)
        },
        update_role(state,data){
            const index = state.roles.findIndex(role => role.role_id === data.role_id);
            if(index !== -1) {
                state.roles.splice(index, 1, data);
            }
        },
        remove_role(state,data){
            state.todos = state.todos.filter((todo) => todo.id !== data)
        },
        set_roles(state,data){
            state.roles = data
        },     
    },

    actions: 
    {
        updateEditedIndex({commit},payload){
            commit('updateEditedIndex',payload);
        },
        updateDefaultItem({commit},payload){
            commit('updateDefaultItem',payload);
        },
        updateEditItem({commit},payload){
            commit('updateEditItem',payload);
        },
        addRole({commit}, data) {
            axios.post('role/create', data)
                .then(response => {
                toast.fire({
                    icon: 'success',
                    title: "role create succefully"
                })
                commit('add_role', response.data)
                })
                .catch(error => console.log(error))
                toast.fire({
                    icon: 'error',
                    title: "Cannot create role, try again"
            })
            },
            updateUser({commit},data){
                axios.put(`/role/update/${data.role_id}`,data).then((response) =>{
                    toast.fire({
                        icon: 'success',
                        title: "role successfully updated"
                    })
                    commit('update_role', response.data)
                }).catch(error => console.log(error))
            },
            removeRole({commit},data){
                axios.delete('delete/role/'+data.role_id).then((response) =>{
                    toast.fire({
                        icon: 'success',
                        title: "role successfully deleted"
                    })
                    commit('remove_role', response.data)
                }).catch(error => console.log(error))
            },
          getRoles({commit}){
            axios.get('roles').then((response) =>{
                commit('set_roles', response.data)
            }).catch(error => console.log(error))
        },

    },

  };
