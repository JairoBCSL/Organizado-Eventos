<style>
.card-login {
    min-width: 400px;
    min-height: 500px;
    width: 400px;
    height: 50%;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.card-login .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
}

.card-login .card-body form {
    height: 100%;
}

.card-nova-conta {
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}
</style>

<template>
    <div>
        <div class="card card-login">
            <div class="card-header w-100">Entrar</div>
            <div class="card-body w-100">
                <form
                    method="POST"
                    action="login"
                    class="p-3 pt-0 d-flex flex-column"
                >
                    <input name="_token" :value="csrf_token" type="hidden" />

                    <div class="row mb-3">
                        <label
                            for="email"
                            class="col-form-label text-md-start text-danger fw-bold fs-5"
                            >Email</label
                        >

                        <div class="">
                            <input
                                id="emailLogin"
                                value="jairoboaz@gmail.co"
                                type="email"
                                class="form-control"
                                name="email"
                                required
                                autocomplete="email"
                                autofocus
                                :class="{
                                    'is-invalid': errors?.email,
                                }"
                            />
                            <span
                                v-if="errors?.email"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.email[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="password"
                            class="col-form-label text-md-start text-danger fw-bold fs-5"
                            >Senha</label
                        >

                        <div class="">
                            <input
                                value="Strong.2106"
                                type="password"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors?.email,
                                }"
                                name="password"
                                required
                            />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div
                            class="col-md-8 offset-md-0 d-flex justify-content-start align-items-center"
                        >
                            <div class="form-check fs-5">
                                <label
                                    class="form-check-label text-danger fw-bold"
                                    for="remember"
                                >
                                    Me manter conectado
                                </label>
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 d-flex justify-content-center mt-auto">
                        <div class="col-md-8 d-flex justify-content-center">
                            <button
                                type="submit"
                                class="btn btn-danger btn-lg w-75 fw-bold"
                            >
                                Entrar
                            </button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div
                            class="col-md-12 d-flex justify-content-end fw-bold fs-5 mt-2 text-danger"
                        >
                            <span>Esqueceu a senha?&nbsp;&nbsp;</span>
                            <a class="" href="/password/reset">Peça uma nova</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-nova-conta mt-4">
            <div class="row p-4">
                <div
                    class="col-md-12 d-flex justify-content-end fw-bold fs-5 text-danger"
                >
                    <span>Ainda não tem conta?&nbsp;&nbsp;</span>
                    <a class="" href="/register">Criar uma conta</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "errors"],
    data() {
        return {};
    },
    beforeCreate() {
        console.log(this.errors);
    },
    methods: {},
    mounted() {
        let form_controls = document.getElementsByClassName("form-control");

        Array.from(form_controls).forEach((item) => {
            item.oninput = () => {
                item.classList.remove("is-invalid");
            };
        });
    },
};
</script>
