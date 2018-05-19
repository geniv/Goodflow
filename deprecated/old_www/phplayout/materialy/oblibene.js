<!-- <![CDATA[
    function AddFavorite(linkObj,addUrl,addTitle)
    {
      if (document.all && !window.opera)
      {
        window.external.AddFavorite(addUrl,addTitle);
        return false;
      }
      else if (window.opera && window.print)
      {
        linkObj.title = addTitle;
        return true;
      }
      else if ((typeof window.sidebar == 'object') && (typeof window.sidebar.addPanel == 'function'))
      {
        if (window.confirm('Přidat oblíbenou stránku jako nový panel?'))
        {
          window.sidebar.addPanel(addTitle,addUrl,'');
          return false;
        }
      }
      window.alert('Po potvrzení stiskněte CTRL-D,\nstránka bude přidána k vašim oblíbeným odkazům.');
      return false;
    }
    //]]> -->