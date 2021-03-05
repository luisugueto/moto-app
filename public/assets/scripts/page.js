
$(document).ready(function () {

    $(".btn-open-options").click(function () {
        $(".ui-theme-settings").toggleClass("settings-open")
    }), $(".close-sidebar-btn").click(function () {
        var t = $(this).attr("data-class");
        $(".app-container").toggleClass(t);
        var n = $(this);
        n.hasClass("is-active") ? n.removeClass("is-active") : n.addClass("is-active")
    }), $(".switch-container-class").on("click", function () {
        var t = $(this).attr("data-class");
        $(".app-container").toggleClass(t), $(this).parent().find(".switch-container-class").removeClass("active"), $(this).addClass("active")
    }), $(".switch-theme-class").on("click", function () {
        var t = $(this).attr("data-class");
        "body-tabs-line" == t && ($(".app-container").removeClass("body-tabs-shadow"), $(".app-container").addClass(t)), "body-tabs-shadow" == t && ($(".app-container").removeClass("body-tabs-line"), $(".app-container").addClass(t)), $(this).parent().find(".switch-theme-class").removeClass("active"), $(this).addClass("active")
    }), $(".switch-header-cs-class").on("click", function () {
        var t = $(this).attr("data-class");
        $(".switch-header-cs-class").removeClass("active"), $(this).addClass("active"), $(".app-header").attr("class", "app-header"), $(".app-header").addClass("header-shadow " + t)
    }), $(".switch-sidebar-cs-class").on("click", function () {
        var t = $(this).attr("data-class");
        $(".switch-sidebar-cs-class").removeClass("active"), $(this).addClass("active"), $(".app-sidebar").attr("class", "app-sidebar"), $(".app-sidebar").addClass("sidebar-shadow " + t)
    })
    // setTimeout(function()
    // {
    //     $(".vertical-nav-menu").metisMenu()
    // }, 100), 
    $(".search-icon").click(function () {
        $(this).parent().parent().addClass("active")
    }), $(".search-wrapper .close").click(function () {
        $(this).parent().removeClass("active")
    }), $(".dropdown-menu").on("click", function (e) {
        // var t = r.a._data(document, "events") || {
        // };

        // t = t.click || [];
        // for (var n = 0; n < t.length; n++) t[n].selector && ($(e.target).is(t[n].selector) && t[n].handler.call(e.target, e), $(e.target).parents(t[n].selector).each(function()
        // {
        //     t[n].handler.call(this, e)
        // }));
        // e.stopPropagation()
    }), $(function () {
        $('[data-toggle="popover"]').popove$
    }), $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    }), $(".mobile-toggle-nav").click(function () {
        $(this).toggleClass("is-active"), $(".app-container").toggleClass("sidebar-mobile-open")
    }), $(".mobile-toggle-header-nav").click(function () {
        $(this).toggleClass("active"), $(".app-header__content").toggleClass("header-mobile-open")
    }), $(window).on("resize", function () {
        $(this).width() < 1250 ? $(".app-container").addClass("closed-sidebar-mobile closed-sidebar") : $(".app-container").removeClass("closed-sidebar-mobile closed-sidebar")
    })
    $(".vertical-nav-menu li").click(function () {
        if ($("button").hasClass("mobile-toggle-nav is-active")) {
            $('.mobile-toggle-nav.is-active').click();
        }

    });

    $("select").select2();

    setTimeout(function () {
        $(".notification").alert("close");
    }, 6000);

    $('.pag-table').DataTable({
        responsive: true,
        'language': {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});