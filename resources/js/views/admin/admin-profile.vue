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
                                    <h4>{{ user.name }}</h4>
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
                                    {{ user.name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Correo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ user.email }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telefono</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ user.phone }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Cedula</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ user.cedula }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Direccion</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ user.address }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-12">
                                    <router-link
                                        :to="{
                                            name: 'admin-edit-user-profile',
                                            params: { id: user.id },
                                        }"
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
    mounted() {
        this.getUser();
    },
    data() {
        return {
            user: {},
        };
    },
    methods: {
        getUser() {
            axios
                .get(window.location.origin + "/user/" + this.$route.params.id)
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
                    window.location.origin + "/update/" + this.$route.params.id,
                    this.user
                )
                .then((response) => {
                    console.log("record created!");
                    this.$router.push("/");
                    this.$toaster.success("Employee updated successfully.");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>