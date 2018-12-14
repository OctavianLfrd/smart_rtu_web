const view = new Vue({
    el: "main",
    delimiters: ["${", "}$"],
    data: {
        ads: [],
        deleted: [],
        buttonEnabled: false,
        checkedRows: [],
        loadAds: {
            type: "GET",
            url: document.URL + "/list",
            success: function(response) {
                view.ads = response;
            },
            dataType: "json"
        },
        advert: {
            name:        null,
            owner:       null,
            text:        null,
            type:        null,
            starts_at:   null,
            finishes_at: null,
            priority:    null,
            enabled:     null
        }
    },
    mounted: function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $.ajax(this.loadAds);
    },
    methods: {
/*__________________________________________________________________REST_METHODS_________________________________________________________________*/
        viewAd: function(index) {
            const ads = this.ads[index];
            const id = ads.id;
            for (let prop in ads) {
                if (prop !== "id")
                    this.advert[prop] = ads[prop];
            }
            $.ajax({
                url: document.URL + "/text",
                type: "GET",
                data: { id: id },
                success: function(response) {
                    view.advert.text = response[0].text;
                },
                dataType: "json"
            })
            $("#view-ads").modal();
        },
        updateName: function(index, event) {
            const ads = this.ads[index];
            const id = ads.id;
            const element = $(event.target);
            const name = element.prev().val();
            element.parent().css("display", "none");
            element.parent().prev().css("display", "initial");

            $.ajax({
                url: document.URL,
                type: "PATCH",
                data: {
                    id: id,
                    name: name
                },
                success: function(response) {
                    view.ads[index].name = response[0].name;
                },
                dataType: "json"
            })
        },
        updatePriority: function(index, priority) {
            const ads = this.ads[index];
            const id = ads.id;
            $.ajax({
            url: document.URL,
            type: "PATCH",
            data: {
                id: id,
                priority: priority
            },
            success: function(response) {
                view.ads[index].priority = response[0].priority;
            },
            dataType: "json"
            });
        },
        updateEnabled: function(index) {
            const ads = this.ads[index];
            const id = ads.id;
            let enabled = 0;
            if (ads.enabled == 0) enabled = 1;
            $.ajax({
                url: document.URL,
                type: "PATCH",
                data: {
                    id: id,
                    enabled: enabled
                },
                success: function(response) {
                    view.ads[index].enabled = response[0].enabled;
                },
                dataType: "json"
            });
        },
        deleteAds: function(index) {
            let id = this.checkedRows;
            let showModalOnComplete = true;
            if (typeof this.ads[index] !== "undefined") {
                id = this.ads[index].id;
                showModalOnComplete = false;
            }
            $.ajax({
                url: document.URL,
                type: "DELETE",
                data: {id: id},
                success: function(response) {
                    view.checkedRows = [];
                    $("#select-all").prop("checked", false);
                    $.ajax(view.loadAds);
                    if (showModalOnComplete) {
                        view.deleted = response;
                        $("#delete-complete").modal();
                    }
                },
                dataType: "json"
            })
        },
        sortRows: function(event) {
            const element = $(event.target);
            let sortColumn = element.attr("data-value");
            let sortDirection =  element.attr("data-order");
            $.ajax({
                url: document.URL + "/sort",
                type: "GET",
                data: {
                    sortColumn: sortColumn,
                    sortDirection: sortDirection
                },
                success: function(response) {
                    view.ads = response;
                    sortDirection = sortDirection == "asc" ? "desc" : "asc";
                    element.attr("data-order", sortDirection);
                },
                dataType: "json"
            });
        },
        editName: function(event) {
            const element = $(event.target);
            element.css("display", "none");
            element.next("div").css("display", "initial");
            element.next("div").children("input").focus();
        },
        selectAll: function() {
            let select = false;
            const CB = "[type=checkbox].select";

            for (let i = 0; i < $(CB).length; i++) {
                if (!$(CB + ":eq(" + i + ")").is(":checked")) {
                    select = true;
                    break;
                }
            }
            if (select)
                $(CB).prop("checked", true)
            else
                $(CB).prop("checked", false);
        },
        buttonActive: function() {
            if ($("[type=checkbox].select:checked").length > 0)
                $("#table-controls button").removeAttr("disabled");
            else
                $("#table-controls button").attr("disabled", true);
        }
    },
    computed: {
        type: function() {
            if (this.advert.type == "simple") return "vienkāršs";
            else if (this.advert.type == "markup") return "iezīmēts teksts"
            else if (this.advert.type == "img") return "attēls";
            else if (this.advert.type == "simple_img") return "vienkāršs ar attēlu";
            else return "iezīmēts teksts ar attēlu";
        },
        priority: function() {
            if (this.advert.priority == "low") return "zema";
            else if (this.advert.priority == "medium") return "vidēja";
            else if (this.advert.priority == "high") return "augsta";
            else return "IZŅĒMUMA";
        },
        enabled: function() {
            if (this.advert.enabled == 1) return "Jā";
            return "Nē";
        }
    },
    filters: {
        shorten: function(value) {
            if (value.length > 15)
                value = value.substring(0, 15) + "...";
            return value;
        }
    }
});
