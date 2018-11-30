var view = new Vue ({
    el: "main",
    delimiters: ["${", "}$"],
    data: {
        tbody: [],
        deleted: [],
        sorting: false,
        buttonEnabled: false,
        arrows: null
    },
    methods: {
        cellContent:
            function (value) {
                if (typeof value == "string" && value.length > 10 && value != "EXCEPTIONAL") {
                    value = value.substr(0, 10) + "..."
                    return value
                }
                return value
            },
        sortRows:
            function (e) {
                this.sorting = ! this.sorting;
                var prop = $(e.target).val().trim();
                var sorting = this.tbody.sort(function (a, b) {
                    if (typeof a[prop] == "object") a[prop] = ""    // "object" == null
                    if (typeof b[prop] == "object") b[prop] = ""    // "object" == null
                    if (typeof a[prop] == "string" && typeof b[prop] == "string")
                        return a[prop].toLowerCase() > b[prop].toLowerCase() ? 1 : -1;
                    else if (typeof a[prop] == "number" && typeof b[prop] == "number")
                        return a[prop] > b[prop] ? 1 : -1
                });
                if (! this.sorting)
                    sorting.reverse();
            },
        deleteRows:
            function () {
                var destroyTheseAds = []
                for(var i = 0; i < $("[type=checkbox]:checked").length; i ++) {
                    destroyTheseAds[i] = $("[type=checkbox]:checked:eq(" + i + ")").val()
                }
                $.ajax({
                    url: "/ads/delete",
                    type: "DELETE",
                    data: {
                        ads: destroyTheseAds
                    },
                    success: function (response) {
                        $.ajax(ajaxObj)
                        view.deleted = response
                        view.selectAll(true)
                        $("#deleteComplete").modal()
                    },
                    dataType: "json"
                })
            },
        selectAll:
            function (uncheck) {
                let falseV = false
                let cb = $("tr td [type=checkbox]")

                for (let i = 0; i < cb.length; i++) {
                    if (! $("tr td [type=checkbox]:eq(" + i + ")").prop("checked")) {
                        falseV = true
                        break
                    }
                }
                if (uncheck != true)
                    falseV ? cb.prop("checked", true) : cb.prop("checked", false)
                else
                    cb.prop("checked", false)
            },
        buttonActive:
            function () {
                if ($("[type=checkbox]:checked").length > 0)
                    $("#table-controls button").removeAttr("disabled")
                else
                    $("#table-controls button").attr("disabled", true)
            }
    }
})

//AJAX time
$("table").css("display", "none")
$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    for (var i = 0; i < $(".th-content").length; i++) {
        $(".th-content:eq(" + i + ")").val($(".th-content:eq(" + i + ")").text())
        $(".th-content:eq(" + i + ")").text($(".th-content:eq(" + i + ")").text().replace(/_/g, " "))
        //$(".th-content:eq(" + i + ")").attr("title", $(".th-content:eq(" + i + ")").text().toUpperCase())
    }
    $.ajax(ajaxObj)


})
ajaxObj = {
    type: "GET",
    url: document.URL + "/show",
    success: function (response) {
        view.tbody = response
    },
    dataType: "json",
    async: true
}

