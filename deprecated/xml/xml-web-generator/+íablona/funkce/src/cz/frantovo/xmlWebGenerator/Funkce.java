package cz.frantovo.xmlWebGenerator;

import java.io.File;
import java.util.Date;
import java.net.URI;
import java.net.URISyntaxException;

public class Funkce {
        public static Date posledníZměna(String soubor) throws URISyntaxException {
                return new Date(new File(new URI(soubor)).lastModified());
        }
}

