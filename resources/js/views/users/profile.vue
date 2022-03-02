<template>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="
                                    d-flex
                                    flex-column
                                    align-items-center
                                    text-center
                                "
                            >
                                <img
                                    src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                    alt="Admin"
                                    class="rounded-circle"
                                    width="150"
                                />
                                <div class="mt-3">
                                    <h4>{{ currentUser.name }}</h4>
                                    <router-link
                                        to="/profile/edit-password"
                                        class="btn btn-outline-primary"
                                        >Cambiar contraseña</router-link
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nombre</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ currentUser.name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Correo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ currentUser.email }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefono</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ currentUser.phone }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Cedula</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ currentUser.cedula }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Direccion</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ currentUser.address }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-12">
                                    <router-link
                                        to="/profile/edit"
                                        class="btn btn-info"
                                        >Actualizar perfil</router-link
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
        };
    },
    methods: {
        logout() {
            axios
                .post("api/logout")
                .then((response) => {
                    localStorage.removeItem("token");
                    this.$router.push("/login");
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
    },
    mounted() {
        window.axios.defaults.headers.common[
            "Authorization"
        ] = `Bearer ${this.token}`;
        axios
            .get(window.location.origin + "/api/user")
            .then((response) => {
                this.currentUser = response.data;
            })
            .catch((errors) => {
                console.log(errors);
            });
    },
};
</script>
