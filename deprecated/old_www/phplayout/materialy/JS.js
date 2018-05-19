//alert(document.styleSheets.length);



            for (var i = 0; i < document.styleSheets.length; i++)
            {
              //alert(i);
              //document.styleSheets[0];
              //styl = document.styleSheets[i];
              document.getElementById('pokus').innerHTML += document.styleSheets[i].href+'<br>';
            }
//            document.getElementById('pokus').innerHTML = 'veee';

            //alert(document.styleSheets[0].href);
