<style scoped>
.center {
    justify-content: center;
    align-content: center;
    align-items: center;
    display: flex;
}

.content-fundo {
    height: 210px;
    overflow: hidden;
    filter: blur(5px) brightness(0.7);
}

.content-fundo img {
    width: 100%;
    aspect-ratio: 7 / 4;
}

.content-header {
    background-color: white;
    height: 50vw;
    max-height: 600px;
    display: flex;
    justify-content: center;
    align-items: end;
}

.content-header > div {
    width: 80%;
    display: flex;
}

.content-header div h1 {
    font-size: 3em;
    font-weight: 900;
    max-width: 700px;
}

.content-header div:nth-child(2) {
    display: flex;
    justify-content: end;
}

.content-header div a {
    max-height: 64px;
}

@media (max-width: 767px) {
    .content-header div h1 {
        text-align: center;
    }

    .content-header div:nth-child(2) {
        display: flex;
        justify-content: center;
    }
}

.content-body {
    background-color: rgb(224, 224, 224);
    display: flex;
    justify-content: center;
}

.content-body div {
    width: 80%;
    padding: 30px 0;
    font-size: 16px;
    font-family: "Montserrat", sans-serif;
}

.foto-principal {
    position: absolute;
    top: 66.22px;
    left: 50%;
    transform: translate(-50%, 0);
    width: 80%;
    max-width: 1150px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    overflow: hidden;
}

.foto-principal div {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    border: 3px solid #fff8;
    border-top: none;
}

.foto-principal img {
    width: 100%;
    height: 100%;
    max-width: 1150px;
}
</style>

<template>
    <div class="w-100" style="background-color: gray">
        <div class="content-fundo">
            <img :src="'/storage/' + evento.thumbnail" alt="" />
        </div>
        <div class="content-header">
            <div class="w-75 d-flex justify-content-between p-5 row">
                <div class="col-md-7">
                    <h1 class="text-danger">
                        {{ evento.titulo }}
                    </h1>
                </div>
                <div class="col-md-5">
                    <a
                        :href="'/inscricao/nova/' + evento.id"
                        class="btn btn-danger btn-lg fs-2 fw-bold"
                    >
                        Inscreva-se
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="w-75" v-html="evento.descricao"></div>
        </div>
        <div class="foto-principal">
            <img :src="'/storage/' + evento.thumbnail" alt="" />
            <div></div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "evento", "errors"],
    data() {
        return {};
    },
    beforeCreate() {
        console.log(this.evento, this.errors);
    },
    methods: {},
};
</script>
