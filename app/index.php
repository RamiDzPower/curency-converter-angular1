<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
  <title>Gomeeki Curency Converter</title>
  <!--build:css css/styles.min.css-->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400" rel="stylesheet">
     <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/style.css">
  <!--endbuild-->
  <script src="js/angular.min.js"></script>
</head>

<body ng-app="appConvert" ng-controller="myConvert">
<header>
  <div class="container">
      <span class="menu-title">conerter</span>
    <nav>
      <input type="checkbox" id="menu-trigger" />
      <div class="menu-wrap">
          <label for="menu-trigger">
            <i class="fa fa-bars" aria-hidden="true"></i>
          </label>
          <span class="settings">settings</span>
          <ul>
            <li ng-repeat="data in myData">
                <a href="#" ng-click="setCountryData(data)" markable class="convert-currency">{{ data.menu_label }}</a>
            </li>
          </ul>
      </div>
    </nav>
  </div>
</header>
    <div class="main-container">
          <div class="row">
              <div class="input-currency-container">
                  <div class="col-sm-6 currency-input-container from-container">
                      <div class="flag-label-container">
                          <img ng-src="{{ from_icon }}" alt="" class="flag">
                          <span class="currency-name">{{ from_label }}</span>                        
                      </div>
                      <input type="text" class="currency-input" id="fromCurrency"  ng-change="doCalculation()" ng-model="fromCurrency">
                  </div>
                  <div class="col-sm-6 currency-input-container to-container">
                      <div class="flag-label-container">
                          <img ng-src="{{ to_icon }}" alt="" class="flag">
                          <span class="currency-name">{{  to_label }}</span>
                      </div>
                      <input type="text" class="currency-input" value="{{ answer }}">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="converter-calculator-container">
                  <ul class="list-calculator">
                          <div class="col-xs-4 col-md-3" ng-repeat="v in vars">
                              <li class="number" value="{{v}}" id="{{v}}" ng-click="setNumberText(v)">{{v}}</li>
                          </div>
                  </ul>                   
              </div>
          </div>
    </div>
  <!--build:js js/main.min.js -->
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(".currency-input").on("keydown keypress keyup", false); // to desiable kebord keys

        var app = angular.module('appConvert', []);
          app.controller('myConvert', function($scope, $http) {
              $scope.from_label = "";
              $scope.to_label = "";
              $scope.from_icon = "";
              $scope.to_icon = "";
              $scope.ratio = 0;
              $scope.answer  = "0.00";
              $scope.fromCurrency = 0;
              $scope.vars = ['1', '2', '3','4','5' ,'6','7' ,'8' ,'9' ,'0' , "." , "<" ];

              $scope.doCalculation = function(){
                           vals = $scope.fromCurrency;
                            ans = parseFloat(vals) * parseFloat($scope.ratio);
                            $scope.answer = ans.toFixed(2);
              }

              $scope.setCountryData = function(dataItem){               
                  $scope.from_label = dataItem.from_label;
                  $scope.to_label = dataItem.to_label;
                  $scope.from_icon = dataItem.from_icon;
                  $scope.to_icon = dataItem.to_icon;
                  $scope.ratio = dataItem.ratio;
                  $scope.doCalculation();
              }

              $scope.setNumberText = function(vals){
                  prevText = $scope.fromCurrency;
                  if(!prevText)
                      prevText = "";

                    if(vals=='<'){
                      newText = 0;
                    }else {
                      newText = prevText + vals.trim();    
                    }
                  
                  $scope.fromCurrency = newText;
                  $scope.doCalculation();
              }      

              $http.get("js/currencies.json").success(function (response) {
                  $scope.myData = response;
              });
        });
    </script>
  <!-- endbuild -->
</body>

</html>
