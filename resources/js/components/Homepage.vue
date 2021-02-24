<template>
    <div>
        <section class="jumbo d-flex flex-column justify-content-between">
                <section class="hero-area d-flex justify-content-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div class="block">
                                    <h1 class="">Deliveboo</h1>
                                    <p>Consegnamo i migliori piatti direttamente a casa tua!</p>
                                    <a :href="href" @click.prevent="scroll" class="btn btn-cta">
                                        <slot>Esplora</slot>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12">
                                
                            </div>
                        </div>
                    </div>
                </section>
                <section id="carousel-box" class="d-flex" >
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="block">
                                    <h3 class="">Tipologia di Ristorante</h3>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <div class="carousel-container">
                                    <carousel :per-page="4" :touchDrag="true" paginationActiveColor="#FF7F50" paginationColor="#778899" :perPageCustom="[[768, 3], [992, 5]]">
                                        <slide v-for="(category, index) in categories" :key="index">
                                            <a href="" @click.prevent="getCategory(category.name); scroll()">
                                                <img :src="'http://localhost:8000/' + category.cover" alt="">
                                                Tipologia: {{category.name}}
                                            </a>
                                        </slide>
                                    </carousel>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </section>
        <section id="category" class="d-flex">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="block">
                                <h3>Hai selezionato</h3>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="cards-container d-flex flex-wrap">
                                <a :href="'http://localhost:8000/restaurant/' + restaurant.slug" v-for="(restaurant, index) in restaurantList" :key="index" class="card-box m-3">
                                    <div class="card rounded-lg shadow p-3 bg-light" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <img class="img-fluid" :src="restaurant.cover" alt="img">
                                        </div>
                                    </div>
                                    <h5 class="card-title mt-3">{{restaurant.name}}</h5>
                                </a>
                            </div>
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