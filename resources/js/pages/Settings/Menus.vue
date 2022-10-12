<template>
    <v-card class="overflow-hidden pa-5">
      <v-app-bar
        absolute
        color="white"
        elevate-on-scroll
        scroll-target="#scrolling-techniques-7">
        <v-toolbar-title class="font-weight-black">Menu Management</v-toolbar-title>
      </v-app-bar>
      
      <v-sheet
        id="scrolling-techniques-7"
        class="overflow-y-auto"
        max-height="800">
        <v-container style="height: 100%;">
          <v-row class="ma-10">
            <v-col
              cols="12"
              sm="6"
              md="6"
            >

              <v-card
                class="mx-auto mb-10 pa-5"
                max-width="750"
                outlined>
                      <v-sheet
        id="scrolling-techniques-7"
        class="overflow-y-auto"
        max-height="500">
        <v-container style="height: 100%;">
              <v-card-title>
                Menu Active
                <v-spacer></v-spacer>
              </v-card-title>
                <draggable v-model="menus" @change="updateSorting">
                  <transition-group>
                    <v-list-item v-for="item in menus" :key="item.menu_id" >
                        <v-list-item-content v-if="item.isActive == 1">
                          <v-card
                              max-width="500"
                              color="#385F73"
                              dark
                              v-if="item.parent_id == 0">
                              <v-card-actions>
                                <v-card-text class="font-weight-light"> <v-icon> {{item.icon}}</v-icon> {{item.title}}</v-card-text>
                                <v-spacer></v-spacer>
                                    <v-btn icon
                                      @click="editItem(item)"
                                    ><v-icon >mdi-pencil</v-icon></v-btn>
                              </v-card-actions>
                          </v-card>
                          <v-card 
                              class="mx-auto mt-2 "
                              max-width="500"
                              color="#1F7087"
                              dark 
                              v-if="item.parent_id">
                                <v-card-actions>
                                  <v-card-text class="font-weight-light"> <v-icon> {{item.icon}}</v-icon> {{item.title}}</v-card-text>
                                  <v-spacer></v-spacer>
                                    <v-btn icon
                                      @click="editItem(item)"
                                    ><v-icon >mdi-pencil</v-icon></v-btn>
                              </v-card-actions>
                          </v-card>
                        </v-list-item-content>
                    </v-list-item>
                  </transition-group>
                </draggable>
                        </v-container>
</v-sheet>
              </v-card>

                <!-- <v-card
                class="mx-auto pa-5"
                max-width="750"
                outlined
              >
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-list-item-title class="text-h5 mb-1">
                      Menu Inactive
                    </v-list-item-title>
                    <v-card
                        class="mx-auto mt-2 "
                        max-width="500"
                        color="error"
                        dark
                        v-for="item in menus" :key="item.title"
                      >
                        <v-card-actions v-if="item.isActive == 0">
                            <v-card-text class="font-weight-bold"> <v-icon> mdi-account</v-icon> {{item.title}} </v-card-text>
                            <v-spacer></v-spacer>

                            <v-btn icon  @click="editItem(item)">
                            <v-icon>mdi-replay</v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                  </v-list-item-content>
                </v-list-item>
              </v-card> -->
            </v-col>

            <v-col
              cols="6"
              md="6">
              <v-card
                class="mx-auto pa-5"
                max-width="800"
                outlined
              >
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-list-item-title class="text-h5 mb-1">
                        Menu
                    </v-list-item-title>

                    <v-form ref="form">
                <v-text-field
                  v-model="editedItem.title"
                  required
                  label="Title"
                ></v-text-field>
                <v-text-field
                  v-model="editedItem.icon"
                  label="Icon"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="editedItem.path"
                  label="Path"
                  required
                ></v-text-field>
                        <v-select
                        v-model="editedItem.parent_id"
                        :items="filteredMenu"
                        item-text="title"
                        item-value="menu_id"
                        label="Select a Menu"
                        ></v-select>
                
                <v-checkbox
                  v-model="editedItem.isActive"
                  label="Active"
                  required
                ></v-checkbox>

                <v-btn
                  class="mr-4"
                  color="primary"
                  @click="save"
                >
                  Save
                </v-btn>
                <v-btn
                  color="primary"
                  class="mr-4"
                  @click="reset"
                >
                  Reset Form
                </v-btn>
              </v-form>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-sheet>

    </v-card>
</template>
<script>
import draggable from 'vuedraggable'
export default {
    components: {
        draggable,
    },
    data() {
        return {
            menus: []
        }
    },
    computed : {
      // cardTitle () {
      //   return this.editedIndex === -1 ? 'New Menu' : 'Edit Menu'
      // },
      filteredMenu(){
          return this.menus.filter(menu => menu.parent_id === 0)
      },

      // menus: {
      //   get(){
      //     return this.$store.getters['Menu/menus'];
      //   },
      //          set(index) {
      //     this.$store.dispatch('Menu/updateEditedIndex',index)
      //    },

      //   },

        editedIndex: {
          get() {
            return this.$store.getters['Menu/editedIndex'];
          },
          set(index) {
            this.$store.dispatch('Menu/updateEditedIndex',index)
          },
        },

      defaultItem: {
        get() {
          return this.$store.getters['Menu/defaultItem'];
        },
        set(form) {
          this.$store.dispatch('Menu/updateDefaultItem',form)
         },
        },

        editedItem: {
          get() {
            return this.$store.getters['Menu/editedItem'];
          },
          set(form) {
            this.$store.dispatch('Menu/updateEditItem',form)
          },
        },
    },

    methods:{
      getMenus()
      {
        axios.get('menus').then((response) =>{
          let data = response.data;
          this.menus = data.filter(menu => menu.menu_id);
        }).catch(error => console.log(error))
      },
      save () 
      {
        if (this.editedIndex > -1) {
          this.$store.dispatch('Menu/updateMenu', this.editedItem);
          Object.assign(this.roles[this.editedIndex], this.editedItem)
        } else {
           this.$store.dispatch('Menu/addMenu', this.editedItem);
        }       
      },
      editItem (item) 
      {
        this.editedIndex = this.menus.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

    updateSorting() 
    {
        this.menus.map((menu, index) => {
            menu.sorting = index + 1;
            // console.log(menu.menu_id);
            // console.log(index + 1);
        })
        axios.put('menu/sorting', {
            menus: this.menus
        }).then((response) => {
            // success message
        })
    },
      reset () {
        this.$refs.form.reset()
        location.reload();
      },
              
    },
    created () {
        this.$store.dispatch('Menu/getMenus')
        this.getMenus();
      },

}
</script>