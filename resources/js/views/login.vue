<template>
    <div>
        <form v-on:submit="login">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    v-model="formData.email"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.email"
                                ></p>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    v-model="formData.password"
                                />
                                <p
                                    class="text-danger"
                                    v-text="errors.password"
                                ></p>
                            </div>

                            <div class="row">
                                <div class="d-flex justify-content-between">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button
                                                @click="login"
                                                class="btn btn-primary"
                                            >
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        class="
                                            col-md-6
                                            d-flex
                                            justify-content-end
                                        "
                                    >
                                        <router-link to="/register"
                                            >Create New Account!</router-link
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            formData: {
                email: "",
                password: "",
                device_name: "browser",
            },
            errors: {},
        };
    },
    methods: {
        login(e) {
            e.preventDefault();
            
            axios
                .post("api/login", this.formData)
                .then(({ data }) => {
                    console.log(data.token);
                    console.log(data.user);
                    localStorage.setItem("token", data.token);
                    localStorage.setItem("user", data.user);
                    if (data.user.is_admin) {
                        this.$router.push("/admin-dashboard");
                    } else {
                        this.$router.push("/profile");
                    }
                })
                .catch((errors) => {
                    console.log(errors);
                    this.errors = errors.response.data.errors;
                    this.$toaster.error("Por favor, intente de nuevo");
                });
        },
    },
};
</script>