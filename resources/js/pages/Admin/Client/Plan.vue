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
  <v-data-table
    :headers="headers"
    :items="plans"
    :search="search"
    sort-by="id"
    class="elevation-1"
  >
  
    <template v-slot:top>
      <v-text-field
        v-model="search"
        label="Search"
        class="mx-4 code"
      ></v-text-field>
      <v-toolbar flat class="px-0">
        <v-toolbar-title>Plans</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="1700px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn x-small fab color="primary" dark v-bind="attrs" v-on="on">
              <v-icon dark> mdi-plus </v-icon>
            </v-btn>
          </template>

          <v-form ref="form" >
            <v-card class="py-5">
              <v-card-title class="px-5">
                <span class="text-h6">{{ formTitle }}</span>
              
                <v-container
                      class="px-8"
                      fluid
                 >
               
               
                  </v-container>
              </v-card-title>
              
              <v-card-text>
              <v-container>
                  <v-row>
                  <v-col
                      cols="12"
                      sm="12"
                      md="10"
                  >
                      <v-text-field
                      v-model="plan_items.name"
                      label="Full Name*"
                      ></v-text-field>
                  </v-col>
                  <v-col 
                        cols="12"
                        sm="12"
                        md="5"
                    >
                        <v-select
                            v-model="plan_items.term_mode"
                            :items="['Month', 'Year']"
                            label="Term Mode"
                        ></v-select>
                  </v-col>
                  <v-col 
                        cols="12"
                        sm="12"
                        md="5"
                    >
                        <v-select
                            v-model="plan_items.term_no"
                            :items="['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']"
                            label="Term No"
                        ></v-select>
                  </v-col>
                  <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                       <vuetify-money label="Amount" class="pa-0" v-model="plan_items.amount" v-bind:clearable="clearable" v-bind:valueWhenIsEmpty="valueWhenIsEmpty" v-bind:options="options" hide-details flat dense outlined />
                  </v-col>
                  <v-col 
                        cols="12"
                        sm="12"
                        md="6"
                    >
                       <vuetify-money label="Installation Fee" class="pa-0" v-model="plan_items.installation_fee" v-bind:clearable="clearable" v-bind:valueWhenIsEmpty="valueWhenIsEmpty" v-bind:options="options" hide-details flat dense outlined />
                  </v-col>
                  <v-col 
                        cols="12"
                        sm="12"
                        md="6"
                    >
                      <v-textarea
                      solo
                      name="input-7-4"
                      label="Inclusions"
                      v-model="plan_items.inclusions"
                      ></v-textarea>
                  </v-col>
                  <v-col 
                        cols="12"
                        sm="12"
                        md="6"
                    >
                      <v-textarea
                      solo
                      name="input-7-4"
                      label="Others"
                      v-model="plan_items.others"
                      ></v-textarea>
                  </v-col>
                 

                  </v-row>
              </v-container>
              <small>*indicates required field</small>
              </v-card-text>
            
              <v-card-actions class="px-5">
                <v-spacer></v-spacer>
                <v-tooltip top>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      x-small
                      fab
                      dark
                      color="primary"
                      v-bind="attrs"
                      v-on="on"
                      @click="Submit"
                      :disabled="valid"
                    >
                      <v-icon style="color: #fff !important">
                        mdi-check
                      </v-icon>
                    </v-btn>
                  </template>
                  <span>Save</span>
                </v-tooltip>
                <v-tooltip top>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      x-small
                      fab
                      dark
                      color="secondary"
                      v-bind="attrs"
                      v-on="on"
                      class="ml-2"
                      @click="close"
                    >
                      <v-icon style="color: #fff !important">
                        mdi-close
                      </v-icon>
                    </v-btn>
                  </template>
                  <span @click="close()">Cancel</span>
                </v-tooltip>
              </v-card-actions>
            </v-card>
          </v-form>
        </v-dialog>

        <v-dialog v-model="dialogDelete" max-width="500px" persistent>
          <v-card>
            <v-card-title class="text-h6 justify-center">
              Are you sure you want to delete?
            </v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    x-small
                    fab
                    dark
                    color="secondary"
                    v-bind="attrs"
                    v-on="on"
                    class="ml-2"
                    @click="closeDelete"
                  >
                    <v-icon style="color: #fff !important">
                      mdi-close
                    </v-icon></v-btn
                  >
                </template>
                <span>Cancel</span>
              </v-tooltip>
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    x-small
                    fab
                    dark
                    color="error"
                    v-bind="attrs"
                    v-on="on"
                    class="ml-2"
                    @click="deleteItemConfirm"
                  >
                    <v-icon style="color: #fff !important">
                      mdi-check
                    </v-icon>
                    </v-btn>
                </template>
                <span>Continue</span>
              </v-tooltip>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
  </v-data-table>
  </div>  
</template>
  <script>

  export default {
      data: () => ({
       dialog: false,
       dialogDelete: false,
       valid: false,
       editedIndex: -1,
       search:"",
       valueWhenIsEmpty: "",
       clearable: false,
        breadcrums: [
        {
          text: 'DASHBOARD',
          disabled: false,
          href: '/dashboard',
        },
        {
          text: 'Plan',
          disabled: false,
        },
      ],
        headers: [
          { text: 'Plan Code', value: 'code' },
          { text: 'Plan Name', value: 'name' },
          { text: 'Term Mode', value: 'term_mode' },
          { text: 'Term No', value: 'term_no' },
          { text: 'Amount', value: 'amount' },
          { text: 'Installation Fee', value: 'installation_fee' },
          { text: 'Inclusions', value: 'inclusions' },
          { text: 'Others', value: 'others' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        plans: [],
        plan_id:'',
        defaultItem: {
            id: '',
            code: '',
            name: '',
            term_mode: '',
            term_no: '',
            amount: '',
            installation_fee: '',
            inclusions: '',
            others: '',
          },
          plan_items: {
            id: '',
            code: '',
            name: '',
            term_mode: '',
            term_no: '',
            amount: '',
            installation_fee: '',
            inclusions: '',
            others: '',
            },
        options: {
          // locale: "fil-PH", prefix: "₱",
          suffix: "",
          length: 12,
          precision: 2,
        },

      }),
  
      computed: {
          formTitle() {
              return this.editedIndex === -1 ? "New Plan" : "Edit  Plan";
          },
      },
      watch: {
          dialog(val) {
           val || this.close();
          },
          dialogDelete(val) {
            val || this.closeDelete();
          },
      },
  
      methods:{
          initialize() {
              this.show_plan();
          },

          async show_plan() {
              var res = await axios.get("/plan");
                  if (res.status === 200) {
                      console.log(res.data);
                      this.plans = res.data;
                  }
          },
          
          editItem(item) {
              console.log(item);
              this.plan_id = item.id;
              this.editedIndex = this.plans.indexOf(item);
              this.plan_items = Object.assign({}, item);
              this.dialog = true;
          },
          deleteItem(item) {
              this.plan_id = item.id;
              this.dialogDelete = true;
          },
          async deleteItemConfirm() {
              var res = await axios.delete("/delete/plan/" + this.plan_id);
              if (res.status === 200) {
                  this.show_plan();
                  // this.tmcDepartments.splice(this.editedIndex, 1);
                  this.closeDelete();
              } else {
                  this.$Notice.error({
                  title: "Error",
                  desc: "Error occurred while loading data",
                  });
              }
          },
          close() {
              this.plan_id ='';
              this.dialog = false;
              this.$nextTick(() => {
                  this.plan_items = Object.assign({}, this.defaultItem);
                  this.editedIndex = -1;
              });
          },
          closeDelete() {
              this.dialogDelete = false;
              this.$nextTick(() => {
                  this.editedItem = Object.assign({}, this.defaultItem);
                  this.editedIndex = -1;
              });
          },
          Submit() {
              if (this.$refs.form.validate()) {
                  if (this.plan_id) {
                  axios
                      .put("/plan/update/" + this.plan_id, this.plan_items)
                      .then((response) => {
                      this.show_plan();
                      this.close();
                      })
                      .catch((error) => {
                      console.error("There was an error!", error);
                      });
                  } else {
                  axios
                      .post("/plan/create", this.plan_items)
                      .then((response) => {
                      this.show_plan();
                      this.close();
                      })
                      .catch((error) => {
                      console.error("There was an error!", error);
                      });
                  // this.close();
                  }
              }
          },
      

      },
  
      created() {
          this.initialize();
      }
  }
  </script>