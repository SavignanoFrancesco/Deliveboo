<template>
    <div>
        <section class="jumbo">
            <div class="container container-md container-lg">
                    <div class="row">
                    <div class="hamburger">
                        <i class="fas fa-bars"></i>
                      </div>
                      <div class="close">
                        <i class="fas fa-times"></i>
                      </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="info-section">
                                <div class="title">
                                    <h1>Deliveboo</h1>
                                </div>
                                <div class="block mt-4">
                                    <h4>Consegnamo i migliori piatti direttamente a casa tua!</h4>
                                    <div class="block box-cta">
                                        <p>Sei un consumatore? Esplora i nostri gustosi ristoranti!</p>
                                        <a :href="href" @click.prevent="scroll" class="btn btn-primary">
                                            <slot>Esplora</slot>
                                        </a>
                                    </div>
                                    <div class="block box-cta">
                                        <p v-if="flag_register">Vuoi unirti a noi come ristoratore?</p>
                                        <p v-else>Raggiungi la tua Dashboard!</p>
                                        <a href="http://localhost:8000/register" class="btn btn-primary">
                                            <slot v-if="flag_register">Registrati</slot>
                                            <slot v-else>Dashboard</slot>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
                            <div class="background">
                                <img :src="'../images/general/jumbo.svg'" alt="jumbo-image">
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!--<div class="carousel-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="">Top Categorie</h3>
                        <carousel :perPage="4" :touchDrag="true" :paginationEnabled="false">
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
        </div>-->
        <section id="category" class="d-flex">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="carousel-container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3 class="">Categorie Ristorante</h3>
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
                            </div>
                            <h3>Hai selezionato</h3>
                            <div class="cards-container d-flex flex-wrap">
                                <a :href="'http://localhost:8000/restaurant/' + restaurant.slug" v-for="(restaurant, index) in restaurantList" :key="index" class="card-box m-3">
                                    <div class="card rounded-lg shadow p-3 bg-light" style="max-width: 18rem;">
                                        <div class="card-body">
                                            <img class="img-fluid" :src="'../storage/' + restaurant.cover" alt="img">
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
        props:['categories','flag_register'],
        data () {
            return {
                restaurantList: [],
                href: '#category',
                // flag_register: this.flag_register,
            }
        },
        methods: {
            async getAllCategories(){
                await axios
                .get('http://localhost:8000/api/restaurants_by_category', {
                    params: {
                        category: 'all'
                    }
                })
                .then((response) => {
                    this.restaurantList = response.data.restaurants;
                    });
            },
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
        beforeMount(){
            this.getAllCategories();
        },
        mounted () {

        }
    }
</script>
