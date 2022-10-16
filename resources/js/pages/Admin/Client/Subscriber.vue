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
      :items="subscribers"
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
          <v-toolbar-title>Subscriber</v-toolbar-title>
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
                 
                   <v-radio-group
                    v-model="subscriber_items.application_type"
                    >
                    <v-row>
                    <v-col
                        cols="12"
                        sm="6"
                        md="2"
                    >
                    <v-radio
                        label="Residential"
                        value="Residential"
                        :checked="subscriber_items.application_type == 'Residential'"
                    ></v-radio>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="6"
                        md="2"
                    >
                    <v-radio
                        label="Commercial"
                        value="Commercial"
                        :checked="subscriber_items.application_type == 'Commercial'"
                    ></v-radio>
                    </v-col>
                    </v-row>
                    </v-radio-group> 
                    <v-col
                        cols="12"
                        sm="6"
                        md="8"
                    >
                      <v-select :items="plans" v-model="subscriber_items.plan_id" item-text="text" item-value="value" single-line label="Plans"></v-select>
                    </v-col>
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
                        v-model="subscriber_items.name"
                        label="Full Name*"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="12"
                        md="2"
                    >
                        <v-text-field
                        v-model="subscriber_items.ext_name"
                        label="ext"
                        hint="example of persistent helper text"
                        persistent-hint
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="12"
                        md="2"
                    >
                    <h5 class="text-left mt-3 text-gray darken-4">
                        <b>PRESENT ADDRESS</b>
                    </h5>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="12"
                        md="3"
                    >
                         <v-text-field label="Street/Home #/Purok"  v-model="present_st" hide-details dense :rules="rules.required"></v-text-field>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="12"
                        md="3"
                    >
                         <v-autocomplete :items="addresses" :item-text="brgyTextOptions" label="Brgy."  v-model="present_brgy" v-on:change="onPresentAddressChange" hide-details return-object dense :rules="rules.required"></v-autocomplete>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="12"
                        md="3"
                    >
                         <v-text-field label="City, Province Region" v-model="present_city_province" hide-details dense readonly :rules="rules.required"></v-text-field>
                    </v-col>
                    <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                        <v-text-field
                        v-model="subscriber_items.contact_number"
                        label="Contact No*"
                        ></v-text-field>
                    </v-col>
                    <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                        <v-text-field
                        v-model="subscriber_items.email"
                        label="Email*"
                        ></v-text-field>
                    </v-col>
                    <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                        <v-text-field
                        v-model="subscriber_items.birth_date"
                        label="Birth date*"
                        type="date"
                        ></v-text-field>
                    </v-col>
                    <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                        <v-text-field
                        v-model="subscriber_items.birth_place"
                        label="Birthplace*"
                        ></v-text-field>
                    </v-col>
                    <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                        <v-select
                            v-model="subscriber_items.nationality"
                            :items="['Filipino', 'American']"
                            label="Nationality"
                        ></v-select>
                    </v-col>
                    <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                        <v-select
                            v-model="subscriber_items.subscriber_sex"
                            :items="['Male', 'Female']"
                            label="Sex"
                        ></v-select>
                    </v-col>
                    <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                        <v-select
                            v-model="subscriber_items.civil_status"
                            :items="['Single', 'Married', 'Widowed', 'Separated']"
                            label="Civil Status"
                        ></v-select>
                    </v-col>
                    <v-col 
                        cols="12"
                        sm="12"
                        md="3"
                    >
                        <v-text-field
                        v-model="subscriber_items.tin"
                        label="Tin*"
                        ></v-text-field>
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
        <!-- <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon> -->
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
          breadcrums: [
          {
            text: 'DASHBOARD',
            disabled: false,
            href: '/dashboard',
          },
          {
            text: 'SUBSCRIBER',
            disabled: false,
          },
        ],
          headers: [
            { text: 'Application Type', value: 'application_type' },
            { text: 'Account No', value: 'account_no' },
            { text: 'Name', value: 'name' },
            { text: 'Contact No', value: 'contact_number' },
            { text: 'Email', value: 'email' },
            { text: 'Actions', value: 'actions', sortable: false },
          ],
          subscribers: [],
          cities: [],
          addresses: [],
          plans: [],
          subscriber_id:'',
          defaultItem: {
              id: '',
              application_type: '',
              account_no: '',
              name: '',
              ext_name: '',
              contact_number: '',
              landline_number: '',
              email: '',
              present_house_no: '',
              present_street: '',
              present_address_brgy: '',
              present_address_muncity: '',
              present_address_province: '',
              permanent_house_no: '',
              permanent_street: '',
              permanent_address_brgy: '',
              permanent_address_muncity: '',
              permanent_address_province: '',
              permanent_address_region: '',
              birth_date: '',
              nationality: '',
              birth_place: '',
              subscriber_sex: '',
              civil_status: '',
              date_deceased: '',
              date_registered: '',
              industry: '',
              tin: '',
              representative_name: '',
              company_id: '',
              ownership: '',
              plan_id:''
            },
            subscriber_items: {
              id: '',
              application_type: '',
              account_no: '',
              name: '',
              ext_name: '',
              contact_number: '',
              landline_number: '',
              email: '',
              present_house_no: '',
              present_street: '',
              present_address_brgy: '',
              present_address_muncity: '',
              present_address_province: '',
              permanent_house_no: '',
              permanent_street: '',
              permanent_address_brgy: '',
              permanent_address_muncity: '',
              permanent_address_province: '',
              permanent_address_region: '',
              birth_date: '',
              nationality: '',
              birth_place: '',
              subscriber_sex: '',
              civil_status: '',
              date_deceased: '',
              date_registered: '',
              industry: '',
              tin: '',
              representative_name: '',
              company_id: '',
              ownership: '',
              plan_id:''
              },

              present_st: '',
              present_brgy: '',
              present_city_province: '',
              other_st: '',
              other_brgy: '',
              other_city_province: '',
              rules: {
				      	required: [value => !!value || "Required field."]
              }

        }),
    
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? "New Subscriber" : "Edit  Subscriber";
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
                this.show_subscriber();
            },

            async show_subscriber() {
                var res = await axios.get("/subscriber");
                    if (res.status === 200) {
                        console.log(res.data);
                        this.subscribers = res.data;
                    }
            },
            
            editItem(item) {
                console.log(item);
                this.subscriber_id = item.id;
                this.editedIndex = this.subscribers.indexOf(item);
                this.subscriber_items = Object.assign({}, item);
                this.dialog = true;
            },
            deleteItem(item) {
                this.subscriber_id = item.id;
                this.dialogDelete = true;
            },
            async deleteItemConfirm() {
                var res = await axios.delete("/delete/subscriber/" + this.subscriber_id);
                if (res.status === 200) {
                    this.show_subscriber();
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
                this.subscriber_id ='';
                this.dialog = false;
                this.$nextTick(() => {
                    this.subscriber_items = Object.assign({}, this.defaultItem);
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
                    if (this.subscriber_id) {
                    axios
                        .put("/subscriber/update/" + this.subscriber_id, this.subscriber_items)
                        .then((response) => {
                        this.show_subscriber();
                        this.close();
                        })
                        .catch((error) => {
                        console.error("There was an error!", error);
                        });
                    } else {
                    axios
                        .post("/subscriber/create", this.subscriber_items)
                        .then((response) => {
                        this.show_subscriber();
                        this.close();
                        })
                        .catch((error) => {
                        console.error("There was an error!", error);
                        });
                    // this.close();
                    }
                }
            },
            async fetchAddress() {
              await axios.get('/villages').then((response) => {
                var scope = this;
                if (response.status === 200 && response.data) {
                  scope.addresses = response.data;
                }
              })
            },

            async fetchCities() {
              var scope = this;
              await axios.get('/state-cities').then((response) => {
                if (response.status === 200 && response.data) {
                  response.data.forEach(function(val, index) {
                    scope.cities.push({
                      text: val.muncity + ' ( ' + val.province + ' )'
                    });
                  });
                }
              })
            },

            async fetchPlans() {
              var scope = this;
              await axios.get('/plan').then((response) => {
                if (response.status === 200 && response.data) {
                  response.data.forEach(function(val, index) {
                    scope.plans.push({
                      text: val.name + ' ( ' + val.amount + ' )',
                      value: val.id
                    });
                  });
                }
              })
            },



          onPresentAddressChange(e) {
            this.present_city_province = e.muncity + ', ' + e.province + ' (' + e.region + ')';
            this.subscriber_items.present_address_brgy = e.brgy;
            this.subscriber_items.present_address_muncity = e.muncity;
            this.subscriber_items.present_address_province = e.province;
            this.subscriber_items.present_address_region = e.region;
            this.subscriber_items.present_house_no = this.present_street;
          },


            brgyTextOptions(e) {
				return e.brgy + " (" + e.muncity + ")";
			},

        },
    
        created() {
            this.initialize();
            this.fetchCities();
			      this.fetchAddress();
            this.fetchPlans();
        }
    }
    </script>