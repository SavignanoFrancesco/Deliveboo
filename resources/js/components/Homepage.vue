<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="info-section">
                                <div class="title">
                                    <h1>Titolo</h1>
                                </div>
                                <div class="block">
                                    <p>Consegnamo i migliori piatti direttamente a casa tua!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">

                        </div>
                    </div>
                </div>
            </div>
        </div>
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