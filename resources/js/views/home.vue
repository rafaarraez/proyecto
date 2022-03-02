<template>
    <div>
        <nav
            class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-5"
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
                        <li class="nav-item">
                            <router-link to="/login" class="nav-item nav-link"
                                >login</router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link
                                to="/register"
                                class="nav-item nav-link"
                                >Register
                            </router-link>
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
        };
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true;
        }
    },
    methods: {
        logout(e) {
            console.log("ss");
            e.preventDefault();
            this.$axios
                .get(window.location.origin + "/sanctum/csrf-cookie")
                .then((response) => {
                    this.$axios
                        .post("logout")
                        .then((response) => {
                            if (response.data.success) {
                                window.location.href = "/";
                            } else {
                                console.log(response);
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                });
        },
    },
};
</script>