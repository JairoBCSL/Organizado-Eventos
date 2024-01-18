<style scoped>
.slider {
    position: relative;
    width: 100%;
    height: 600px;
    overflow: hidden;
    user-select: none;
}

.item {
    position: absolute;
    width: 600px;
    height: 600px;
    transition: 0.4s;
    left: calc(50% - 300px);
    top: 0;
    border-radius: 10px;
    overflow: hidden;
}

.item img {
    width: 100%;
    height: 100%;
}

.selecao {
    position: absolute;
    bottom: 0;
    width: 80%;
    height: 20%;
    background: rgba(0, 0, 0, 0.2);
    z-index: 1;
    left: 10%;
}

.seletores {
    position: absolute;
    bottom: 25%;
    left: calc(50% - 25px);
    background-color: "#ffffff74";
    width: 50px;
    height: 7.5%;
    z-index: 2;
    border-radius: 5px;
}

#next,
#prev {
    position: absolute;
    top: 0;
    color: #fff;
    background: rgb(0, 0, 0);
    background: linear-gradient(
        90deg,
        rgba(0, 0, 0, 0.75) 0%,
        rgba(0, 0, 0, 0.75) 25%,
        rgba(0, 0, 0, 0.5) 100%
    );
    border: none;
    font-size: xxx-large;
    font-family: monospace;
    font-weight: bold;
    left: 0;
    width: 10%;
    height: 100%;
    justify-content: center;
    align-items: center;
    display: flex;
    cursor: pointer;
    user-select: none;
    z-index: 2;
}

#next {
    left: unset;
    right: 0;
    background: linear-gradient(
        90deg,
        rgba(0, 0, 0, 0.5) 0%,
        rgba(0, 0, 0, 0.75) 75%,
        rgba(0, 0, 0, 0.75) 100%
    );
}

#next:hover,
#prev:hover {
    background-color: rgba(0, 0, 0, 0.5);
}
</style>

<template>
    <div class="slider">
        <div class="item" v-for="(evento, i) in eventos" :key="i">
            <a :href="'/evento/' + evento.id">
                <img :src="'/storage/' + evento.imagem" alt="" />
            </a>
        </div>
        <div class="selecao">
            <a
                class="seletores"
                v-for="(evento, i) in eventos"
                :key="i"
                :id="'seletor-' + i"
            ></a>
        </div>
        <div id="prev"><div>&#60;</div></div>
        <div id="next"><div>&#62;</div></div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "eventos"],
    data() {
        return {};
    },
    beforeCreate() {
        this.eventos.forEach((evento) => {
            evento.data_inicio = new Date(evento.data_inicio);
            evento.data_fim = new Date(evento.data_fim);
        });
    },
    methods: {},
    mounted() {
        let items = document.querySelectorAll(".slider .item");
        let seletores = document.querySelectorAll(".slider .seletores");
        for (let i = 0; i < seletores.length; i++) {
            seletores[i].style.transform = `translateX(${
                (i + 1 - seletores.length / 2) * 55 - 27.5
            }px)`;
        }
        let next = document.getElementById("next");
        let prev = document.getElementById("prev");

        let active = 0;

        function loadShow() {
            items[active].style.transform = `none`;
            items[active].style.zIndex = 1;
            items[active].style.filter = "none";

            let stt = 0;
            let index = 0;
            for (let i = 1; i <= Math.floor(items.length / 2); i++) {
                stt++;
                index = (active + i) % items.length;
                items[index].style.transform = `translateX(${600 * stt}px)`;
                items[index].style.zIndex = -stt;
                items[index].style.filter = `blur(5px)`;
            }
            stt = 0;
            for (let i = 1; i <= Math.floor((items.length - 1) / 2); i++) {
                stt++;
                index = (active - i + items.length) % items.length;
                items[index].style.transform = `translateX(${-600 * stt}px)`;
                items[index].style.zIndex = -stt;
                items[index].style.filter = `blur(5px)`;
            }

            for (let i = 0; i < seletores.length; i++) {
                seletores[i].style.backgroundColor = "#ffffff74";
            }
            seletores[active].style.backgroundColor = "#fffe";
        }
        loadShow();

        next.onclick = function () {
            active = active + 1 < items.length ? active + 1 : 0;
            loadShow();
        };

        prev.onclick = function () {
            active = active - 1 > -1 ? active - 1 : items.length - 1;
            loadShow();
        };

        for (let i = 0; i < seletores.length; i++) {
            seletores[i].onclick = function (event) {
                active = event.currentTarget.id.replace("seletor-", "") * 1;

                loadShow();
            };
        }
    },
};
</script>
