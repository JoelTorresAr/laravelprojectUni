<template>
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Personal</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <button
              class="btn btn-success"
              data-toggle="modal"
              data-target="#addNewStaff"
              v-on:click="cargarListas"
            >
              Agregar
              <i class="fas fa-user-plus"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Sucursal</th>
              <th>Puesto</th>
              <th colspan="3">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, id) in staff" :key="id">
              <td>{{item.firstname}}</td>
              <td>{{item.firstlastname + ' ' +item.secondlastname}}</td>
              <td>{{item.subsidiary}}</td>
              <td>{{item.workposition}}</td>
              <td width="3rem">
                <a href class="btn btn-sm btn-outline-secondary">
                  <i class="fas fa-eye"></i>
                </a>
              </td>
              <td width="3rem">
                <a href class="btn btn-sm btn-outline-secondary">
                  <i class="fas fa-edit"></i>
                </a>
              </td>
              <td width="3rem">
                <button class="btn btn-sm btn-danger">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <spinner v-show="loading"></spinner>
    </div>
    <!-- /.card -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="addNewStaff"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewStaffLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewStaffLabel">Agregar nuevo trabajador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createStaff">
            <div class="modal-body">
              <div class="form-group">
                <label>Sucursal</label>
                <select
                  name="subsidiary_id"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('subsidiary_id') }"
                  v-model="form.subsidiary_id"
                >
                  <option value disabled hidden>Selecciona la sucursal</option>
                  <option
                    v-for="(item, index) in subsidiaries"
                    :key="index"
                    v-bind:value="item.id"
                    v-bind:selected="index === 0 ? true : false"
                  >{{item.name}}</option>
                </select>
                <has-error :form="form" field="subsidiary_id"></has-error>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label>Área de trabajo</label>
                    <select
                      class="form-control"
                      v-model="workstationSelected"
                      v-on:change="getWorkpositions()"
                    >
                      <option value disabled hidden>Selecciona la área</option>
                      <option
                        v-for="(item, id) in workstations"
                        :key="id"
                        v-bind:value="item.id"
                      >{{item.name}}</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Puesto de trabajo</label>
                    <select
                      name="workposition_id"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('workposition_id') }"
                      v-model="form.workposition_id"
                    >
                      <option disabled value hidden>Selecciona el puesto</option>
                      <option
                        v-for="(item, id) in workpositions"
                        :key="id"
                        v-bind:value="item.id"
                      >{{item.name}}</option>
                    </select>
                    <has-error :form="form" field="workposition_id"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Dirección</label>
                <input
                  v-model="form.address"
                  type="text"
                  name="address"
                  placeholder="Dirección"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('address') }"
                />
                <has-error :form="form" field="address"></has-error>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label>Ciudad</label>
                    <select
                      class="form-control"
                      v-model="citySelected"
                      v-on:change="getDistricts()"
                    >
                      <option value disabled hidden>Seleccionar ciudad</option>
                      <option
                        v-for="(item, id) in cities"
                        :key="id"
                        v-bind:value="item.id"
                      >{{item.name}}</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Distrito</label>
                    <select
                      name="district_id"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('district_id') }"
                      v-model="form.district_id"
                    >
                      <option value disabled hidden>Seleccionar distrito</option>
                      <option
                        v-for="(item, id) in districts"
                        :key="id"
                        v-bind:value="item.id"
                      >{{item.name}}</option>
                    </select>
                    <has-error :form="form" field="district_id"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Nombres</label>
                <input
                  v-model="form.firstname"
                  type="text"
                  name="firstname"
                  placeholder="Nombres"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('firstname') }"
                />
                <has-error :form="form" field="firstname"></has-error>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label>Apellido paterno</label>
                    <input
                      v-model="form.firstlastname"
                      type="text"
                      name="firstlastname"
                      placeholder="Apellido Paterno"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('firstlastname') }"
                    />
                    <has-error :form="form" field="firstlastname"></has-error>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Apellido materno</label>
                    <input
                      v-model="form.secondlastname"
                      type="text"
                      name="secondlastname"
                      placeholder="Apellido Materno"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('secondlastname') }"
                    />
                    <has-error :form="form" field="secondlastname"></has-error>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <label>Celular</label>
                    <input
                      v-model="form.phone"
                      type="tel"
                      name="phone"
                      placeholder="(+51) _ _ _ - _ _ _ - _ _ _"
                      class="form-control"
                      v-mask="['(+51) ###-###-###', '(+51) ###-###-###']"
                      :class="{ 'is-invalid': form.errors.has('phone') }"
                    />
                    <has-error :form="form" field="phone"></has-error>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>Correo</label>
                    <input
                      v-model="form.email"
                      type="email"
                      name="email"
                      placeholder="Correo electronico"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button :disabled="form.busy" type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: true,
      staff: {},
      subsidiaries: {},
      workstations: {},
      workpositions: {},
      cities: {},
      districts: {},
      workstationSelected: "",
      citySelected: "",
      form: new Form({
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
    };
  },
  created() {
    this.getStaff();
  },
  methods: {
    createStaff() {
      this.form.post("/api/staff/store");
    },
    getStaff() {
      let url = "http://127.0.0.1:8000/api/staff/";
      axios.get(url).then(response => {
        this.staff = response.data.data;
        this.loading = false;
      });
    },
    getSubsidiaries() {
      let url = "http://127.0.0.1:8000/api/subsidiaries/";
      axios.get(url).then(({ data }) => (this.subsidiaries = data));
    },
    getWorkstations() {
      let url = "http://127.0.0.1:8000/api/workstations/";
      axios.get(url).then(({ data }) => (this.workstations = data));
    },
    getWorkpositions($id = this.workstationSelected) {
      let url = "http://127.0.0.1:8000/api/workpositions/" + $id;
      axios.get(url).then(response => {
        this.workpositions = response.data;
        if (response.data.length > 0) {
          this.form.workposition_id = this.workpositions[0].id;
        } else {
          this.form.workposition_id = "";
        }
      });
    },
    getCities() {
      let url = "http://127.0.0.1:8000/api/cities/";
      axios.get(url).then(({ data }) => (this.cities = data));
    },
    getDistricts($id = this.citySelected) {
      let url = "http://127.0.0.1:8000/api/districts/" + $id;
      axios.get(url).then(response => {
        this.districts = response.data;
        if (response.data.length > 0) {
          this.form.district_id = this.districts[0].id;
        } else {
          this.form.district_id = "";
        }
      });
    },
    cargarListas() {
      this.getSubsidiaries();
      this.getCities();
      this.getWorkstations();
    }
  }
};
</script>