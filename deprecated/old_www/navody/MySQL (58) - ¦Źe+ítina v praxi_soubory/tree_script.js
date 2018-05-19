/* javasskripty pro menu v leve liste */

	function showMenu(a, menu_type) {
		b = menu_type + "plus" + a;
		if (document.getElementById(menu_type+a).className == "hide") {

			document.getElementById(b).className = "minus";
			document.getElementById(menu_type+a).className = "show";

		} else {

			document.getElementById(b).className = "plus";
			document.getElementById(menu_type+a).className = "hide";
		}
	}

	all = 0;

	function showAll(menu_type) {


		if (all == 0) {

			document.getElementById(menu_type+"plusAll").className = "minus";

			for (i=1;i<30;i++) {

				b = menu_type + "plus" + i;

				if( (document.getElementById(b) != null)  &&
 				      (document.getElementById(b).className != "odsad") )  {

						document.getElementById(b).className = "minus";
						document.getElementById(menu_type+i).className = "show";

				}
			}

			all = 1;

		} else {

			document.getElementById(menu_type+"plusAll").className = "plus";

			for (i=1;i<30;i++) {

				b = menu_type+"plus" + i;

				if( (document.getElementById(b) != null)  &&
				     (document.getElementById(b).className != "odsad") )  {

					document.getElementById(b).className = "plus";
					document.getElementById(menu_type+i).className = "hide";

				}
			}
		all = 0;
		}

	}
