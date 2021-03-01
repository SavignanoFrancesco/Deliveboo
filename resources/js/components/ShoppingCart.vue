<template>

  <div class="component-container">

    <!-- <h2>{{dish_category}}</h2> -->
    <div class="dish-categories">
      <!-- DISHES CARDS -->
      <div class="dish-categories-container" v-for='dish_category in dish_categories_assembled'>

        <h2 class="dish-category-title">{{dish_category}}</h2>

        <div class="dish-cards-container">
          <!-- da aggiungere v-if visibility -->
          <div class="dish-card" v-for='dish in json_dishes' v-if="dish.dish_category_name == dish_category">

            <div class="card-body">

                <div class="img-box">
                  <img :src="'../storage/'+dish.cover" alt="">
                </div>

                <div class="info-box">
                  <h2 class="dish-header">{{ dish.name }}</h2>
                  <h3>{{ dish.price }}$</h3>
                  <h4>{{ dish.ingredients }}</h4>
                  <a class="btn btn-link" @click="showModal()">Info</a>
                  <div class="cart-adder">

                      <button type="button" name="button" class="btn btn-primary" @click='updateCart(dish, "subtract");piece += 1;'>
                        <i class="fas fa-minus" ></i>
                      </button>

                      <span class="dish-quantity">{{ dish.quantity }}</span>

                      <button type="button" name="button" class="btn btn-primary" @click='updateCart(dish, "add");piece += 1;'>
                        <i class="fas fa-plus"></i>
                      </button>

                  </div>
                </div>

            </div>

            <!-- MODALE PIATTO -->
            <div class="dish-modal" v-if="show_modal">

            </div>

          <!-- END DISH CARD -->
          </div>
        </div>

        <div class="space-for-icon-mobile"></div>

      </div>
    </div>

    <!-- SIDEBAR CART -->
    <div :class="show_cart ? 'side-bar-cart-active' : 'side-bar-cart'">
      <div class="cart-icon" @click='showCart()'>

        <i :class="piece % 2 == 0 ? 'minimized' : '' " class="fas fa-shopping-cart minimizable"></i>

        <div class="quantity"> <span>{{ totalQuantity }}</span> </div>

      </div>

      <!-- SHOW/HIDE CART -->

      <div class="cart" v-if='show_cart'>

        <ul class='cart-list'>
          <li>
            <h2 class="cart-title">Carrello: <h3>Totale: {{this.totalPrice.toFixed(2)}}€</h3></h2>
          </li>
          <li
          v-for='dish in cart'
          >
          <button type="button" name="button" @click="removeProductFromCart(dish.id)" class="btn btn-danger">
            <i class="fas fa-trash-alt"></i>
          </button>
          <div class="cart-card">
            <div class="cart-card-img">
              <img :src="'../storage/'+dish.cover" alt="">
            </div>
            <div class="cart-card-info">
              <h2>{{ dish.name }}:</h2>
              <h3>{{dish.price}}€</h3>
              <div class="dish-quantity">

                <div class="btn-group">
                  <button type="button" name="button" class="btn btn-primary" @click='updateCart(dish, "subtract");piece += 1;'>
                    <i class="fas fa-minus" ></i>
                  </button>
                  <span>{{ dish.quantity }}</span>
                  <button type="button" name="button" class="btn btn-primary" @click='updateCart(dish, "add");piece += 1;'>
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          </li>
          <li class="space-for-icon-mobile-cart w-100 d-flex justify-content-center">

          </li>
        </ul>

      </div>

    </div>

  </div>
</template>

<script>
export default {
  props: ['dishes', 'flag_restaurant'],
  data: function() {
    return {
      //JSON DEI DISHES
      json_dishes: this.dishes,

      //flag per vedere se prendere i dati da local storage o no
      local_storage_good: false,

      //array di categorie raccolte dai dishes
      dish_categories_assembled: [],

      //flag per toggle del carrello
      show_cart: false,

      //flag per toggle del carrello
      show_modal: false,

      //flag per verificare se il ristorante è cambiato e cancellare storage
      check_restaurant: this.flag_restaurant,

      //per transition carrello
      piece: 1,

    };

  },
  beforeMount() {

    //raccolgo categorie piatti ristorante
    this.groupDishCategories();

    this.compareLocalStorage();

  },
  mounted() {
    // console.log('storage_dishes.length: ', JSON.parse(localStorage.shopping_cart).length);
    // console.log('dishes_length: ',this.dishes_length);
    // console.log('DISH_CATEGORIES: ', this.json_dish_categories);
    // console.log('DISH_CATEGORIES_PROP: ', this.dish_categories);
    // console.log('dishes: ',this.dishes);
    // console.log('json_dishes: ',this.json_dishes);
    // controlllo se il componente funziona
    // alert('component working!');
  },
  methods: {
    compareLocalStorage(){

      // controllo se è salvata la lista di piatti in local storage
      if (localStorage.shopping_cart) {

        var storage_dishes = JSON.parse(localStorage.shopping_cart);
        // controllo se il ristoratore ha tolto o aggiunto piatti
        if (storage_dishes.length == this.dishes.length) {
          //itero i piatti e controllo se il ristoratore ha fatto delle modifiche
          var counter = 0;
          for (var i = 0; i < this.dishes.length; i++) {

            // controllo elemento per elemento
            for (var key in this.dishes[i]) {
              if (this.dishes[i].hasOwnProperty(key)) {

                // console.log('dishes: ', key + ' -> ' + this.dishes[i][key]);
                // console.log(' rispetto a  ');
                // console.log('storage_dishes: ', key + ' -> ' + storage_dishes[i][key]);
                // console.log((this.dishes[i][key] == storage_dishes[i][key]));

                //se è cambiato un valore rispetto a quello nel local storage(la quantità scelta dall'utente può cambiare)
                if (!(this.dishes[i][key] == storage_dishes[i][key]) && (key != 'quantity')) {
                  counter++;
                }

              }
            }


          }
          //counter è la quantità di differenze
          if (counter == 0) {
            this.local_storage_good = true;
          }else {
            this.local_storage_good = false;
          }
          // console.log('se counter è 0 non ha trovato differenze. counter: ',counter);

        }
      }

      //controllo se è cambiato il ristorante, se è cambiato ressetto local storage
      if ((localStorage.check_restaurant == this.check_restaurant) && (this.local_storage_good)) {
        this.takeDataFromLocalStorage();
      }else{
        localStorage.clear();
      }

      this.checkFlagRestaurant();

    },
    groupDishCategories(){
      //raggruppo senza bevande per pusharle in fondo
      for (var i = 0; i < this.json_dishes.length; i++) {
        if ( (!this.dish_categories_assembled.includes(this.json_dishes[i].dish_category_name)
        &&  (this.json_dishes[i].dish_category_name != 'bevande')
       )) {
          this.dish_categories_assembled.push(this.json_dishes[i].dish_category_name);

        }
      }
      //pusho le bibite in fondo all'array
      for (var i = 0; i < this.json_dishes.length; i++) {
        if (!this.dish_categories_assembled.includes(this.json_dishes[i].dish_category_name)) {
          this.dish_categories_assembled.push(this.json_dishes[i].dish_category_name);
          // string.charAt(0).toUpperCase() + string.slice(1)
        }
      }
      console.log('CATEGORIES ASSEMBLED: ', this.dish_categories_assembled);

    },
    checkFlagRestaurant(){
      localStorage.check_restaurant = this.check_restaurant;
    },
    takeDataFromLocalStorage(){

      //se esiste shopping_cart in local storage
      if ((localStorage.shopping_cart)) {
        this.json_dishes = JSON.parse(localStorage.shopping_cart);
      }

      //se esiste show_cart in local storage
      if (localStorage.show_cart) {
        this.show_cart = JSON.parse(localStorage.show_cart);
      }

      //se esiste show_cart in local storage
      if (localStorage.show_modal && !(this.show_cart)) {
        this.show_modal = JSON.parse(localStorage.show_modal);
      }

    },
    //toggle per la visibility del carrello
    showCart(){
      this.show_cart = !this.show_cart;
      localStorage.show_cart = JSON.stringify(this.show_cart);
      this.show_modal = false;
      localStorage.show_modal = JSON.stringify(this.show_modal);
    },
    //toggle per la visibility del modale piatto
    showModal(){
      this.show_modal = !this.show_modal;
      localStorage.show_modal = JSON.stringify(this.show_modal);
      this.show_cart = false;
      localStorage.show_cart = JSON.stringify(this.show_cart);
    },
    //funzione per aggiungere o togliere quantity di un prodotto da aquistare
    updateCart(dish, updateType){

      //rimuovo i prodotti da lcalstorage per inserirli aggiornati più avanti
      localStorage.removeItem('shopping_cart');

      //scorro il JSON prodotti
      for (var i = 0; i < this.json_dishes.length; i++) {

        //quando trovo l'id del prodotto cliccato sul DOM
        if (this.json_dishes[i].id === dish.id) {
          // console.log();

          //se premi sottrazione
          if (updateType === 'subtract') {
            //la quantità non puo essere minore di 0
            if (this.json_dishes[i].quantity !== 0) {
              //sottrai uno alla proproetà 'quantità' del prodotto clickato
              this.json_dishes[i].quantity--;

            }
          //se premi aggiungi
          }else{
            //aggiungi uno alla proproetà 'quantità' del prodotto clickato
            this.json_dishes[i].quantity++;

          }

        }

      }
      //controllo se il ristoratore ha aggiunto o tolto piatti

      localStorage.shopping_cart = JSON.stringify(this.json_dishes);

      //salvataggio dei dishes
      // console.log(this.cart);

    },
    removeProductFromCart(id){
      //itero i dishes
      for (var i = 0; i < this.json_dishes.length; i++) {
        //matching id
        if (this.json_dishes[i].id == id) {

          this.json_dishes[i].quantity = 0;
          //salvataggio dei dishes e del totale quantita
          localStorage.shopping_cart = JSON.stringify(this.json_dishes);
        }
      }
    },
  },
  computed: {
    cart() {
      let cart_tmp = this.json_dishes.filter(dish => dish.quantity > 0);
      return cart_tmp;
    },
    totalQuantity() {
      let total_tmp = this.json_dishes.reduce((total, dish) => total + dish.quantity, 0);
      return total_tmp;
    },
    totalPrice(){
      var total = 0;
      for (var i = 0; i < this.json_dishes.length; i++) {
        total = total + (this.json_dishes[i].price * this.json_dishes[i].quantity);
      }
      return total;
    }
  },
}
</script>

<style media="screen">
.minimizable {
transition: all 0.5s ease;
}

.minimized {
transform: rotateX(-1080deg);
}
</style>
