<template>
  <div>
    <v-container fluid>
      <v-row align="center">
        <v-col cols="3">
          <v-autocomplete
              v-model="selectedId"
              label="Select a Role"
              :items="roles"
              :item-text="roleName"
              item-value="role_id"
              @change="changeAdmin"
              dense
              filled
          ></v-autocomplete>
        </v-col>
        <v-col cols="6">
          <v-btn class="float-left" color="primary" v-show="selectedId"  @click="assignRoles"
            >Assign Permission</v-btn
          >
        </v-col>
      </v-row>
      <v-simple-table fixed-header height="700px" v-if="filteredMenuParent.length">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Title</th>
              <th class="text-left">Read</th>
              <th class="text-left">Write</th>
              <th class="text-left">Update</th>
              <th class="text-left">Delete</th>
              <th class="text-left">Select/Unselect</th>
            </tr>
          </thead>
          <tbody v-for="menu in menus" :key="menu.menu_id">
            <tr
              v-for="item in menusPermissions"
              :key="item.menu_id"
              v-if=" menu.menu_id === item.menu_id && menu.isActive === 1"
            >
              <td>
                <span class="font-weight-bold" v-if="menu.parent_id === 0"><v-icon>{{menu.icon}}</v-icon> {{menu.title}}</span> 
                <span v-else class="ml-5 font-weight-light"><v-icon>{{menu.icon}}</v-icon> {{menu.title}}</span> 
              </td>
              <td><v-checkbox v-model="item.is_read"></v-checkbox></td>
              <td><v-checkbox v-model="item.is_create"></v-checkbox></td>
              <td><v-checkbox v-model="item.is_edit"></v-checkbox></td>
              <td><v-checkbox v-model="item.is_delete"></v-checkbox></td>
              <td>
                <v-btn
                  class="ma-2 white--text"
                  small
                  color="info"
                  @click="item.is_read = item.is_create = item.is_edit = item.is_delete = 1;"
                  >Select All</v-btn
                >
                <v-btn
                  class="ma-2 white--text"
                  small
                  color="blue-grey"
                  @click="item.is_read = item.is_create = item.is_edit = item.is_delete = 0;"
                  >Unselect All</v-btn
                >
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
      <!-- overlay loader -->
      <v-overlay :value="rs_overlay" style="position:absolute;" light color="#ececec">
        <v-progress-circular :width="5" color="green" indeterminate></v-progress-circular>
      </v-overlay>
    </v-container>
  </div>
</template>

<script>
export default {
  data(){
  return {
      menusPermissions: [],
    }
  },
  computed: {
    roles() {
      return this.$store.getters['Role/roles'];
    },
    menus() {
      return this.$store.getters['Menu/menus'];
    },
    selectedId: {
      get() {
        return this.$store.getters['Permission/selectedId'];
      },
      set(id) {
        this.$store.dispatch('Permission/updateId',id)
      }
    },
    rs_overlay() {
        return this.$store.getters['Permission/rs_overlay'];
    },
    filteredMenuParent(){
        return this.menusPermissions.filter(menu => menu.parent_id === 0 || menu.parent_id)
    },
  },
  methods: {
    roleName(item){
        return item.roleName;
    },
    changeAdmin(){
      let index = this.roles.findIndex(role => role.role_id == this.selectedId)
      let permission = this.roles[index].permission
      let combines = this.menus.concat(JSON.parse(permission));
      const uniqueObjects = [...new Map(combines.filter(item=>item).map(item => [item.menu_id,item])).values()]
      // console.log(uniqueObjects)
      if(!permission){
          this.menusPermissions = this.menus
      }else{
          this.rs_overlay = false
          this.menusPermissions = uniqueObjects
      }
    },
    async assignRoles(){
      this.$store.dispatch('Permission/assignRoles',this.menusPermissions);
    },
  },
  created() {
      this.$store.dispatch('Role/getRoles')
      this.$store.dispatch('Menu/getMenus')
  },
}
</script>
