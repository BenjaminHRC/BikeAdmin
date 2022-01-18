let current_date = moment().format("YYYY");
let $primary = "#4e73df",
    $secondary = "#858796",
    $success = "#1cc88a",
    $info = "#36b9cc",
    $warning = "#f6c23e",
    $danger = "#e74a3b";
var $themeColor = [$primary, $success, $info, $warning, $danger, $secondary];

const chooseYear = () => {
    $("#last_year").click(() => {
        current_date = moment(current_date).subtract(1, "years");
        $("#select_year").html(moment(current_date).format("YYYY"));
        ajaxGetCAStore();
        ajaxGetTopStaff();
    });
    $("#next_year").click(() => {
        current_date = moment(current_date).add(1, "years");
        $("#select_year").html(moment(current_date).format("YYYY"));
        ajaxGetCAStore();
        ajaxGetTopStaff();
    });
};

const ajaxGetCAStore = () => {
    $.ajax({
        type: "get",
        url: "getCAStore/" + moment(current_date).format("YYYY"),
        dataType: "json",
        success: (json) => {
            // console.log(json);
            $.each(json, (k, v) => {
                if (v.store_name == "Baldwin Bikes") {
                    $("#baldwin_ca").html(
                        v.CA
                            ? new Intl.NumberFormat("fr-FR", {
                                  style: "currency",
                                  currency: "EUR",
                              }).format(v.CA)
                            : ""
                    );
                }
                if (v.store_name == "Rowlett Bikes") {
                    $("#rowlett_ca").html(
                        v.CA
                            ? new Intl.NumberFormat("fr-FR", {
                                  style: "currency",
                                  currency: "EUR",
                              }).format(v.CA)
                            : ""
                    );
                }
                if (v.store_name == "Santa Cruz Bikes") {
                    $("#santa_ca").html(
                        v.CA
                            ? new Intl.NumberFormat("fr-FR", {
                                  style: "currency",
                                  currency: "EUR",
                              }).format(v.CA)
                            : ""
                    );
                }
            });
        },
    });
};

let chartTopStaff;
let optionsTopStaff = {
    chart: {
        type: "bar",
    },
    series: [
        {
            data: [],
        },
    ],
    plotOptions: {
        bar: {
            distributed: true,
        },
    },
    colors: $themeColor,
    // yaxis: {
    //     reversed: true,
    // },
    xaxis: {
        categories: [],
    },
};

const ajaxGetTopStaff = () => {
    $.ajax({
        type: "get",
        url: "getTopStaff/" + moment(current_date).format("YYYY"),
        dataType: "json",
        success: (json) => {
            console.log(json);
            let data = [];
            let categories = [];
            if (chartTopStaff != null) {
                chartTopStaff.destroy();
            }
            $.each(json, (k, v) => {
                // optionsTopStaff.series[0].data.push(v.quantity);
                // optionsTopStaff.xaxis.categories.push(v.identite);
                data.push(v.quantity);
                categories.push(v.identite);
            });
            optionsTopStaff.series[0].data = data;
            optionsTopStaff.xaxis.categories = categories;
            chartTopStaff = new ApexCharts(
                document.querySelector("#chartTopStaff"),
                optionsTopStaff
            );
            chartTopStaff.render();
        },
    });
};
const updateAjaxGetTopStaff = () => {
    $.ajax({
        type: "get",
        url: "getTopStaff/" + moment(current_date).format("YYYY"),
        dataType: "json",
        success: (json) => {
            console.log(json);
            // let updateChartTopStaff = new ApexCharts(
            //     document.querySelector("#chartTopStaff"),
            //     optionsTopStaff
            // );
            chartTopStaff.destroy();
            optionsTopStaff.series[0].data = [];
            $.each(json, (k, v) => {
                optionsTopStaff.series[0].data.push(v.quantity);
            });
            console.log(optionsTopStaff);
            chartTopStaff.updateSeries(optionsTopStaff.series[0]);
        },
    });
};
let optionsTopProduct = {
    series: [
        {
            data: [],
        },
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: true,
            distributed: true,
        },
    },
    colors: $themeColor,
    dataLabels: {
        enabled: true,
    },
    xaxis: {
        categories: [],
    },
};

let optionsTopBrand = {
    series: [
        {
            data: [],
        },
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: true,
            distributed: true,
        },
    },
    dataLabels: {
        enabled: true,
    },
    colors: $themeColor,
    xaxis: {
        categories: [],
    },
};

let optionsNbProduct = {
    series: [
        {
            data: [],
        },
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: false,
            distributed: true,
        },
    },
    dataLabels: {
        enabled: true,
    },
    colors: $themeColor,
    xaxis: {
        categories: [],
    },
};

$(() => {
    $("#select_year").val(moment(current_date).format("YYYY"));
    chooseYear();
    ajaxGetCAStore();
    ajaxGetTopStaff();
    $.ajax({
        type: "get",
        url: "topProduct",
        dataType: "json",
        success: (json) => {
            // console.log(json);
            $.each(json, (k, v) => {
                optionsTopProduct.series[0].data.push(v.total_quantity);
                optionsTopProduct.xaxis.categories.push(v.product_name);
            });
            let chartTopProduct = new ApexCharts(
                document.querySelector("#chartTopProduct"),
                optionsTopProduct
            );
            chartTopProduct.render();
        },
    });
    $.ajax({
        type: "get",
        url: "topBrand",
        dataType: "json",
        success: (json) => {
            // console.log(json);
            $.each(json, (k, v) => {
                optionsTopBrand.series[0].data.push(v.total_quantity);
                optionsTopBrand.xaxis.categories.push(v.brand_name);
            });
            let chartTopBrand = new ApexCharts(
                document.querySelector("#chartTopBrand"),
                optionsTopBrand
            );
            chartTopBrand.render();
        },
    });
    $.ajax({
        type: "get",
        url: "nbProduct",
        dataType: "json",
        success: (json) => {
            // console.log(json);
            $.each(json, (k, v) => {
                optionsNbProduct.series[0].data.push(v.quantity);
                optionsNbProduct.xaxis.categories.push(v.store_name);
            });
            // console.log(optionsNbProduct);
            let chartNbProduct = new ApexCharts(
                document.querySelector("#chartNbProduct"),
                optionsNbProduct
            );
            chartNbProduct.render();
        },
    });
});
