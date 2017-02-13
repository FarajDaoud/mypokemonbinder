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
    /*$http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbinder/php/getcards.php"
            ,data : "start=" + $scope.start_num + "&end=" + $scope.end_num + "&setCode=" + $scope.setCode + "&pokedexMode=" + $scope.pokedex_on
            ,headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function mySucces(response){
            $scope.imgs = response.data.cards;
    });
    */
    $scope.imgs = '[{"pokedex_number":"1","url":"bulbasaur-base-set-bs-44.jpg"},{"pokedex_number":"2","url":"ivysaur-base-set-bs-30.jpg"},{"pokedex_number":"3","url":"venusaur-base-set-bs-15.jpg"},{"pokedex_number":"4","url":"charmander-base-set-bs-46.jpg"},{"pokedex_number":"5","url":"charmeleon-base-set-bs-24.jpg"},{"pokedex_number":"6","url":"charizard-base-set-bs-4.jpg"},{"pokedex_number":"7","url":"squirtle-base-set-bs-63.jpg"},{"pokedex_number":"8","url":"wartortle-base-set-bs-42.jpg"},{"pokedex_number":"9","url":"blastoise-base-set-bs-2.jpg"},{"pokedex_number":"10","url":"caterpie-base-set-bs-45.jpg"},{"pokedex_number":"11","url":"metapod-base-set-bs-54.jpg"},{"pokedex_number":"12","url":"butterfree-jungle-ju-33.jpg"},{"pokedex_number":"13","url":"weedle-base-set-bs-69.jpg"},{"pokedex_number":"14","url":"kakuna-base-set-bs-33.jpg"},{"pokedex_number":"15","url":"beedrill-base-set-bs-17.jpg"},{"pokedex_number":"16","url":"pidgey-base-set-bs-57.jpg"},{"pokedex_number":"17","url":"pidgeotto-base-set-bs-22.jpg"},{"pokedex_number":"18","url":"pidgeot-jungle-ju-24.jpg"}]';
    $http({
            method: "GET"
            ,url : "http://www.djamoola.com/mypokemonbinder/php/get_sets.php"
        }).then(function mySucces(response){
            $scope.sets = response.data.sets;
    });
  
    $('#myCarousel').css('min-height', $('#binder_wrapper').outerHeight(true));
    $scope.get_cards_right = function(s_num, e_num){
        $('#container_wrapper img').attr('src', "imgs/empty.gif");
        $http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbinder/php/getcards.php"
            ,data : "start=" + (s_num + 18) + "&end=" + (e_num + 18) + "&setCode=" + $scope.setCode + "&pokedexMode=" + $scope.pokedex_on + "&search_card=" + $scope.searchCard
            ,headers: {'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'}
        }).then(function mySucces(response){
            $scope.imgs = response.data.cards;
            $scope.s_num = { start: s_num + 18};
            $scope.e_num = { end: e_num + 18};
            $scope.show_left = "yes";
            $scope.show_right_fun();
        });
    }
    $scope.get_cards_left = function(s_num, e_num){
        $http({
            method: "POST"
            ,url : "http://www.djamoola.com/mypokemonbinder/php/getcards.php"
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
            ,url : "http://www.djamoola.com/mypokemonbinder/php/getcards.php"
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
            ,url : "http://www.djamoola.com/mypokemonbinder/php/getcards.php"
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
            ,url : "http://www.djamoola.com/mypokemonbinder/php/getcards.php"
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