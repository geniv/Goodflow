<?
print
"    <fieldset>
				<legend>Nastaven� pozdravu</legend>
					<form method=\"POST\" onAction=\"dva.php\">
						<label for=\"pozd\">Tvoje jm�no jm�no:</label>
						<input type=\"text\" id=\"pozd\" name=\"pozdrav\" value=\"V�tej, �lov��e!\">
						<input type=\"submit\" value=\"Nastavit\"	\">
						
						
					</form>
				</fieldset>
";
require "dva.php";

?>