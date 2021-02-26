var $ = require('jquery');

$(document).ready(function(){
    console.log('javascript ok');

    // Funzione per recuperare i dati dei ristoranti nota la categoria
    $('#restaurant-categories').on('click', 'a', function(event){

        event.preventDefault();

        var name_category = $(this).attr('category');
        console.log(name_category);

        $.ajax({
            method: 'GET',
            url: 'http://localhost:8000/api/restaurants_by_category',
            data: {
                'category': name_category
            },
            success: function(response){
                console.log(response);

                var restaurants = response.restaurants;
                restaurants.forEach((restaurant, i) => {
                    console.log(restaurant['name']);

                    var item = $('.ristorante_per_categoria').first().clone();

                    item.children('a').text(restaurant['name']);

                    item.children('a').attr('href', `http://localhost:8000/restaurant/${restaurant['slug']}`);

                    $('#ristoranti_per_categoria').append(item);
                });
            },
            error: function(){
                console.log('error');
            }
        });
    });

    // Funzione per recuperare i dati dei piatti dal menu del ristorante
    $('#restaurant-menu').on('click', 'a', function(event){

        event.preventDefault();


    // --

        var menu_id = $(this).attr('menu-id');
        var restaurant_id = $(this).attr('restaurant-id');

        $.ajax({
            method: 'GET',
            url: 'http://localhost:8000/api/dishes_by_restaurant_menu',
            data: {
                'restaurant_id': restaurant_id,
                'menu_id': menu_id
            },
            success: function(response){
                console.log(response);

                var dishes = response.dishes_by_restaurant_menu;
                dishes.forEach((dishes, i) => {
                    console.log(dishes);
                });
            },
            error: function(){
                console.log('error');
            }
        });
    });
    // Funzione per la visibilità della sidebar
        // Francesco Bello
        $('.hamburger-button').click(function () {
          $('nav').toggleClass('show');
          $(".text").css("display", "block");
        });
        $(".hamburger").click(function () {
          $(".text").css("display", "block");
          $('nav').toggleClass('show-p')
                    .toggleClass('show');
        });
          //$('.text').css('display', 'block');
          //$('.icon').css('display', 'block');

  //      $("nav").click(function(){
    //     $("nav").css("width", "248");
      ///   $(".close-sidebar").css("display", "block");
         //$(".text").css("display", "block");
        //});
        //$(".close-sidebar").click(function(){
         //$("nav").css("width", "88");
         //$(".close-sidebar").css("display", "none");
         //$(".text").css("display", "none");
        //});


     //$(".hamburger").click(function(){
       //$("nav").css("display", "block");
      //$("nav").css("width", "248");
      //$(".text").css("display", "block");
      //$(".close").css("display", "block");
      //$(".hamburger").css("display", "none");
     //});

    //$(".close").click(function(){
      //$("nav").css("display", "none");
       //$("nav").css("width", "88px");
       //$(".text").css("display", "none");
       //$(".hamburger").css("display", "block");
       //$(".close").css("display", "none");
     //});
});
