<style scoped>
.card-novo {
    min-width: 400px;
    /* min-height: 600px; */
    width: 400px;
    /* height: 50%; */
    display: flex;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.card-novo .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

.card-novo .card-body form {
    height: 100%;
}
</style>

<template>
    <div class="card card-novo w-75">
        <div class="card-header w-100">Editar Evento</div>
        <div class="card-body w-100">
            <form
                enctype="multipart/form-data"
                method="POST"
                :action="'/evento/' + evento.id"
                class="p-3 pt-0 d-flex flex-column"
            >
                <input type="hidden" name="_method" value="patch" />
                <input name="_token" :value="csrf_token" type="hidden" />
                <input name="id" :value="evento.id" type="hidden" />
                <input name="user_id" :value="user_id" type="hidden" disabled />
                <input
                    name="data_inicio"
                    id="data_inicio"
                    value=""
                    type="hidden"
                    disabled
                />
                <input
                    name="data_fim"
                    id="data_fim"
                    value=""
                    type="hidden"
                    disabled
                />

                <div class="row mb-3">
                    <label
                        for="titulo"
                        class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                        >Título<span
                            id="lockTitulo"
                            class="fs-5 text-dark btn bg-body-secondary inputLock"
                            >✎</span
                        >
                    </label>

                    <div class="input-group has-validation">
                        <input
                            disabled
                            id="inputTitulo"
                            :value="evento.titulo"
                            type="text"
                            class="form-control"
                            name="titulo"
                            required
                            autocomplete="titulo"
                            autofocus
                            :class="{
                                'is-invalid': errors?.titulo,
                            }"
                        />
                        <span
                            v-if="errors?.titulo"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ errors.titulo[0] }}</strong>
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label
                        for="descricao"
                        class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                        >Descrição<span
                            id="lockDescricao"
                            class="fs-5 text-dark btn bg-body-secondary inputLock"
                            >✎</span
                        ></label
                    >

                    <div class="">
                        <textarea
                            disabled
                            id="inputDescricao"
                            :value="evento.descricao"
                            class="form-control"
                            :class="{
                                'is-invalid': errors?.descricao,
                            }"
                            name="descricao"
                            required
                        />
                        <span
                            v-if="errors?.descricao"
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ errors.titulo[0] }}</strong>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 row mb-3 m-0 p-0">
                        <label
                            for="imagem"
                            class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                            >Imagem<span
                                id="lockImagem"
                                class="fs-5 text-dark btn bg-body-secondary inputLock"
                                >✎</span
                            ></label
                        >

                        <div class="">
                            <input
                                disabled
                                id="inputImagem"
                                type="file"
                                value=""
                                class="form-control"
                                :class="{
                                    'is-invalid': errors?.imagem,
                                }"
                                name="imagem"
                                required
                            />
                            <span
                                v-if="errors?.imagem"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.imagem[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 row mb-3 m-0 p-0">
                        <label
                            for="thumbnail"
                            class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                            >Thumbnail<span
                                id="lockThumbnail"
                                class="fs-5 text-dark btn bg-body-secondary inputLock"
                                >✎</span
                            ></label
                        >

                        <div class="">
                            <input
                                disabled
                                id="inputThumbnail"
                                type="file"
                                value=""
                                class="form-control"
                                :class="{
                                    'is-invalid': errors?.thumbnail,
                                }"
                                name="thumbnail"
                                required
                            />
                            <span
                                v-if="errors?.thumbnail"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.thumbnail[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 row mb-3 m-0 p-0">
                        <label
                            for="cidade_id"
                            class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                            >Cidade<span
                                id="lockCidade"
                                class="fs-5 text-dark btn bg-body-secondary inputLock"
                                >✎</span
                            ></label
                        >

                        <div class="">
                            <select
                                disabled
                                id="inputCidade"
                                class="form-control"
                                name="cidade_id"
                                :value="evento.local.cidade_id"
                                required
                                autocomplete="cidade_id"
                                autofocus
                                :class="{
                                    'is-invalid': errors?.cidade_id,
                                }"
                            >
                                <option
                                    v-for="(cidade, i) in cidades"
                                    :key="i"
                                    :value="cidade.id"
                                >
                                    {{ cidade.nome }}
                                </option>
                            </select>
                            <span
                                v-if="errors?.cidade_id"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.cidade_id[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 row mb-3 m-0 p-0">
                        <label
                            for="local_id"
                            class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                            >Local<span
                                id="lockLocal"
                                class="fs-5 text-dark btn bg-body-secondary inputLock"
                                >✎</span
                            ></label
                        >

                        <div class="">
                            <select
                                disabled
                                id="inputLocal"
                                class="form-control"
                                name="local_id"
                                :value="evento.local_id"
                                required
                                autocomplete="local_id"
                                :class="{
                                    'is-invalid': errors?.local_id,
                                }"
                            >
                                <option
                                    v-for="(local, i) in this.locais"
                                    :key="i"
                                    :value="local.id"
                                >
                                    {{ local.nome }}
                                </option>
                            </select>
                            <span
                                v-if="errors?.local_id"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.local_id[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 row mb-3 m-0 p-0">
                        <label
                            for="periodo"
                            class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                            >Período<span
                                id="lockPeriodo"
                                class="fs-5 text-dark btn bg-body-secondary inputLock"
                                >✎</span
                            ></label
                        >

                        <div class="">
                            <input
                                disabled
                                id="inputPeriodo"
                                :value="evento.periodo"
                                type="text"
                                class="form-control"
                                name="periodo"
                                required
                                :class="{
                                    'is-invalid': errors?.periodo,
                                }"
                            />
                            <span
                                v-if="errors?.periodo"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.periodo[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 row mb-3 m-0 p-0">
                        <label
                            for="qrcode"
                            class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                            >QR Code para pix<span
                                id="lockQrcode"
                                class="fs-5 text-dark btn bg-body-secondary inputLock"
                                >✎</span
                            ></label
                        >

                        <div class="">
                            <input
                                disabled
                                id="inputQrcode"
                                :value="evento.qrcode"
                                type="text"
                                class="form-control"
                                name="qrcode"
                                required
                                :class="{
                                    'is-invalid': errors?.qrcode,
                                }"
                            />
                            <span
                                v-if="errors?.qrcode"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.qrcode[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 row mb-3 m-0 p-0">
                        <label
                            for="capacidade"
                            class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                            >Capacidade<span
                                id="lockCapacidade"
                                class="fs-5 text-dark btn bg-body-secondary inputLock"
                                >✎</span
                            ></label
                        >

                        <div class="">
                            <input
                                disabled
                                id="inputCapacidade"
                                :value="evento.capacidade"
                                type="text"
                                class="form-control"
                                name="capacidade"
                                required
                                autocomplete="capacidade"
                                autofocus
                                :class="{
                                    'is-invalid': errors?.capacidade,
                                }"
                            />
                            <span
                                v-if="errors?.capacidade"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.capacidade[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 row mb-3 m-0 p-0">
                        <label
                            for="titulo"
                            class="col-form-label text-md-start text-danger fw-bold fs-5 d-flex justify-content-between"
                            >Preço do ingresso<span
                                id="lockPreco"
                                class="fs-5 text-dark btn bg-body-secondary inputLock"
                                >✎</span
                            ></label
                        >

                        <div class="">
                            <input
                                disabled
                                id="inputPreco"
                                :value="evento.preco"
                                type="text"
                                class="form-control"
                                name="preco"
                                required
                                autocomplete="preco"
                                autofocus
                                :class="{
                                    'is-invalid': errors?.preco,
                                }"
                            />
                            <span
                                v-if="errors?.preco"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.preco[0] }}</strong>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3 d-flex justify-content-center mt-auto">
                    <div class="col-md-8 d-flex justify-content-center">
                        <button
                            type="submit"
                            class="btn btn-danger btn-lg w-75 fw-bold"
                        >
                            Atualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["csrf_token", "errors", "user_id", "evento", "cidades"],
    data() {
        return {
            locais: [],
        };
    },
    beforeCreate() {
        const formatDate = function (data) {
            return new Intl.DateTimeFormat("pt-BR", {
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
            }).format(new Date(data));
        };
        let inicio = new Date(this.evento.data_inicio);
        let fim = new Date(this.evento.data_fim);

        this.evento.data_inicio = formatDate(inicio);
        this.evento.data_fim = formatDate(fim);
        this.evento.periodo =
            this.evento.data_inicio + " - " + this.evento.data_fim;
        console.log(this.evento.periodo);
        console.log(this.errors, this.evento);
    },
    methods: {
        carregarLocais(cidade_id) {
            if (cidade_id == undefined) cidade_id = this.evento.local.cidade_id;

            axios.get("/api/local/" + cidade_id).then((response) => {
                this.locais = response.data;
            });
        },
    },
    mounted() {
        let form_controls = document.getElementsByClassName("form-control");

        Array.from(form_controls).forEach((item) => {
            item.oninput = () => {
                item.classList.remove("is-invalid");
            };
        });

        $('input[name="periodo"]').daterangepicker({
            locale: {
                format: "DD/MM/YYYY",
            },
        });
        $('input[name="periodo"]').on(
            "apply.daterangepicker",
            function (ev, picker) {
                console.log("Aplicou?");
                $('input[name="data_inicio"]').val(
                    picker.startDate.format("YYYY-MM-DD")
                );
                $('input[name="data_fim"]').val(
                    picker.endDate.format("YYYY-MM-DD")
                );
            }
        );
        $('input[name="periodo"]').on(
            "cancel.daterangepicker",
            function (ev, picker) {
                $(this).val("");
            }
        );
        $('input[name="periodo"]').val("");

        $(".inputLock").click(function (event) {
            let nome = event.currentTarget.id.replace("lock", "#input");
            console.log(nome);
            let campo = $(nome);
            console.log(campo);
            if (campo.prop("disabled")) {
                campo.prop("disabled", false);
                if (nome == "#inputPeriodo") {
                    $("#data_inicio").prop("disabled", false);
                    $("#data_fim").prop("disabled", false);
                }
            } else {
                campo.prop("disabled", true);
                if (nome == "#inputPeriodo") {
                    $("#data_inicio").prop("disabled", true);
                    $("#data_fim").prop("disabled", true);
                }
            }
        });

        $('select[name="cidade_id"]').on("change", () => {
            console.log(event.currentTarget.value);
            this.carregarLocais(event.currentTarget.value);
        });

        this.carregarLocais();
    },
};
</script>
