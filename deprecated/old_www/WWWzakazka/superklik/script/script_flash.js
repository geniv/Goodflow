var objects = document.getElementsByTagName("object");
  function scriptie(hodnota)
  {
    objects[hodnota].outerHTML = objects[hodnota].outerHTML;
  }

  for (var i = 0; i < objects.length; i++)
  {
    window.setTimeout("scriptie(" + i + ")", 1);
  }

