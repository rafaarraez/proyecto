<template>
    <div>
        <nav
            class="
                navbar navbar-expand-md navbar-dark
                bg-success
                shadow-sm
                mb-5
            "
        >
            <div class="container">
                <router-link to="/" class="nav-item nav-link navbar-brand"
                    >Home</router-link
                >
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a
                                id="navbarDropdown"
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                {{ currentUser.name }}
                            </a>

                            <div
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdown"
                            >
                                <a class="dropdown-item" @click="logout">
                                    Logout
                                </a>

                                <form
                                    id="logout-form"
                                    action=""
                                    method="POST"
                                    class="d-none"
                                ></form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <router-view />
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
            currentUser: {},
            token: localStorage.getItem("token"),
            user: localStorage.getItem("user"),
        };
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true;
        }
    },
    methods: {
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
        axios
            .get(window.location.origin +"/api/user")
            .then((response) => {
                this.currentUser = response.data;
            })
            .catch((errors) => {
                console.log(errors);
            });
    },
};
</script>