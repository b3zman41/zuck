angular.module("app", [
    'app.home',
    'app.results',
    'app.dashboard',
    'app.specialtyService',
    'app.ascService',
    'app.dialogService',
    'app.surgeon',
    'app.asc',
    'app.symptom',
    'app.symptomService',
    'app.vendor',
    'app.surgeon-dash',
    'app.vendorService',
    'app.activity',
    'app.imagecrop',
    'app.applications',
    'app.employer',

    'ngMaterial',
    'ngImgCrop',
])
    .filter("reverse", function () {
        return function (data) {
            return data.reverse();
        }
    })

    .filter('lDate', function ($filter) {
        return function (data, params) {
            return $filter('date')(new Date(data), params);
        }
    });