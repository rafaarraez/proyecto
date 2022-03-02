
   
<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Cambiar contraseña</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                v-model="formData.password"
                            />
                            <p class="text-danger" v-text="errors.password"></p>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"
                                >Confirm Password</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                v-model="formData.password_confirmation"
                            />
                            <p
                                class="text-danger"
                                v-text="errors.password_confirmation"
                            ></p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button
                                        @click="update"
                                        class="btn btn-primary"
                                    >
                                        Actualizar contraseña
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
        axios.get(window.location.origin + "/api/user").then((response) => {
            this.currentUser = response.data;
        });
    },
    methods: {
        update() {
            axios
                .post(
                    window.location.origin +
                        "/edit/update/password/" +
                        this.currentUser.id,
                    this.formData
                )
                .then((response) => {
                    this.$router.push("/profile");
                    this.$toaster.success("Contraseña actualizada!!.");
                })
                .catch((error) => {
                    console.log(error);
                    this.errors = error.response.data.errors;
                    this.$toaster.error('Por favor verifique e intente de nuevo');
                });
        },
    },
};
</script>