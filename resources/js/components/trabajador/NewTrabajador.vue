<template>
  <v-layout row wrap>
    <!-- Formulario de datos -->
    <v-flex xs12 md7 class="mr">
      <v-card class="elevation-12">
        <!-- Header card -->
        <v-toolbar dark color="teal darken-1" dense>
          <v-toolbar-title>Trabajador</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <!-- Alertas -->
        <v-alert v-model="alert" dismissible :type="alertType">{{alertMessage}}</v-alert>

        <!-- formulario -->
        <form @submit.prevent="addTrabajador">
          <v-card-text>
            <v-text-field
              color="teal darken-1"
              v-model="trabajador.cedula"
              name="cedula"
              label="Cédula"
              id="cedula"
              v-validate="{required: true, regex: '^([V|E]{1})([0-9]{7,8})$'}"
            ></v-text-field>
            <v-alert v-show="errors.has('cedula')" type="error">{{errors.first('cedula')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.nombre1"
              name="nombre1"
              label="Primer Nombre"
              id="nombre1"
              v-validate="'required|alpha'"
            ></v-text-field>
            <v-alert v-show="errors.has('nombre1')" type="error">{{errors.first('nombre1')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.nombre2"
              name="nombre2"
              label="Segundo Nombre"
              id="nombre2"
              v-validate="'alpha'"
            ></v-text-field>
            <v-alert v-show="errors.has('nombre2')" type="error">{{errors.first('nombre2')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.apellido1"
              name="apellido1"
              label="Primer Apellido"
              id="apellido1"
              v-validate="'required|alpha'"
            ></v-text-field>
            <v-alert v-show="errors.has('apellido1')" type="error">{{errors.first('apellido1')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.apellido2"
              name="apellido2"
              label="Segundo Apellido"
              id="apellido2"
              v-validate="'alpha'"
            ></v-text-field>
            <v-alert v-show="errors.has('apellido2')" type="error">{{errors.first('apellido2')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.cargo"
              name="cargo"
              label="Cargo"
              id="cargo"
              v-validate="{required: true, regex: /[a-zA-Z0-9\.\,\#\-\_\/\sáéíóú]+$/}"
            ></v-text-field>
            <v-alert v-show="errors.has('cargo')" type="error">{{errors.first('cargo')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.fecha_nacimiento"
              label="Fecha de Nacimiento"
              name="fecha_nacimiento"
              id="fecha_nacimiento"
              type="date"
              v-validate="'required'"
            ></v-text-field>
            <v-alert v-show="errors.has('fecha_nacimiento')" type="error">{{errors.first('fecha_nacimiento')}}</v-alert>

            <v-select
              :items="sexo"
              color="teal darken-1"
              v-model="trabajador.sexo"
              label="Sexo"
              name="sexo"
              id="sexo"
              v-validate="'required'"
            ></v-select>
            <v-alert v-show="errors.has('sexo')" type="error">{{errors.first('sexo')}}</v-alert>

            <v-textarea
              color="teal darken-1"
              v-model="trabajador.direccion"
              name="direccion"
              label="Direccion"
              id="direccion"
              rows="2"
              v-validate="{required: true, regex: /[a-zA-Z0-9\.\,\#\/\sáéíóú]+$/}"
            ></v-textarea>
            <v-alert v-show="errors.has('direccion')" type="error">{{errors.first('direccion')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.telefono_fijo"
              name="telefono_fijo"
              label="Telefono Fijo"
              id="telefono_fijo"
              v-validate="{regex: /(02)([1-9]{2})([0-9]{7})$/}"
            ></v-text-field>
            <v-alert v-show="errors.has('telefono_fijo')" type="error">{{errors.first('telefono_fijo')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.telefono_celular"
              name="telefono_celular"
              label="Telefono Celular"
              id="telefono_celular"
              v-validate="{regex: /(04)(12|14|24|16|26)([0-9]{7})$/}"
            ></v-text-field>
            <v-alert v-show="errors.has('telefono_celular')" type="error">{{errors.first('telefono_celular')}}</v-alert>

            <v-text-field
              color="teal darken-1"
              v-model="trabajador.fecha_ingreso"
              label="Fecha de ingreso"
              name="fecha_ingreso"
              id="fecha_ingreso"
              type="date"
              v-validate="'required'"
            ></v-text-field>
            <v-alert v-show="errors.has('fecha_ingreso')" type="error">{{errors.first('fecha_ingreso')}}</v-alert>

            <v-toolbar dark color="teal darken-1" dense>
              <v-toolbar-title>Salario</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-checkbox v-model="trabajador.salario_minimo" label="Salario Minimo?"></v-checkbox>

            <v-text-field
              v-if="trabajador.salario_minimo == false"
              color="teal darken-1"
              v-model="trabajador.salario"
              label="Salario mensual"
              name="salario"
              id="salario"
              v-validate="`${trabajador.salario_minimo ? '' : 'required'}|decimal:2`"
            ></v-text-field>
            <v-alert v-show="errors.has('salario')" type="error">{{errors.first('salario')}}</v-alert>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn type="submit" dark color="teal darken-1">Guardar</v-btn>
          </v-card-actions>
        </form>
        <!-- Fin form-->
      </v-card>
    </v-flex>

    <v-flex xs12 md5 class="pt">
      <v-card>
        <v-card-title>
          <h3>Agregados</h3>
          <v-spacer></v-spacer>
          <v-text-field
            color="teal darken-1"
            v-model="search"
            append-icon="fa-search"
            label="Buscar.."
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table :headers="headers" :items="trabajadores" :search="search">
          <template slot="items" slot-scope="props">
            <td>{{ props.item.cedula }}</td>
            <td>{{ props.item.nombre1 }} {{props.item.apellido1}}</td>
          </template>
          <v-alert
            slot="no-results"
            :value="true"
            color="error"
            icon="fa-exclamation-triangle"
          >Tu busqueda "{{ search }}" no encontro resultados.</v-alert>
        </v-data-table>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from "axios";

class Trabajador {
  constructor() {
    this.cedula = "";
    this.nombre1 = "";
    this.nombre2 = "";
    this.apellido1 = "";
    this.apellido2 = "";
    this.cargo = "";
    this.fecha_nacimiento = "";
    this.sexo = "";
    this.direccion = "";
    this.telefono_fijo = "";
    this.telefono_celular = "";
    this.fecha_ingreso = "";
    this.salario_minimo = "true";
    this.salario = "";
  }
}

export default {
  name: "NewTrabajador",
  data() {
    return {
      empresaId: this.$store.state.empresa.id,
      search: "",
      trabajador: new Trabajador(),
      sexo: ["Masculino", "Femenino"],
      headers: [
        { text: "Cedula", value: "cedula" },
        { text: "Nombre", value: "nombre1" }
      ],
      trabajadores: [],
      alert: false,
      alertType: "success",
      alertMessage: ""
    };
  },
  created() {
    const dict = {
      custom: {
        cedula: {
          required: "No debe ser vacio",
          regex: "Debe cumplir con el formato especificado. Ej: Vxxxxxxxx, Exxxxxxxx"
        },
        nombre1: {
          required: "No debe ser vacio",
          alpha: "Solo debe contener letras."
        },
        nombre2: {
          required: "No debe ser vacio",
          alpha: "Solo debe contener letras."
        },
        apellido1: {
          required: "No debe ser vacio",
          alpha: "Solo debe contener letras."
        },
        apellido2: {
          required: "No debe ser vacio",
          alpha: "Solo debe contener letras."
        },
        direccion: {
          required: "No debe ser vacio",
          regex:
            "Solo se permite el uso de letras, numeros y los caracteres (, . / #) "
        },
        fecha_nacimiento: {
          required: "No debe ser vacio"
        },
        cargo: {
          required: "No debe ser vacio",
          regex: 'No se permiten caracteres especiales.'
        },
        sexo: {
          required: "No debe ser vacio"
        },
        telefono_fijo: {
          regex: "Escriba un formato de telefóno válido. Ej: 02xx-xxxxxxx"
        },
        telefono_celular: {
          regex: "Escriba un formato de telefóno válido. Ej: 04xx-xxxxxxx"
        },
        fecha_ingreso: {
          required: "No debe ser vacio"
        },
        salario: {
          required: "No debe ser vacio",
          decimal: "Debe ser un monto con solo dos decimales. Ej: xxxx.xx"
        }
      }
    };
    // or use the instance method
    this.$validator.localize("es", dict);
  },
  methods: {
    addTrabajador() {
      const vm = this;
      this.$validator.validate().then(valid => {
        if (!valid) {
          // do stuff if not valid.
          return;
        }
        axios
          .post(
            `http://payroll.com.local/api/trabajadores/${vm.empresaId}`,
            vm.trabajador,
            {
              headers: {
                Authorization: `Bearer ${vm.$store.state.currentUser.token}`
              }
            }
          )
          .then(res => {
            if (!res.data.error) {
              vm.$data.trabajadores.push({
                cedula: vm.$data.trabajador.cedula,
                nombre1: vm.$data.trabajador.nombre1,
                apellido1: vm.$data.trabajador.apellido1
              });

              vm.$data.trabajador = new Trabajador();

              vm.$data.alert = true;
              vm.$data.alertType = "success";
              vm.$data.alertMessage = "Trabajador Agregado!";
            } else {
              vm.$data.alert = true;
              vm.$data.alertType = "error";
              vm.$data.alertMessage = res.data.error
            }

            document.getElementById("cedula").focus();
          })
          .catch(err => {
            console.log(err);
          });
      });
    }
  }
};
</script>

<style>
.mr {
  padding-right: 5px;
}
.pt {
  padding-top: 5px;
}
</style>
