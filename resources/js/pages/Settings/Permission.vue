<template>
<div>
    <v-row align="center" >
        <v-col cols="3">
        <v-select
            v-model="selectedId"
            :items="roles"
            item-text="roleName"
            item-value="role_id"
            label="Select a Role"
            @change="changeAdmin"
            >
        </v-select>
        </v-col>
        <v-col cols="6">
            <v-btn class="float-left" color="primary" @click="assignRoles">Assign Permission</v-btn>
        </v-col>
    </v-row>

      <v-card class="overflow-hidden">
    <v-app-bar
      absolute
      color="white"
      elevate-on-scroll
      scroll-target="#scrolling-techniques-7"
    >
      <v-icon class="mr-5">mdi-account-key</v-icon>

      <v-toolbar-title> Assign Permission</v-toolbar-title>

      <v-spacer></v-spacer>
    </v-app-bar>
    <v-sheet
      id="scrolling-techniques-7"
      class="overflow-y-auto"
      max-height="700"
    >
      <v-container class="ma-10" style="height: 1500;" v-if="menusPermissions.length">
        <v-card
          max-width="900"
          class="mx-auto pa-5 ma-5"
          outlined
          v-for="item in menusPermissions" :key="item.menu_id"
        >
          <v-list-item three-line v-if="item.parent_id || item.parent_id === 0 && item.isActive === 1">
            <v-list-item-content>
            <v-row>
              <v-col
                cols="12"
                sm="12"
                md="3"
              >
                <v-text-field
                  label="Title"
                  v-model="item.title"
                ></v-text-field>
              </v-col>

              <v-col
                cols="12"
                sm="12"
                md="3"
              >
                <v-text-field
                  label="Icon"
                  v-model="item.icon"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="12"
                md="3"
              >
                <v-text-field
                  label="Path"
                  v-model="item.path"
                ></v-text-field>
              </v-col>

              <v-col
                cols="12"
                sm="12"
                md="3"
              >
                <v-text-field
                  label="Parent ID"
                  v-model="item.parent_id"
                ></v-text-field>
              </v-col>

              <div class="text-center">
                <v-btn class="ma-2">
                  <span class="hidden-sm-and-down">Active</span>
                    <v-checkbox v-model="item.isActive"></v-checkbox>
                </v-btn>
                <v-btn class="ma-2">
                  <span class="hidden-sm-and-down">Read</span>
                    <v-checkbox v-model="item.is_read"></v-checkbox>
                </v-btn>
                <v-btn class="ma-2">
                  <span class="hidden-sm-and-down">Write</span>
                    <v-checkbox v-model="item.is_create"></v-checkbox>
                </v-btn>
                <v-btn class="ma-2">
                  <span class="hidden-sm-and-down">Update</span>
                    <v-checkbox v-model="item.is_edit"></v-checkbox>
                </v-btn>
                <v-btn class="ma-2">
                  <span class="hidden-sm-and-down">Delete</span>
                    <v-checkbox v-model="item.is_delete"></v-checkbox>
                </v-btn>
                  <v-btn class="ma-2 white--text" small color="info"  @click="item.is_read = item.is_create = item.is_edit = item.is_delete = true;">Select All</v-btn>
                  <v-btn class="ma-2 white--text" small color="blue-grey" @click="item.is_read = item.is_create = item.is_edit = item.is_delete = false;">Unselect All</v-btn>
                </div>
            </v-row>

            </v-list-item-content>
          </v-list-item>
        </v-card>
      </v-container>
    </v-sheet>
  </v-card>
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
      filteredMenu(){
          return this.menus.filter(menu => menu.parent_id === 0)
      },
    },
    methods: {
      changeAdmin(){
        let index = this.roles.findIndex(role => role.role_id == this.selectedId)
        let permission = this.roles[index].permission
        let combines = this.menus.concat(JSON.parse(permission));
        const uniqueObjects = [...new Map(combines.filter(item=>item).map(item => [item.menu_id,item])).values()]
        // console.log(uniqueObjects)

        if(!permission){
            this.menusPermissions = this.menus
        }else{
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