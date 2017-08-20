var app = angular.module('diary', [])

app.controller("mainCtrl", ['$scope', '$http', '$rootScope','$location', function ($s, $http, $rs, $location) {            

   

    var data = new Date();
    var dia = data.getDate();

    var ano = data.getFullYear();  

    var mes = data.getMonth()+1;
    if (mes.toString().length == 1){
      mes = "0"+mes;
    }

    if (dia.toString().length == 1){
      dia = "0"+dia;
    }
    
    
    $s.hoje = dia + "/" + mes + "/" + ano;

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })


    $s.getRandomColor = function(){
      $s.randomNum = Math.round(Math.random() * 7);
      
      $s.Colors = [];
      $s.Colors[0] = "primary";
      $s.Colors[1] = "primary";
      $s.Colors[2] = "secondary";
      $s.Colors[3] = "success";
      $s.Colors[4] = "danger";
      $s.Colors[5] = "warning";
      $s.Colors[6] = "info";
      $s.Colors[7] = "dark";

      return $s.Colors[$s.randomNum];        
    }

    $s.acontecimentoColor = $s.getRandomColor();
    $s.randomBackground = $s.getRandomColor();

    $s.oddColor = $s.getRandomColor();
    $s.evenColor = $s.getRandomColor();

    $s.insertAcontecimento = function(acontecimento){

      $s.loading = true;
      
      if (acontecimento.length > 3) {        
        $http.post("redirect.php?funcao=insertAcontecimento" + "&acontecimento=" + acontecimento + "&color=" + $s.acontecimentoColor, {
            acontecimento: acontecimento
        }).then(function(result){
          $s.acontecimento = '';
          $s.randomBackground = $s.getRandomColor();
          $s.loading = false;
          $s.getAcontecimentosByUser();
        });
      }
    }

    $s.insertLike = function(codacontecimento){
        $http.get("redirect.php?funcao=insertLike&codacontecimento=" + codacontecimento).then(function(result){

        });
    }

    $s.removeLike = function(codacontecimento){
        $http.get("redirect.php?funcao=removeLike&codacontecimento=" + codacontecimento).then(function(result){
          
        });
    }

    $s.getAcontecimentosByUser = function(){
        $s.loading = true;
        $http.get("redirect.php?funcao=getAcontecimentosByUser").then(function(result){          
          $s.acontecimentos = result.data;          
          $s.loading = false;
        });
    }

    $s.getAcontecimentosByUser();

}]);


