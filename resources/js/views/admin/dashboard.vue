<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h5 class="text-center">
                    Bienvenido de nuevo: {{ currentUser.name }}
                </h5>
                <p class="text-center">{{ currentUser.email }}</p>
            </div>
        </div>
        <br />
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <router-link
                                    :to="{
                                        name: 'admin-profile',
                                        params: { id: user.id },
                                    }"
                                    class="btn btn-primary"
                                    >Ver</router-link
                                >
                                <router-link
                                    :to="{
                                        name: 'admin-edit-user-profile',
                                        params: { id: user.id },
                                    }"
                                    class="btn btn-success"
                                    >Edit</router-link
                                >
                                <a
                                    @click="switchAtiveUser(user.id)"
                                    class="btn btn-danger"
                                    v-if="
                                        user.id !== currentUser.id &&
                                        user.is_active
                                    "
                                    >Desactivar</a
                                >
                                <a
                                    @click="switchAtiveUser(user.id)"
                                    class="btn btn-warning"
                                    v-else-if="
                                        user.id !== currentUser.id &&
                                        !user.is_active
                                    "
                                    >Activar</a
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
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
        getUsers() {
            axios
                .get(window.location.origin + "/index")
                .then((response) => {
                    this.users = response.data;
                    // console.log(response.data)
                })
                .catch((errors) => {
                    console.log(errors);
                });
        },
        switchAtiveUser(user_id) {
            Swal.fire({
                title: "Esta seguro de modificar este usuario?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Actualizar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .post(
                            window.location.origin +
                                "/user/switch-active/" +
                                user_id
                        )
                        .then((response) => {
                            this.getUsers();
                            console.log(response);
                        })
                        .catch((errors) => {
                            console.log(errors);
                        });
                    Swal.fire(
                        "Actualizado!",
                        "Este usuario ha sido actualizado.",
                        "success"
                    );
                }
            });
        },
        logout() {
            axios
                .post(window.location.origin + "/api/logout")
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
        this.getUsers();
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
