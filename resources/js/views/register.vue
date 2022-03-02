
   
<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Register</div>
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
                                        @click="registerUser"
                                        class="btn btn-primary"
                                    >
                                        Register
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <router-link to="/login"
                                    >Already have an account!</router-link
                                >
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
    methods: {
        registerUser() {
            axios
                .post(window.location.origin + "/api/register", this.formData)
                .then((response) => {
                    console.log(response.data);
                    this.formData.name =
                        this.formData.email =
                        this.formData.password =
                        this.formData.password_confirmation =
                            "";
                    this.errors = {};
                    this.$router.push("/login");
                    this.$toaster.success(
                        "Su cuenta fue creada exitosamente, por favor inicie sesion"
                    );
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                    console.log(errors.response.data.errors);
                    this.$toaster.error("Por favor, intente de nuevo");
                });
        },
    },
};
</script>