<template>
  <v-app id="app">
    <v-data-table
      :headers="headers"
      :items="credentials"
      item-key="id"
      :dark="darkStile"
      sort-by="staff_id"
      class="elevation-1"
      :loading="loading"
      loading-text="Cargando... Por favor espere"
      :single-expand="singleExpand"
      :expanded.sync="expanded"
      show-expand
    >
      <template v-slot:top>
        <v-toolbar flat class="mt-2">
          <v-toolbar-title>Credenciales</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog :dark="darkStile" v-model="dialogForm" persistent max-width="600px">
            <template v-if="can('admins.create')" v-slot:activator="{ on }">
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
                      <v-col cols="12">
                        <v-text-field
                          v-model="editedItem.name"
                          label="Nombre*"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('name') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="name"></has-error>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          v-model="editedItem.username"
                          label="Nombre de acceso*"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('username') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="username"></has-error>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <v-text-field
                          v-model="editedItem.password"
                          label="Contraseña*"
                          type="password"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('password') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="password"></has-error>
                      </v-col>
                      <v-col cols="12" sm="6">
                        <v-text-field
                          v-model="editedItem.password_confirmation"
                          label="Confirmación de contraseña*"
                          type="password"
                          required
                          :class="{ 'is-invalid': editedItem.errors.has('password_confirmation') }"
                        ></v-text-field>
                        <has-error :form="editedItem" field="password_confirmation"></has-error>
                      </v-col>
                      <v-col cols="12">
                        <v-textarea
                          v-model="editedItem.description"
                          auto-grow
                          required
                          label="Descripción*"
                          rows="1"
                          :class="{ 'is-invalid': editedItem.errors.has('description') }"
                        ></v-textarea>
                        <has-error :form="editedItem" field="description"></has-error>
                      </v-col>
                      <v-col cols="12">
                        <v-select
                          v-model="editedItem.roles"
                          :items="roles"
                          chips
                          label="Roles"
                          multiple
                        ></v-select>
                      </v-col>
                    </v-row>
                  </v-container>
                </form>
                <small>*indicador de campos requeridos</small>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red darken-1" text @click="close">Cancelar</v-btn>
                <v-btn
                  v-if="can('admins.edit')" 
                  color="blue darken-1"
                  :disabled="editedItem.busy"
                  type="submit"
                  text
                  @click="save"
                >Guardar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.created_at="{ item }">{{ formatedTime(item.created_at) }}</template>
      <template v-slot:item.updated_at="{ item }">{{ formatedTime(item.updated_at) }}</template>
      <template v-slot:item.staff_id="{ item }">
        <v-chip
          :color="getColor(item.staff_id)"
          dark
        >{{ item.staff_id !== null ? "Asignado" : "Sin asignar" }}</v-chip>
      </template>
      <template v-slot:item.roles="{ item }">
        <div
          class="text-left"
          v-for="(rol, index) in item.roles"
          :key="index"
        >{{rol.name }}</div>
      </template>
      <template v-slot:item.name="{ item }">{{ nameStaff(item) }}</template>
      <template v-slot:expanded-item="{ headers, item }">
        <td :colspan="headers.length">
          Permisos:
          <v-list-item>
            <v-list-item-content>
              <v-row no-gutters>
                <v-col
                  cols="12"
                  class="text-left"
                  v-for="(permission, index) in item.roles"
                  :key="index"
                >- {{permission.name}}</v-col>
                <v-col cols="12" class="text-left" v-if="item.roles.length==0">
                  <strong>No tiene roles asignados</strong>
                </v-col>
              </v-row>
            </v-list-item-content>
          </v-list-item>
        </td>
      </template>
      <template  v-slot:item.actions="{ item }">
        <v-btn v-if="can('admins.edit')" color="primary" fab x-small dark @click="editItem(item)">
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn v-if="can('admins.edit')" color="blue-grey" fab x-small dark @click="showStaffModal(item)">
          <v-icon>mdi-account-key</v-icon>
        </v-btn>        
        <v-btn v-if="can('admins.destroy')"  color="red" fab x-small dark @click="deleteItem(item)">
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
    <!--/v-data-table-->
    <!--staff-modal-->
    <template>
      <v-row justify="center">
        <v-dialog :dark="darkStile" v-model="dialogStaff" scrollable max-width="300px">
          <v-card>
            <v-card-title>Asignar Credencial a:</v-card-title>
            <v-divider></v-divider>
            <v-card-text style="height: 300px;">
              <form @submit.prevent="save">
                <v-select
                  v-model="form.staff_id"
                  :items="staff"
                  attach
                  chips
                  label="Empleados*"
                  item-text="name"
                  item-value="id"
                >
                  <template slot="selection" slot-scope="{ item }">{{ item.name + ' ' + item.lastname}}</template>
                  <template slot="item" slot-scope="{ item }">{{ item.name + ' ' + item.lastname}}</template>
                </v-select>
              </form>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-btn color="red darken-1" text @click="dialogStaff = false">Cerrar</v-btn>
              <v-btn color="blue darken-1" type="submit" text @click="assignCredential">Guardar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </template>
    <!--/staff-modal-->
  </v-app>
</template>
<script>
//import moment from 'moment'

export default {
  data: () => ({
    dialogForm: false,
    dialogStaff: false,
    loading: true,
    headers: [
      { text: "Nombre", value: "name" , align: 'center'},
      { text: "Username", value: "username" , align: 'center'},
      { text: "Usuario", value: "name" , align: 'center'},
      { text: "Descripcion", value: "description" ,width: '15rem', align: 'center'},
      { text: "Fecha de creación", value: "created_at" , align: 'center'},
      { text: "Fecha de modificación", value: "updated_at" , align: 'center'},
      { text: "Estado", value: "staff_id" , align: 'center'},
      { text: "Actions", value: "actions", sortable: false},
      { text: "Roles", value: "data-table-expand" }
    ],
    credentials: [],
    staff: [],
    roles: [],
    expanded: [],
    singleExpand: false,
    editedIndex: -1,
    adminId: "",
    editedItem: new Form({
      staff_id: "",
      name: "",
      username: "",
      password: "",
      password_confirmation: "",
      description: "",
      roles: []
    }),
    form: new Form({
      staff_id: ""
    })
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nueva credencial" : "Editar credencial";
    },
    darkStile(){
      return this.$store.getters.darkStile;
    }
  },

  watch: {
    dialogForm(val) {
      val || this.close();
    },
    dialogStaff(val) {
      val || this.closeStaffModal();
    }
  },

  created() {
    this.initialize();
    this.getRoles();
  },

  methods: {
    initialize() {
      axios.get("/api/admins").then(({data})  => {
        this.credentials = data;
        this.loading = false;
      });
    },
    editItem(item) {
      (this.editedIndex = { id: item.id }),
      (this.editedItem.staff_id = item.staff_id),
      (this.editedItem.name = item.name),
      (this.editedItem.username = item.username),
      (this.editedItem.description = item.description),
      (this.adminId = item.id),
      (this.dialogForm = true),
      (this.editedItem.roles = []);
      for (var i = 0; i < item.roles.length; i++) {
        this.editedItem.roles.push(item.roles[i].name);
      }
    },

    deleteItem(item) {
      Swal.fire({
        title: "Estas seguro?",
        text: "No podras revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar"
      }).then(result => {
        if (result.value) {
          let url = "/api/admins/destroy/" + item.id;
          const index = this.credentials.indexOf(item);
          axios
              .delete(url)
              .then(({ data }) => {
                if (data.status == "200") {
                  this.credentials.splice(index, 1);
                  toastr.success("Eliminado con exito");
                }
              })
              .catch(error => {
                toastr.error("Error al eliminar");
              });
        }
      });
    },

    close() {
      this.dialogForm = false;
      this.$nextTick(() => {
        this.editedIndex = -1;
        this.emptyForm();
      });
    },
    closeStaffModal() {
      this.dialogStaff = false;
      this.adminId = "";
      this.form.staff_id = "";
    },
    save() {
      if (this.editedIndex === -1) {
        this.editedItem
          .post("/api/admins/store")
          .then(({ data }) => {
            if (data.status == "200") {
              this.initialize();
              toastr.success("Registrado con exito");
              this.close();
            }
          })
          .catch(error => {
            toastr.error("Error al registrar");
          });
      } else {
        let url = "/api/admins/update/" + this.adminId;
        this.editedItem
          .put(url)
          .then(({ data }) => {
            if (data.status == "200") {
              this.initialize();
              toastr.success("Editado con exito");
              this.close();
            }
          })
          .catch(error => {
            toastr.error("Error al editar");
          });
      }
    },
    assignCredential() {
      let url = "/api/admins/assign/" + this.adminId;
      this.form
        .put(url)
        .then(({ data }) => {
          if (data.status == "200") {
            this.initialize();
            toastr.success("Credencial asignada con exito");
            this.closeStaffModal();
          }
        })
        .catch(error => {
          toastr.error("Error al asignar credencial");
        });
    },
    emptyForm() {
      this.editedItem.staff_id = "";
      (this.editedItem.name = ""),
        (this.editedItem.username = ""),
        (this.editedItem.password = ""),
        (this.editedItem.password_confirmation = ""),
        (this.editedItem.description = "");
      this.editedItem.roles = [];
    },
    getColor(status) {
      return status !== null ? "green" : "red";
    },
    getRoles() {
      axios.get("/api/roles/list/OnlyName").then(({ data }) => (this.roles = data));
    },
    showStaffModal(item) {
      let url = "/api/staff/list/noncredential";
      axios.get(url).then(response => {
        if (response.data.length > 0) {
          this.staff = response.data;
          this.adminId = item.id;
          this.dialogStaff = true;
        } else {
          toastr.warning("Cada empleado tiene una credencial");
        }
      });
    },
    nameStaff(item) {
      let name = "";
      if (item.staff !== null) {
        name =
          item.staff.name +
          " " +
          item.staff.lastname;
      }
      return name;
    },
    formatedTime(t) {
      return moment(t).format("Do MMM YY");
    }
  }
};
</script>