function cas(){
        var datum = new Date();
        window.status = datum.getHours() + ":" + datum.getMinutes() + ":" + datum.getSeconds();
        
        window.setTimeout("cas();",1000);
}

function cas_test2(){
    if(nastav_cas>999999){
        window.status = "Neomezen� �as na zpracov�n� testu."
    }else{
        window.status = "�as na zpracov�n� testu: " + nastav_cas + " sekund";        
        if(nastav_cas<1){
                alert("Vypr�el nastaven� �asov� limit.");
                TEST.submit();
        }else{
                nastav_cas--;
                window.setTimeout("cas_test2();",1000);
        }
    }        
}

function dnes () {
        var datum = new Date();
        var mesic = datum.getMonth();
        var navratova_hodnota = null;
        var den = null;
        mesic++;
        if(datum.getDay() == 0) {den = "Ned�le"}
        if(datum.getDay() == 1) {den = "Pond�l�"}
        if(datum.getDay() == 2) {den = "�ter�"}
        if(datum.getDay() == 3) {den = "St�eda"}
        if(datum.getDay() == 4) {den = "�tvrtek"}
        if(datum.getDay() == 5) {den = "P�tek"}
        if(datum.getDay() == 6) {den = "Sobota"}
        navratova_hodnota = den + " " + datum.getDate() + "." + mesic + "." + datum.getYear();
        
        cas();

        return(navratova_hodnota);
}

function dnes2 () {
        var datum = new Date();
        var mesic = datum.getMonth();
        var navratova_hodnota = null;
        var den = null;
        mesic++;
        if(datum.getDay() == 0) {den = "Ned�le"}
        if(datum.getDay() == 1) {den = "Pond�l�"}
        if(datum.getDay() == 2) {den = "�ter�"}
        if(datum.getDay() == 3) {den = "St�eda"}
        if(datum.getDay() == 4) {den = "�tvrtek"}
        if(datum.getDay() == 5) {den = "P�tek"}
        if(datum.getDay() == 6) {den = "Sobota"}
        navratova_hodnota = den + " " + datum.getDate() + "." + mesic + "." + datum.getYear();
        
        return(navratova_hodnota);
}

function vymaz(kolikaty){
        location.href="./smazat.php?Vymaz="+kolikaty;
}

function edit(kolikaty){
        location.href="./upravit.php?Edit="+kolikaty;
}

function ukaz(kde){
        window.open( "./obr_test/"+kde, "obrazek_k_otazce","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,copyhistory=no");
}

function prehrej(co){
        window.open( "./zvuk_test/"+co, "zvuk_k_otazce","toolbar=no,location=no,directories=no,status=no,scrollbars=yes,copyhistory=no");        
                
}

function AddBookmark(){
    if(window.external)
      external.AddFavorite(location.href);
    else
      alert("V� prohl�e� nepodporuje tuto funkci.");
}
