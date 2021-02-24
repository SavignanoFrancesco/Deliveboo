<template>
    <div>
        <section class="jumbo">
            <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-12 col-md-6">
                            <div class="info-section">
                                <div class="title">
                                    <h1>Deliveboo</h1>
                                </div>
                                <div class="block">
                                    <h4>Consegnamo i migliori piatti direttamente a casa tua!</h4>
                                    <div class="block box-cta">
                                        <p>Sei un consumatore? Esplora i nostri gustosi ristoranti!</p>
                                        <a :href="href" @click.prevent="scroll" class="btn btn-primary">
                                            <slot>Esplora</slot>
                                        </a>
                                    </div>
                                    <div class="block box-cta">
                                        <p>Vuoi unirti a noi come ristoratore?</p>
                                        <a :href="href" @click.prevent="scroll" class="btn btn-primary">
                                            <slot>Registrati</slot>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="background">
                                <img :src="'../images/general/jumbo.svg'" alt="jumbo-image">
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="carousel-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="">Tipologia di Ristorante</h3>
                        <carousel :touchDrag="true" paginationActiveColor="#FF7F50" paginationColor="#778899" :perPageCustom="[[768, 5], [992, 11]]">
                            <slide v-for="(category, index) in categories" :key="index">
                                <a href="" @click.prevent="getCategory(category.name); scroll()">
                                    <img :src="'http://localhost:8000/' + category.cover" alt="">
                                    <p class="category-name">{{category.name}}</p>
                                </a>
                            </slide>
                        </carousel>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</template>

<script>

    import { Carousel, Slide } from 'vue-carousel';

    export default {
        components: {
        Carousel,
        Slide
        },
        props:['categories'],
        data () {
            return {
                restaurantList: [],
                href: '#category'
            }
        },
        methods: {
            async apiRequest(){
                await axios
                .get('http://localhost:8000/api/restaurants_by_category', {
                    params: {
                        category: this.category
                    }
                })
                .then((response) => {
                    this.restaurantList = response.data.restaurants;
                    });
            },
            scroll(){
                document.querySelector(this.href).scrollIntoView({behavior: 'smooth'});
            },
            getCategory(category){
                this.restaurantList = [];
                this.category = category;
                this.apiRequest();
            }
        },
        mounted () {
        }
    }
</script>