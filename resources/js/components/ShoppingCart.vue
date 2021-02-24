<template>

  <div class="component-container">
    <!-- DISHES CARDS -->
    <section class="dish-cards-container">

      <!-- da aggiungere v-if visibility -->
      <div class="dish-card"
      v-for='dish in json_dishes'
      >

        <div class="card-body">
          <div class="contentBox">


              <div class="img-box">
                <img :src="dish.cover" alt="">
              </div>


              <div class="info-box">
                <h3 class="dish-header">{{ dish.name }}</h3>
                <h2>{{ dish.price.toFixed(2) }}$</h2>
                <!-- <p class="dish-description">{{ dish.description }}</p> -->
              </div>

          </div>

          <div class="info-box-2">
            <p> <span>Description: </span> {{dish.description}}</p>
            <p> <span>Ingredients: </span> {{dish.ingredients}}</p>
          </div>

          <div class="cart-adder">

              <i class="fas fa-minus" @click='updateCart(dish, "subtract");piece += 1;'></i>

              <span class="dish-quantity">{{ dish.quantity }}</span>

              <i class="fas fa-plus" @click='updateCart(dish, "add");piece += 1;'></i>

          </div>
        </div>

      </div>

      <div class="space-for-icon-mobile"></div>

    </section>

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
            <h3 class="cart-title">Your wishes: <span>(Total price: {{this.totalPrice.toFixed(2)}}$)</span> </h3>
          </li>
          <li
          v-for='dish in cart'
          >
          <div @click="remove_from_cart(dish.id)">
            <i class="fas fa-trash-alt"></i>
          </div>
          <div class="cart-card">
            <div class="cart-card-img">
              <img :src="dish.cover" alt="">
            </div>
            <div class="cart-card-info">
              <p>{{ dish.name }}:</p>
              <p>{{dish.price.toFixed(2)}}$</p>
              <div class="dish-quantity">
                <span>x {{ dish.quantity }}</span>
                <div class="btn-group">
                  <i class="fas fa-minus" @click='updateCart(dish, "subtract");piece += 1;'></i>
                  <i class="fas fa-plus" @click='updateCart(dish, "add");piece += 1;'></i>
                </div>
              </div>
            </div>
          </div>
          </li>
          <li class="space-for-icon-mobile-cart"></li>
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

      //flag per toggle del carrello
      show_cart: false,

      //flag per verificare se il ristorante è cambiato e cancellare storage
      check_restaurant: this.flag_restaurant,

      piece:1,

      cart_total_price: 0,

    };

  },
  beforeMount() {
    //restrutturazione JSON per togliere dati inutili
    this.struct_json();
    // console.log('beforeMount: ');
    // console.log('This dishes: ',this.dishes);
    // console.log('This json dishes: ',this.json_dishes);
    //Before mount tutto ok
  },
  mounted() {

    // controlllo se il componente funziona
    // alert('component working!');

    //controllo se è cambiato il ristorante
    if (localStorage.check_restaurant == this.check_restaurant) {
      this.take_data_from_localStorage();
    }else{
      localStorage.clear();
    }

    this.check_flag_restaurant();
    // console.log('Mounted: ');
    // console.log('This dishes: ',this.dishes);
    // console.log('This json dishes: ',this.json_dishes);
    // console.log(this.json_dishes);

    console.log('here: ',this.cart);

  },
  methods: {

    check_flag_restaurant(){
      localStorage.check_restaurant = this.check_restaurant;
    },
    struct_json(){
      //itero json_dishes
      for (var i = 0; i < this.json_dishes.length; i++) {
        for (var key of Object.keys(this.json_dishes[i])) {

          //rimuovo le proprieta inutili al carrello
          if((key = 'restaurant_id') || (key = 'dish_category_id') || (key = 'created_at') || (key = 'updated_at')){
            // delete this.json_dishes[i].cover;
            delete this.json_dishes[i].restaurant_id;
            delete this.json_dishes[i].dish_category_id;
            delete this.json_dishes[i].created_at;
            delete this.json_dishes[i].updated_at;
          }

        }
      }
    },
    take_data_from_localStorage(){
      // console.log(JSON.stringify(this.json_dishes));
      // console.log(JSON.stringify(localStorage.shopping_cart));

      //se esiste shopping_cart in local storage
      if (localStorage.shopping_cart) {
        this.json_dishes = JSON.parse(localStorage.shopping_cart);
      }

      //se esiste show_cart in local storage
      if (localStorage.show_cart) {
        this.show_cart = JSON.parse(localStorage.show_cart);
      }

    },
    //toggle per la visibility del carrello
    showCart(){
      this.show_cart = !this.show_cart;
      localStorage.show_cart = JSON.stringify(this.show_cart);
    },
    //funzione per aggiungere o togliere quantity di un prodotto da aquistare
    updateCart(dish, updateType){

      //rimuovo i prodotti da lcalstorage per inserirli aggiornati più avanti
      localStorage.removeItem('shopping_cart');

      //scorro il JSON prodotti
      for (var i = 0; i < this.json_dishes.length; i++) {
        // console.log(this.json_dishes[i].id === dish.id);
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
            // console.log('HERE: ', this.json_dishes[i]);
          }

        }

      }
      //salvataggio dei dishes
      localStorage.shopping_cart = JSON.stringify(this.json_dishes);
      // console.log(this.cart);

    },
    remove_from_cart(id){
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
transform: rotateX(-720deg);
}
</style>
