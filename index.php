<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyPokemonBinder</title>
    <meta name="description" content="Mypokemonebinder is a website that displays pokemon cards in a viewing format similar to a Pokemon book. You can search by sets, pokedex mode, or by card name.">
    <meta name="author" content="Faraj Ahmed Daoud">
    <meta name="keywords" content="Pokemon, Cards, TCG, pokemon book">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="favicon.ico?v=2" type="image/x-icon">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <div ng-app="myApp" ng-controller="cardsCtrl">
        <div id="banner"><img src="imgs/pokemon_banner.jpg"></div>
        <div id="about" class="container-fluid">
            <p>Search by set or use pokedex mode below. Clicking on an image toggles zoom in and zoom out. Clicking on the left and right arrows will retrieve the previous or next 18 cards.</p>
            <p id="about_info">Set:
                <select ng-model="setCode" ng-change="get_set()">
                    <option value=""></option>
                    <option ng-selected='base' ng-repeat="x in sets" value="{{x.code}}">{{x.name}}</option>
                </select>
            </p>
            <p>Search cards:
                <input ng-model="searchCard" update-on-enter>
                <button id="search_btn" ng-click="getCardByName()">Search</button>
            </p>
            <p>
                <button ng-click="pokedex_mode()">Pokedex Mode {{pokedex_on}}</button>
            </p>
        </div>
        <div id="binder_wrapper"> <img src="imgs/binder.jpg" id="binder"></div>
        <div>
            <div id="container_wrapper">
                <div class="img_wrapper" id="count_1">  <img ng-src="imgs/cards_compressed/{{imgs[0].url}}"  id="p_num_{{imgs[0].pokedex_number}}"  ng-click="zoom_in('count_1')">  </div>
                <div class="img_wrapper" id="count_2">  <img ng-src="imgs/cards_compressed/{{imgs[1].url}}"  id="p_num_{{imgs[1].pokedex_number}}"  ng-click="zoom_in('count_2')">  </div>
                <div class="img_wrapper" id="count_3">  <img ng-src="imgs/cards_compressed/{{imgs[2].url}}"  id="p_num_{{imgs[2].pokedex_number}}"  ng-click="zoom_in('count_3')">  </div>
                <div class="img_wrapper" id="count_4">  <img ng-src="imgs/cards_compressed/{{imgs[3].url}}"  id="p_num_{{imgs[3].pokedex_number}}"  ng-click="zoom_in('count_4')">  </div>
                <div class="img_wrapper" id="count_5">  <img ng-src="imgs/cards_compressed/{{imgs[4].url}}"  id="p_num_{{imgs[4].pokedex_number}}"  ng-click="zoom_in('count_5')">  </div>
                <div class="img_wrapper" id="count_6">  <img ng-src="imgs/cards_compressed/{{imgs[5].url}}"  id="p_num_{{imgs[5].pokedex_number}}"  ng-click="zoom_in('count_6')">  </div>
                <div class="img_wrapper" id="count_7">  <img ng-src="imgs/cards_compressed/{{imgs[6].url}}"  id="p_num_{{imgs[6].pokedex_number}}"  ng-click="zoom_in('count_7')">  </div>
                <div class="img_wrapper" id="count_8">  <img ng-src="imgs/cards_compressed/{{imgs[7].url}}"  id="p_num_{{imgs[7].pokedex_number}}"  ng-click="zoom_in('count_8')">  </div>
                <div class="img_wrapper" id="count_9">  <img ng-src="imgs/cards_compressed/{{imgs[8].url}}"  id="p_num_{{imgs[8].pokedex_number}}"  ng-click="zoom_in('count_9')">  </div>
                <div class="img_wrapper" id="count_10"> <img ng-src="imgs/cards_compressed/{{imgs[9].url}}"  id="p_num_{{imgs[9].pokedex_number}}"  ng-click="zoom_in('count_10')"> </div>
                <div class="img_wrapper" id="count_11"> <img ng-src="imgs/cards_compressed/{{imgs[10].url}}" id="p_num_{{imgs[10].pokedex_number}}" ng-click="zoom_in('count_11')"> </div>
                <div class="img_wrapper" id="count_12"> <img ng-src="imgs/cards_compressed/{{imgs[11].url}}" id="p_num_{{imgs[11].pokedex_number}}" ng-click="zoom_in('count_12')"> </div>
                <div class="img_wrapper" id="count_13"> <img ng-src="imgs/cards_compressed/{{imgs[12].url}}" id="p_num_{{imgs[12].pokedex_number}}" ng-click="zoom_in('count_13')"> </div>
                <div class="img_wrapper" id="count_14"> <img ng-src="imgs/cards_compressed/{{imgs[13].url}}" id="p_num_{{imgs[13].pokedex_number}}" ng-click="zoom_in('count_14')"> </div>
                <div class="img_wrapper" id="count_15"> <img ng-src="imgs/cards_compressed/{{imgs[14].url}}" id="p_num_{{imgs[14].pokedex_number}}" ng-click="zoom_in('count_15')"> </div>
                <div class="img_wrapper" id="count_16"> <img ng-src="imgs/cards_compressed/{{imgs[15].url}}" id="p_num_{{imgs[15].pokedex_number}}" ng-click="zoom_in('count_16')"> </div>
                <div class="img_wrapper" id="count_17"> <img ng-src="imgs/cards_compressed/{{imgs[16].url}}" id="p_num_{{imgs[16].pokedex_number}}" ng-click="zoom_in('count_17')"> </div>
                <div class="img_wrapper" id="count_18"> <img ng-src="imgs/cards_compressed/{{imgs[17].url}}" id="p_num_{{imgs[17].pokedex_number}}" ng-click="zoom_in('count_18')"> </div>
                <!-- <div ng-repeat="x in imgs" class="img_wrapper" id="count_{{imgs[0].count}}"> <img ng-src="imgs/cards_compressed/{{x.url}}" id="p_num_{{x.pokedex_number}}" ng-click="zoom_in('count_')"> </div>--></div>
            <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
                <a class="left carousel-control" role="button" ng-click="get_cards_left(s_num.start, e_num.end)" ng-show="show_left_fun()"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                <a class="right carousel-control" role="button" ng-click="get_cards_right(s_num.start, e_num.end)" ng-show="show_right_fun()"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
            </div>
        </div>
    </div>
    <link href="css/main.css" rel='stylesheet'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
</body>

</html>