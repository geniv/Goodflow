;(function( $, window, document, undefined ) {
    $(document).ready(function() {
        // AutoSize
        $.fn.autosize && $( '.autosize' ).autosize();
        $.fn.iButton && $('.ibutton').iButton();
        // jQuery-UI Tabs
        $.fn.tabs && $(".mws-tabs").tabs();
        // imgAreaSelect
        if( $.fn.imgAreaSelect ) {
            $(".mws-crop-target").imgAreaSelect({
                handles: false,
                resizable: false,
                persistent: true,
                resizeMargin: 0,
                show: true,
                parent: '#mws-crop-parent',
                x1: 0,
                y1: 0,
                x2: 950,
                y2: 370,
                minWidth: 950,
                minHeight: 370,
                onSelectChange: function (img, selection) {
                    $("#crop_x1").val(selection.x1);
                    $("#crop_y1").val(selection.y1);
                    $("#crop_x2").val(selection.x2);
                    $("#crop_y2").val(selection.y2);
                }
            });
        }
        // jQuery-UI Dialog
        if( $.fn.dialog ) {
            $("#mws-jui-dialog").dialog({
                autoOpen: false,
                title: "Náhled",
                modal: true,
                resizable: false,
                width: "auto",
                buttons: [{
                    text: "Zavřít",
                    click: function () {
                        $(this).dialog("close");
                    }
                }]
            });
            $("#mws-jui-dialog-mdl-btn").bind("click", function (event) {
                $("#mws-jui-dialog").dialog("option", {
                    modal: true
                }).dialog("open");
                event.preventDefault();
            });
        }
    });
}) (jQuery, window, document);