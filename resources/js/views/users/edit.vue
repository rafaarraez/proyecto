
   
<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Actualiar Perfil</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                v-model="formData.name"
                            />
                            <p class="text-danger" v-text="errors.name"></p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                type="text"
                                class="form-control"
                                name="email"
                                v-model="formData.email"
                            />
                            <p class="text-danger" v-text="errors.email"></p>
                        </div>
                        <div class="form-group">
                            <label for="cedula">Cedula</label>
                            <input
                                type="text"
                                class="form-control"
                                name="cedula"
                                v-model="formData.cedula"
                            />
                            <p class="text-danger" v-text="errors.cedula"></p>
                        </div>
                        <div class="form-group">
                            <label for="address">Direccion</label>
                            <input
                                type="text"
                                class="form-control"
                                name="address"
                                v-model="formData.address"
                            />
                            <p class="text-danger" v-text="errors.address"></p>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input
                                type="text"
                                class="form-control"
                                name="phone"
                                v-model="formData.phone"
                            />
                            <p class="text-danger" v-text="errors.phone"></p>
                        </div>
                        <div class="form-group">
                            <label for="photo">Foto</label>
                            <input
                                type="file"
                                class="form-control"
                                name="photo"
                            />
                            <p class="text-danger" v-text="errors.photo"></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button
                                        @click="update"
                                        class="btn btn-primary"
                                    >
                                        Actualizar
                                    </button>
                                   
                                    <router-link
                                        to="/profile"
                                        class="btn btn-secondary"
                                        >Regresar</router-link
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            users: {},
            currentUser: {},
            token: localStorage.getItem("token"),
            user: localStorage.getItem("user"),
            formData: {
                name: "",
                email: "",
                cedula: "",
                address: "",
                phone: "",
                photo: "test.png",
                password: "",
                password_confirmation: "",
            },
            errors: {},
        };
    },
    mounted() {
        window.axios.defaults.headers.common[
            "Authorization"
        ] = `Bearer ${this.token}`;
        axios
            .get(window.location.origin +"/api/user")
            .then((response) => {
                this.currentUser = response.data;
                this.formData.name = this.currentUser.name
                this.formData.email = this.currentUser.email
                this.formData.cedula = this.currentUser.cedula
                this.formData.address = this.currentUser.address
                this.formData.phone = this.currentUser.phone
                this.formData.photo = this.currentUser.photo

            });
    },
    methods: {
        getUser() {
            axios
                .get(window.location.origin + "/user/" + this.currentUser.id)
                .then((response) => {
                    this.user = response.data;
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        update() {
            axios
                .post(
                    window.location.origin + "/edit/update/" + this.currentUser.id,
                    this.formData
                )
                .then((response) => {
                    this.$router.push("/profile");
                    this.$toaster.success("Perfil actualizado!!.");
                })
                .catch((error) => {
                    console.log(error);
                    this.$toaster.error(error);
                });
        },
    },
};
</script>