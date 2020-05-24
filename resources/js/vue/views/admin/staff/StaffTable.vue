<template>
  <v-app id="app">
    <div  v-if="can('edit post')">You can edit posts.</div>
    <v-data-table
      :headers="headers"
      :items="staff"
      :dark="darkStile"
      item-key="id"
      sort-by="subsidiary"
      class="elevation-1"
      :loading="loading"
      loading-text="Cargando... Por favor espere"
    >
      <template v-slot:top>
        <v-toolbar flat class="mt-2">
          <v-toolbar-title>Personal</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog :dark="darkStile" v-model="dialogForm" persistent max-width="600px">
            <template v-if="can('staff.create')" v-slot:activator="{ on }">
              <v-btn color="primary" class="mb-2" dark v-on="on">Agregar nuevo</v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>
              <v-card-text>
                <form @submit.prevent="save">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.firstname"
                          label="Nombres*"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('firstname') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="firstname"></has-error>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.firstlastname"
                          label="Apellido paterno*"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('firstlastname') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="firstlastname"></has-error>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.secondlastname"
                          label="Apellido materno*"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('secondlastname') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="secondlastname"></has-error>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          v-model="editedItem.email"
                          label="Email*"
                          type="email"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('email') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="email"></has-error>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          label="Celular*"
                          v-model="editedItem.phone"
                          type="tel"
                          placeholder="(+51) _ _ _ - _ _ _ - _ _ _"
                          v-mask="['(+51) ###-###-###', '(+51) ###-###-###']"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('phone') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="phone"></has-error>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <v-select
                          v-model="editedItem.subsidiary_id"
                          :items="subsidiaries"
                          label="Sucursal*"
                          required
                          item-text="name"
                          item-value="id"
                          :class="{ 'is-invalid': editedItem.errors.has('subsidiary_id') }"
                        ></v-select>
                        <has-error :form="editedItem" field="subsidiary_id"></has-error>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <v-select :items="['0-17', '18-29', '30-54', '54+']" label="Edad*" required></v-select>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <v-select
                          v-model="workstationSelected"
                          :items="workstations"
                          label="Area de trabajo"
                          required
                          item-text="name"
                          item-value="id"
                          @change="getWorkpositions()"
                        ></v-select>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <v-select
                          v-model="editedItem.workposition_id"
                          :items="workpositions"
                          label="Puesto de trabajo*"
                          required
                          item-text="name"
                          item-value="id"
                          :class="{ 'is-invalid': editedItem.errors.has('workposition_id') }"
                        ></v-select>
                        <has-error :form="editedItem" field="workposition_id"></has-error>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          v-model="editedItem.address"
                          label="Dirección*"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('address') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="address"></has-error>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <v-select
                          v-model="citySelected"
                          :items="cities"
                          label="Ciudad"
                          required
                          item-text="name"
                          item-value="id"
                          @change="getDistrictsbyCity()"
                        ></v-select>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <v-select
                          v-model="editedItem.district_id"
                          :items="districts"
                          label="Distrito*"
                          required
                          item-text="name"
                          item-value="id"
                          :class="{ 'is-invalid': editedItem.errors.has('district_id') }"
                        ></v-select>
                        <has-error :form="editedItem" field="district_id"></has-error>
                      </v-col>
                    </v-row>
                  </v-container>
                </form>
                <small>*indicador de campos requeridos</small>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
                <v-btn
                  color="blue darken-1"
                  :disabled="editedItem.busy"
                  type="submit"
                  text
                  @click="save"
                >Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.status="{ item }">
        <v-chip :color="getColor(item.status)" dark>{{ item.status }}</v-chip>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-btn v-if="can('staff.edit')" color="primary" fab x-small dark @click="editItem(item)">
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn color="teal" fab x-small dark @click="showItem(item)">
          <v-icon>mdi-eye</v-icon>
        </v-btn>                
        <v-btn v-if="can('staff.destroy')"  color="red" fab x-small dark @click="deleteItem(item)">
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
    <!--/v-data-table-->
    <!--v-dialog-info-->
    <div class="text-center">
      <v-dialog :dark="darkStile" v-model="dialogInfo" persistent max-width="600px">
        <v-card>
          <v-card-title
            class="headline grey"
            primary-title
          >{{editedItem.firstname + ' ' + editedItem.firstlastname+ ' ' + editedItem.secondlastname}}</v-card-title>

          <v-card-text class="text--primary">
            <v-container>
              <v-row no-gutters align="center" justify="center">
                <v-avatar class="profile" color="grey" size="164" tile>
                  <v-img src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
                </v-avatar>
                <v-col class="py-0">
                  <v-list-item>
                    <v-list-item-content>
                      <v-row no-gutters>
                        <v-col cols="12">
                          <strong>Email:</strong>
                          {{editedItem.email}}
                        </v-col>
                        <v-col cols="12">
                          <strong>Celular:</strong>
                          {{editedItem.phone}}
                        </v-col>
                        <v-col cols="12">
                          <strong>Sucursal:</strong>
                          {{editedItem.subsidiary}}
                        </v-col>
                        <v-col cols="12">
                          <strong>Area de trabajo:</strong>
                          {{editedItem.workstation}}
                        </v-col>
                        <v-col cols="12">
                          <strong>Puesto de trabajo:</strong>
                          {{editedItem.workposition}}
                        </v-col>
                        <v-col cols="12">
                          <strong>Ciudad:</strong>
                          {{editedItem.city}}
                        </v-col>
                        <v-col cols="12">
                          <strong>Distrito:</strong>
                          {{editedItem.district}}
                        </v-col>
                        <v-col cols="12">
                          <strong>Dirección:</strong>
                          {{editedItem.address}}
                        </v-col>
                      </v-row>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="closeDialogInfo">Acepto</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <!--/v-dialog-info-->
  </v-app>
</template>
<script>
export default {
  data: () => ({
    dialogForm: false,
    dialogInfo: false,
    loading: true,
    headers: [
      { text: "Nombre", value: "firstname" },
      { text: "Apellido P.", value: "firstlastname" },
      { text: "Apellidos M.", value: "secondlastname" },
      { text: "Sucursal", value: "subsidiary" },
      { text: "Puesto", value: "workposition" },
      { text: "Estado", value: "status" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    staff: [],
    subsidiaries: [],
    workstations: [],
    workpositions: [],
    cities: [],
    districts: [],
    workstationSelected: "",
    citySelected: "",
    editedIndex: -1,
    staffId: "",
    editedItem: new Form({
      subsidiary_id: "",
      workposition_id: "",
      district_id: "",
      address: "",
      address2: "",
      firstname: "",
      firstlastname: "",
      secondlastname: "",
      phone: "",
      email: ""
    })
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Personal" : "Editar Personal";
    },
    darkStile(){
      return this.$store.getters.darkStile;
    }
  },

  watch: {
    dialogForm(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
    this.loadformdates();
  },

  methods: {
    initialize() {
      axios.get("/api/staff").then(response => {
        this.staff = response.data;
        this.loading = false;
      });
    },
    editItem(item) {
      this.editedIndex = { id: item.id };
      Object.assign(this.editedItem, item);
      //Address
      this.getDistrictsbyCity(this.editedItem.city_id);
      this.citySelected = this.editedItem.city_id;
      this.editedItem.district_id = item.district_id;
      //Workposition
      this.getWorkpositions(this.editedItem.workstation_id);
      this.workstationSelected = this.editedItem.workstation_id;
      this.editedItem.workposition_id = item.workposition_id;
      this.staffId = this.editedItem.id;
      this.dialogForm = true;
    },

    deleteItem(item) {
      let url = "/api/staff/destroy/" + item.id;
      const index = this.staff.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        axios.delete(url).then(({data})=>{
          if (data.status == "200") {
          this.staff.splice(index, 1);
          toastr.success("Eliminado con exito");}
        }).catch(error => {
            toastr.error("Error al eliminar");
          });
    },

    close() {
      this.dialogForm = false;
      this.$nextTick(() => {
        this.editedIndex = -1;
        this.emptyForm();
      });
    },
    closeDialogInfo() {
      this.emptyForm();
      this.dialogInfo = false;
    },
    save() {
      if (this.editedIndex > -1) {
        let url = "/api/staff/" + this.staffId;
        this.editedItem.put(url).then(({ data }) => {
          if (data.status == "200") {
            this.initialize();
            this.close();
          }
        });
      } else {
        this.editedItem.post("/api/staff/store").then(({ data }) => {
          console.log(data);
          if (data.status == "200") {
            //this.staff.push(this.editedItem);
            this.initialize();
            this.close();
          }
        });
      }
    },
    emptyForm() {
      (this.editedItem.subsidiary_id = ""),
        (this.editedItem.workposition_id = ""),
        (this.editedItem.district_id = ""),
        (this.editedItem.address = ""),
        (this.editedItem.address2 = ""),
        (this.editedItem.firstname = ""),
        (this.editedItem.firstlastname = ""),
        (this.editedItem.secondlastname = ""),
        (this.editedItem.phone = ""),
        (this.editedItem.email = "");
    },
    showItem(item) {
      //let itemselected = this.staff.find(element=>element==item);
      Object.assign(this.editedItem, item);
      this.dialogInfo = true;
    },
    getColor(status) {
      return status === "activo" ? "green" : "red";
    },
    getSubsidiaries() {
      axios
        .get("/api/subsidiaries")
        .then(({ data }) => (this.subsidiaries = data));
    },
    getWorkstations() {
      let url = "/api/workstations";
      axios.get(url).then(({ data }) => (this.workstations = data));
    },
    getWorkpositions($id = this.workstationSelected) {
      let url = "/api/workpositions/" + $id;
      axios.get(url).then(response => {
        if (response.data.length > 0) {
          this.workpositions = response.data;
          //this.editedItem.workposition_id = this.workpositions[0].id;
        } else {
          this.workpositions = [];
          this.editedItem.workposition_id = "";
        }
      });
    },
    getCities() {
      let url = "/api/cities";
      axios.get(url).then(({ data }) => (this.cities = data));
    },
    getDistrictsbyCity($id = this.citySelected) {
      let url = "/api/districts/" + $id;
      axios.get(url).then(response => {
        if (response.data.length > 0) {
          this.districts = response.data;
          //this.editedItem.district_id = this.districts[0].id;
        } else {
          this.districts = [];
          this.editedItem.district_id = "";
        }
      });
    },
    loadformdates() {
      this.getSubsidiaries();
      this.getCities();
      this.getWorkstations();
    },
  }
};
</script>