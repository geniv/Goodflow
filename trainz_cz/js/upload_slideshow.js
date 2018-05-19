  $(".upload-crop-target").imgAreaSelect({
    parent: '#upload-crop-parent',
    handles: false,
    resizable: false,
    persistent: true,
    resizeMargin: 0,
    show: true,
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