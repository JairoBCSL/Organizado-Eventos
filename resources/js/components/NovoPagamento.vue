<style scoped>
.card-pagamento {
    min-width: 450px;
    width: 450px;
    display: flex;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.card-pagamento .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

.card-body form {
    height: 100%;
}
</style>

<template>
    <div>
        <div class="card card-pagamento">
            <div class="card-header w-100">Pagamento</div>
            <div class="card-body w-100">
                <form
                    enctype="multipart/form-data"
                    method="post"
                    action="/pagamento/guarda"
                    class="p-3 pt-0 d-flex flex-column"
                >
                    <input name="_token" :value="csrf_token" type="hidden" />
                    <input
                        name="inscricao_id"
                        :value="inscricao.id"
                        type="hidden"
                    />

                    <div class="row mb-3">
                        <div
                            class="col-form-label text-md-start text-danger fw-bold fs-3"
                        >
                            Escaneie e anexe o comprovante
                        </div>
                    </div>

                    <div class="row mb-3">
                        <img
                            alt="QR Code"
                            :src="
                                'https://quickchart.io/qr?text=' +
                                inscricao.evento.qrcode
                            "
                            srcset=""
                        />
                    </div>

                    <div class="row mb-3">
                        <label
                            for="comprovante"
                            class="col-form-label text-md-start text-danger fw-bold fs-5"
                            >Comprovante</label
                        >

                        <div class="">
                            <input
                                value=""
                                type="file"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors?.comprovante,
                                }"
                                name="comprovante"
                                required
                            />

                            <span
                                v-if="errors?.comprovante"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.comprovante[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3 d-flex justify-content-center mt-auto">
                        <div
                            class="col-md-8 d-flex justify-content-center mb-1"
                        >
                            <button
                                type="submit"
                                class="btn btn-outline-danger btn-lg w-75 fw-bold"
                            >
                                Pagar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "errors", "inscricao"],
    data() {
        return {};
    },
    beforeCreate() {
        console.log(this.inscricao);
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
