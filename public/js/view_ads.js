const view = new Vue({
    el: "main",
    delimiters: ["${", "}$"],
    data: {
        tbody: [],
        deleted: [],
        sorting: true,
        buttonEnabled: false,
        arrows: null,
        checkedRows: [],
        filtrationMode: false,
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

        $.ajax(this.showAds);
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
        editName: function(e) {
            let that = $(e.target);
            that.css("display", "none");
            that.next("div").css("display", "initial");
            that.next("div").children("input").focus();
        },
        sortRows: function(e) {
            // var order =  $(e.target).children(".th-content").attr("data-order");
            // $.ajax({
            //     url: document.URL,
            //     type:
            // });
        },

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
        updateName: function(e, id) {
            let that = $(e.target);
            that.parent().css("display", "none");
            that.parent().prev().css("display", "initial");
            var name = $(e.target).prev("input").val();
            $.ajax({
                url: document.URL,
                type: "PATCH",
                data: {
                    id: id,
                    name: name
                },
                success: function(response) {
                    $.ajax(view.showAds);
                    /*________________*/
                }
            })
        },
        updatePriority: function(e, id) {
            var priority = e.target.innerText;
            $.ajax({
               url: document.URL,
               type: "PATCH",
               data: {
                   id: id,
                   priority: priority
               },
               success: function(response) {
                   $.ajax(view.showAds);
                   /*___________________*/
               }
            });
        },
        updateEnabled: function(e, id) {
            var enabled = e.target.value;
            enabled = enabled == 1 ? 0 : 1;
            $.ajax({
                url: document.URL,
                type: "PATCH",
                data: {
                    id: id,
                    enabled: enabled
                },
                success: function(response) {
                    /*_____________________ */
                }
            });
        },
    }
});
