var view = new Vue({
    el: "main",
    delimiters: ["${", "}$"],
    data: {
        tbody: [],
        deleted: [],
        sorting: true,
        buttonEnabled: false,
        arrows: null,
        checkedRows: [],
        nameVisible: [],
        showAds: {
            type: "GET",
            url: document.URL + "/list",
            success: function(response) {
                view.tbody = response;
            },
            dataType: "json",
            async: true
        }
    },
    mounted: function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $.ajax(this.showAds).then(() => this.nameVisibility(true));
    },
    methods: {
        cellContent: function(value) {
            if (
                typeof value == "string" &&
                value.length > 10 &&
                value != "EXCEPTIONAL"
            ) {
                value = value.substr(0, 10) + "...";
                return value;
            }
            return value;
        },
        nameVisibility: function(value, index) {
            if (typeof value !== "undefined" && typeof index !== "undefined")
                this.nameVisible[index] = value;
            else {
                this.nameVisible = [];
                this.tbody.forEach(() => {
                    this.nameVisible.push(value);
                });
            }
        },
        sortRows: function(e) {},

        deleteRows: function() {
            $.ajax({
                url: document.URL,
                type: "DELETE",
                data: {
                    ads: view.checkedRows
                },
                success: function(response) {
                    view.checkedRows = [];
                    $.ajax(view.showAds);
                    view.deleted = response;
                    view.selectAll(true);
                    $("#deleteComplete").modal();
                },
                dataType: "json"
            });
        },
        deleteOne: function(deleteThis) {
            $.ajax({
                url: document.URL,
                type: "DELETE",
                data: {
                    ads: deleteThis
                },
                success: function(response) {
                    /*____________________*/
                    view.selectAll(true);
                    $.ajax(view.showAds);
                },
                dataType: "json"
            });
        },
        selectAll: function(uncheck) {
            let falseV = false;
            let cb = $("tr td [type=checkbox].select");

            for (let i = 0; i < cb.length; i++) {
                if (
                    !$("tr td [type=checkbox].select:eq(" + i + ")").prop(
                        "checked"
                    )
                ) {
                    falseV = true;
                    break;
                }
            }
            if (uncheck != true) {
                falseV ? cb.prop("checked", true) : cb.prop("checked", false);
            } else cb.prop("checked", false);
        },
        buttonActive: function() {
            if ($("[type=checkbox].select:checked").length > 0)
                $("#table-controls button").removeAttr("disabled");
            else $("#table-controls button").attr("disabled", true);
        },
        toggleEnabled: function(e, id) {
            var e = e.target.value;
            e = e == 1 ? 0 : 1;
            console.log(e);
            $.ajax({
                url: document.URL,
                type: "PATCH",
                data: {
                    id: id,
                    enabled: e
                },
                success: function(response) {
                    /*_____________________ */
                }
            });
        }
    }
});
