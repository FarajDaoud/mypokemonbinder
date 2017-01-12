<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="icon" href="">-->
    <title>MyPokemonBook</title>
    <meta name="description" content="Mypokemonebook is a website that displays pokemon cards in a viewing format similar to a Pokemon book. You can search by sets, pokedex mode, or by card name.">
    <meta name="author" content="Faraj Ahmed Daoud">
    <meta name="keywords" content="Pokemon, Cards, TCG, pokemon book">
    <meta name="robots" content="index, follow">
    <link href="css.css" rel='stylesheet'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<div ng-app="myApp" ng-controller="cardsCtrl">

<div id="banner">
<img src="imgs/pokemon_banner.jpg">
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <p>Search by set or use pokedex mode below. Clicking on an image toggles zoom in and zoom out mode. Clicking on the left and right arrows will retrieve the previous or next 18 cards.</p>
      <p>Set: <select ng-model="setCode" ng-change="get_set()"><option value=""></option><option ng-selected='base' ng-repeat="x in sets" value="{{ x.code }}">{{ x.name }}</option></select>
         <button ng-click="pokedex_mode()">Pokedex Mode</button> <label type="text" ng-show="pokedex_on == 'on'">Pokedex Mode: {{pokedex_on}}</label> </p>
         <p>Search card by name: <input ng-model="searchCard" update-on-enter> <button id="search_btn" ng-click="getCardByName()">Search</button></p>
    </div>
  </div>
</div>

<div id="binder_wrapper">
    <img src="imgs/binder.png" id="binder">
</div>

<div>

    <div id="container_wrapper">
        <div class="img_wrapper" id="count_1">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[0].url }}" id="p_num_{{ imgs[0].pokedex_number }}" ng-click="zoom_in('count_1')">
        </div>
        <div class="img_wrapper" id="count_2">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[1].url }}" id="p_num_{{ imgs[1].pokedex_number }}" ng-click="zoom_in('count_2')">
        </div>
        <div class="img_wrapper" id="count_3">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[2].url }}" id="p_num_{{ imgs[2].pokedex_number }}" ng-click="zoom_in('count_3')">
        </div>
        <div class="img_wrapper" id="count_4">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[3].url }}" id="p_num_{{ imgs[3].pokedex_number }}" ng-click="zoom_in('count_4')">
        </div>
        <div class="img_wrapper" id="count_5">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[4].url }}" id="p_num_{{ imgs[4].pokedex_number }}" ng-click="zoom_in('count_5')">
        </div>
        <div class="img_wrapper" id="count_6">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[5].url }}" id="p_num_{{ imgs[5].pokedex_number }}" ng-click="zoom_in('count_6')">
        </div>
        <div class="img_wrapper" id="count_7">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[6].url }}" id="p_num_{{ imgs[6].pokedex_number }}" ng-click="zoom_in('count_7')">
        </div>
        <div class="img_wrapper" id="count_8">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[7].url }}" id="p_num_{{ imgs[7].pokedex_number }}" ng-click="zoom_in('count_8')">
        </div>
        <div class="img_wrapper" id="count_9">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[8].url }}" id="p_num_{{ imgs[8].pokedex_number }}" ng-click="zoom_in('count_9')">
        </div>
        <div class="img_wrapper" id="count_10">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[9].url }}" id="p_num_{{ imgs[9].pokedex_number }}" ng-click="zoom_in('count_10')">
        </div>
        <div class="img_wrapper" id="count_11">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[10].url }}" id="p_num_{{ imgs[10].pokedex_number }}" ng-click="zoom_in('count_11')">
        </div>
        <div class="img_wrapper" id="count_12">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[11].url }}" id="p_num_{{ imgs[11].pokedex_number }}" ng-click="zoom_in('count_12')">
        </div>
        <div class="img_wrapper" id="count_13">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[12].url }}" id="p_num_{{ imgs[12].pokedex_number }}" ng-click="zoom_in('count_13')">
        </div>
        <div class="img_wrapper" id="count_14">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[13].url }}" id="p_num_{{ imgs[13].pokedex_number }}" ng-click="zoom_in('count_14')">
        </div>
        <div class="img_wrapper" id="count_15">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[14].url }}" id="p_num_{{ imgs[14].pokedex_number }}" ng-click="zoom_in('count_15')">
        </div>
        <div class="img_wrapper" id="count_16">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[15].url }}" id="p_num_{{ imgs[15].pokedex_number }}" ng-click="zoom_in('count_16')">
        </div>
        <div class="img_wrapper" id="count_17">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[16].url }}" id="p_num_{{ imgs[16].pokedex_number }}" ng-click="zoom_in('count_17')">
        </div>
        <div class="img_wrapper" id="count_18">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ imgs[17].url }}" id="p_num_{{ imgs[17].pokedex_number }}" ng-click="zoom_in('count_18')">
        </div>
        <!--
        <div ng-repeat="x in imgs" class="img_wrapper" id="count_{{ imgs[0].count }}">
            <img  ng-src="https://pkmncards.com/wp-content/uploads/{{ x.url }}" id="p_num_{{ x.pokedex_number }}" ng-click="zoom_in('count_')">
        </div>
        -->
        
    </div>
    <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
        <!-- Left and right controls -->
        <a class="left carousel-control" role="button" ng-click="get_cards_left(s_num.start, e_num.end)" ng-show="show_left_fun()">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" role="button" ng-click="get_cards_right(s_num.start, e_num.end)" ng-show="show_right_fun()">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>       

</div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
var app = angular.module('myApp', []);

app.controller('cardsCtrl', function($scope, $http){
    $scope.start_num = 1;
    $scope.end_num = 18;
    $scope.setCode = '';
    $scope.imgs = [];
    $scope.sets = [];

    $scope.zoom = "no";

    $scope.show_left = "no";
    $scope.show_right = "yes";

    $scope.s_num = { start: 1 };
    $scope.e_num = { end: 18 };
    $pokedex_on = 'off';
    $searchCard = '';

    $http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbook/getcards.php"
            ,data : "start=" + $scope.start_num + "&end=" + $scope.end_num + "&setCode=" + $scope.setCode + "&pokedexMode=" + $scope.pokedex_on
            ,headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function mySucces(response){
            $scope.imgs = response.data.cards;
    });

    $http({
            method: "GET"
            ,url : "http://www.djamoola.com/mypokemonbook/get_sets.php"
        }).then(function mySucces(response){
            $scope.sets = response.data.sets;
    });


  
    $('#myCarousel').css('min-height', $('#binder_wrapper').outerHeight(true));

    $scope.get_cards_right = function(s_num, e_num){
        $('#container_wrapper img').attr('src', "imgs/empty.gif");
        $http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbook/getcards.php"
            ,data : "start=" + (s_num + 18) + "&end=" + (e_num + 18) + "&setCode=" + $scope.setCode + "&pokedexMode=" + $scope.pokedex_on + "&search_card=" + $scope.searchCard
            ,headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function mySucces(response){
            $scope.imgs = response.data.cards;
            $scope.s_num = { start: s_num + 18};
            $scope.e_num = { end: e_num + 18};
            $scope.show_left = "yes";
            if(e_num + 18 > 700){
                $scope.show_right = "no";
            }
            $scope.show_right_fun();
        });
    }

    $scope.get_cards_left = function(s_num, e_num){
        $http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbook/getcards.php"
            ,data : "start=" + (s_num - 18) + "&end=" + (e_num - 18) + "&setCode=" + $scope.setCode + "&pokedexMode=" + $scope.pokedex_on + "&search_card=" + $scope.searchCard
            ,headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function mySucces(response){
            $scope.imgs = response.data.cards;
            $scope.s_num = { start: s_num - 18};
            $scope.e_num = { end: e_num - 18};
            $scope.show_right = "yes";
            if(s_num - 18 == 1){
                $scope.show_left = "no";
                $scope.show_left_fun();
            }
        });
    }

    $scope.get_set = function(){
        $('#container_wrapper img').attr('src', "imgs/empty.gif");
        $scope.pokedex_on = 'off';
        $scope.searchCard = '';
        $http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbook/getcards.php"
            ,data : "start=1&end=18&setCode=" + $scope.setCode + "&pokedexMode=" + $scope.pokedex_on + "&search_card=" + $scope.searchCard
            ,headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function mySucces(response){
            $scope.imgs = response.data.cards;
            $scope.s_num = { start: 1};
            $scope.e_num = { end: 18};
            $scope.show_left = "no";
            $scope.show_left_fun();
            $scope.show_right_fun();
        });
    }

    $scope.pokedex_mode = function(){
        $('#container_wrapper img').attr('src', "imgs/empty.gif");
        if($scope.pokedex_on == 'on'){
        	$scope.pokedex_on = 'off';
        	$scope.setCode = 'base1';
            $scope.searchCard = '';
        }
        else{
	        $scope.pokedex_on = 'on';
	        $scope.setCode = '';
            $scope.searchCard = '';
	    }
        $http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbook/getcards.php"
            ,data : "start=1&end=18&setCode=" + $scope.setCode + "&pokedexMode=" + $scope.pokedex_on
            ,headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function mySucces(response){
            $scope.imgs = response.data.cards;
            $scope.s_num = { start: 1};
            $scope.e_num = { end: 18};
            $scope.show_left = "no";
            $scope.show_left_fun();
            $scope.show_right_fun();
        });
    }

    $scope.show_left_fun = function(){
        if($scope.show_left == "no"){
            return false;
        }else return true;
    }

    $scope.show_right_fun = function(){
        if($scope.show_right == "no"){
            return false;
        }else if($('img[src="imgs/empty.gif"]').length > 0){
            return false;
        }
        else return true;
    }

    $scope.zoom_in = function(id){
        console.log('clicked ' + id);
        console.log('attr_id ' + $('.zoom_image').parent().attr('id'));
        if($('.zoom_image').parent().attr('id') == id){
            $('.zoom_image').removeClass('zoom_image');
        }else{
            $('.zoom_image').removeClass('zoom_image');
            $('#'+id+' img').addClass('zoom_image');
        }
    }


    $scope.getCardByName = function(){
    	$('#container_wrapper img').attr('src', "imgs/empty.gif");
        $scope.pokedex_on = 'off';
        $http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbook/getcards.php"
            ,data : "start=1&end=18&setCode=" + $scope.setCode + "&pokedexMode=" + $scope.pokedex_on + "&search_card=" + $scope.searchCard
            ,headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function mySucces(response){
            $scope.imgs = response.data.cards;
            $scope.s_num = { start: 1};
            $scope.e_num = { end: 18};
            $scope.show_left = "no";
            $scope.show_left_fun();
            $scope.show_right_fun();
        });
    }

    $scope.pokedex_mode();
});

angular.module('myApp').directive("updateOnEnter", function() {
            return {
                restrict: 'A',
                require: 'ngModel',
                link: function (scope, elem, attrs, ngModelCtrl) {
                    elem.bind("keyup",function(e) {
                        if (e.keyCode === 13) {
                            $('#search_btn').click();
                        }
                    });
                }
            }
        });

</script>
<script src="js/main.js"></script>
</body>

</html>
