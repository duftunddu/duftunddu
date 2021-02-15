// var table_ang = angular.module('table', ['ui.bootstrap']);

var table_ang = angular.module('table', ['ui.bootstrap'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

table_ang.controller('table-controller', function ($scope) {
    $scope.unavailables = $arr_of_unavail,
        $scope.array = [],
        $scope.currentPage = 1,
        $scope.numPerPage = 10,
        $scope.maxSize = 5;

    $scope.numPages = function () {
        return Math.ceil($scope.unavailables.length / $scope.numPerPage);
    };

    $scope.$watch('currentPage + numPerPage', function () {
        var begin = (($scope.currentPage - 1) * $scope.numPerPage)
            , end = begin + $scope.numPerPage;

        $scope.array = $scope.unavailables.slice(begin, end);
    });
});