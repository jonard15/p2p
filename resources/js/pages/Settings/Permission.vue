<template>
<div>
    <v-breadcrumbs :items="breadcrums">
    <template v-slot:item="{ item }">
      <v-breadcrumbs-item
        :href="item.href"
        :disabled="item.disabled"
      >
        {{ item.text.toUpperCase() }}
      </v-breadcrumbs-item>
    </template>
  </v-breadcrumbs>
  <v-container>
          <v-row  class="pa-5" align="center">
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
<!-- <v-toolbar
  elevation="4"
  v-for="item in filteredMenuParent"
    :key="item.menu_id"


></v-toolbar> -->

<v-card

    class="ma-5"
    max-width="600"
    tile
  >
    <v-list v-for="item in filteredMenuParent"
    :key="item.menu_id">
          <v-list-item>
                    <!-- <v-list-item-content>
           <v-icon v-text="item.icon"></v-icon>
          </v-list-item-content> -->
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
                    <v-list-item-content>
                      <v-checkbox
              label="Read"
            ></v-checkbox>
          </v-list-item-content>
                              <v-list-item-content>
                      <v-checkbox
              label="Write"
            ></v-checkbox>
          </v-list-item-content>
                              <v-list-item-content>
                      <v-checkbox
              label="Update"
            ></v-checkbox>
          </v-list-item-content>
                              <v-list-item-content>
                      <v-checkbox
              label="Delete"
            ></v-checkbox>
          </v-list-item-content>
                              <v-list-item-content>
                      <v-btn
              color="primary"
              small
            >Select all</v-btn>
          </v-list-item-content>
    </v-list-item>
      <v-list-item-group
        v-model="selectedItem"
        color="primary"
      >
        <v-list-item
          v-for="(child, i) in filteredChildMenu"
          :key="i"
          v-if="item.menu_id === child.parent_id"
        >
          <!-- <v-list-item-icon>
            <v-icon v-text="child.icon"></v-icon>
          </v-list-item-icon> -->
                    <!-- <v-list-item-content>
           <v-icon v-text="child.icon"></v-icon>
          </v-list-item-content> -->
          <v-list-item-content>
            <v-list-item-subtitle v-text="child.title"></v-list-item-subtitle>
          </v-list-item-content>
                    <v-list-item-content>
                      <v-checkbox
              label="Read"
            ></v-checkbox>
          </v-list-item-content>
                              <v-list-item-content>
                      <v-checkbox
              label="Write"
            ></v-checkbox>
          </v-list-item-content>
                              <v-list-item-content>
                      <v-checkbox
              label="Update"
            ></v-checkbox>
          </v-list-item-content>
                              <v-list-item-content>
                      <v-checkbox
              label="Delete"
            ></v-checkbox>
          </v-list-item-content>
                              <v-list-item-content>
                      <v-btn
              color="primary"
              small
            >Select all</v-btn>
          </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
      </v-list-item-group>
    </v-list>
  </v-card>
  </v-container>

</div>
</template>

<script>
export default {
  data(){
  return {
      breadcrums: [
        {
          text: 'Home',
          disabled: false,
          href: '/dashboard',
        },
        {
          text: 'Permissions',
          disabled: false,
        },
      ],
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
        return this.menusPermissions.filter(menu => menu.parent_id === 0 && menu.isActive === 1)
    },
      filteredChildMenu(){
          return this.menusPermissions.filter(menu => menu.parent_id != 0 && menu.isActive === 1)
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
