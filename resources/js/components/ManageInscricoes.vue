<style scoped>
.center {
    justify-content: center;
    align-content: center;
    align-items: center;
    display: flex;
}

.manage-card {
    box-shadow: 0 2px 12px rgba(32, 32, 32, 0.3);
    border-radius: 10px;
}

.manage-card .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
}

.manage-card .card-body {
    padding-left: 0;
    padding-right: 0;
}

.grid {
    width: 100%;
}

.manage-inscricao-grid {
    border-collapse: collapse;
    border-spacing: 0;
    overflow: hidden;
    background-color: #fafafa;
    text-align: center;
}

.manage-inscricao-grid th,
.manage-inscricao-grid td {
    padding: 12px 15px;
    font-size: 16px;
}

.manage-inscricao-grid td {
    text-align: center;
}

.manage-inscricao-grid tr:nth-child(odd) {
    background: #eeeeee;
}

.manage-inscricao-grid .botoes-grid {
    height: 100px;
}

@media (max-width: 1200px) {
    .manage-inscricao-grid .botoes-grid {
        grid-column-start: 2;
        grid-column-end: 3;
        grid-row-start: 1;
        grid-row-end: 2;
        width: 100%;
        display: flex;
        justify-content: end;
        padding: 20px;
    }
}
</style>

<template>
    <div>
        <div class="container-md">
            <h3
                style="font-family: Montserrat, sans-serif; min-width: 576px"
                class="fw-bold text-danger"
            >
                {{ evento }}
            </h3>
            <div class="card card-grid manage-card">
                <div class="card-header w-100">Gestão de Inscrições</div>
                <div class="card-body w-100">
                    <div class="grid py-2">
                        <table class="w-100 manage-inscricao-grid">
                            <thead>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data da Inscrição</th>
                                <th>Status da Inscrição</th>
                                <th>Status do Pagamento</th>
                                <th>Valor Pago</th>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(inscricao, i) in inscricoes"
                                    :key="i"
                                >
                                    <td>
                                        {{ inscricao.usuario.nome }}
                                    </td>
                                    <td>
                                        {{ inscricao.usuario.email }}
                                    </td>
                                    <td>
                                        {{ formata_data(inscricao.data) }}
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <div
                                            class="rounded w-50"
                                            style="
                                                background-color: rgb(
                                                    181,
                                                    193,
                                                    214
                                                );
                                                color: white;
                                            "
                                        >
                                            {{ inscricao.status.nome }}
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="d-flex justify-content-center"
                                        >
                                            <a
                                                v-if="
                                                    inscricao.pagamento
                                                        ?.status_id == 11 // Em Procesamento
                                                "
                                                class="btn btn-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalShowPagamento"
                                                @click="
                                                    carregaManage(
                                                        inscricao.pagamento
                                                    )
                                                "
                                                href="#"
                                                >{{
                                                    inscricao.pagamento?.status
                                                        .nome
                                                }}</a
                                            >
                                            <div
                                                v-else
                                                class="rounded w-50"
                                                style="
                                                    background-color: rgb(
                                                        181,
                                                        193,
                                                        214
                                                    );
                                                    color: white;
                                                "
                                            >
                                                {{
                                                    inscricao.pagamento?.status
                                                        .nome ??
                                                    "Aguardando Pagamento"
                                                }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{
                                            formata_real(
                                                inscricao.pagamento?.valor ?? 0
                                            )
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <modal-component
                id="modalShowPagamento"
                title="Confira o Comprovante"
            >
                <template v-slot:content>
                    <form
                        id="modalPagamentoForm"
                        method="post"
                        action=""
                        class="p-3 pt-0 d-flex flex-column"
                    >
                        <div class="modal-body">
                            <input
                                name="_token"
                                :value="csrf_token"
                                type="hidden"
                            />
                            <input
                                id="modal-manage-evento"
                                name="pagamento_id"
                                value=""
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
                                    id="comprovanteImg"
                                    alt="Comprovante"
                                    src=""
                                    srcset=""
                                />
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
                                            'is-invalid': errors?.password,
                                        }"
                                        name="password"
                                        required
                                    />
                                </div>
                            </div>

                            <div
                                class="row mb-3 d-flex justify-content-center mt-auto"
                            >
                                <div
                                    class="col-md-6 d-flex justify-content-center mb-1"
                                >
                                    <a
                                        href="#"
                                        @click="
                                            status(2) // Rejeitar
                                        "
                                        type="submit"
                                        class="btn btn-outline-danger btn-lg w-75 fw-bold"
                                    >
                                        Rejeitar
                                    </a>
                                </div>
                                <div
                                    class="col-md-6 d-flex justify-content-center mb-1"
                                >
                                    <a
                                        href="#"
                                        @click="
                                            status(1) // Aprovar
                                        "
                                        type="submit"
                                        class="btn btn-danger btn-lg w-75 fw-bold"
                                    >
                                        Aprovar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </template>
            </modal-component>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "inscricoes", "evento", "errors"],
    data() {
        return {
            pagamento_modal_id: 0,
            meses_ano: [
                "Jan",
                "Fev",
                "Mar",
                "Abr",
                "Maio",
                "Jun",
                "Jul",
                "Ago",
                "Set",
                "Out",
                "Nov",
                "Dez",
            ],
        };
    },
    created() {
        this.inscricoes.forEach((inscricao) => {
            inscricao.data = new Date(inscricao.created_at);
        });
        console.log(this.errors, this.inscricoes, this.evento);
    },
    methods: {
        formata_data(data) {
            return (
                data.getDate() +
                " de " +
                this.meses_ano[data.getMonth()] +
                " de " +
                data.getFullYear()
            );
        },
        formata_real(valor) {
            return "R$" + valor.toFixed(2).replace(".", ",");
        },
        carregaManage(pagamento) {
            console.log(pagamento.comprovante);
            $("#comprovanteImg").prop(
                "src",
                "/storage/" + pagamento.comprovante
            );
            this.pagamento_modal_id = pagamento.id;
        },
        status(acao) {
            console.log(acao);
            switch (acao) {
                case 1:
                    $("#modalPagamentoForm").prop(
                        "action",
                        "/pagamento/" + this.pagamento_modal_id + "/aprovar/"
                    );

                    break;
                case 2:
                    $("#modalPagamentoForm").prop(
                        "action",
                        "/pagamento/" + this.pagamento_modal_id + "/rejeitar/"
                    );

                    break;
                default:
                    break;
            }
            $("#modalPagamentoForm").submit();
        },
    },
};
</script>
