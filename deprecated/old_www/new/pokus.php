<?
print
"    <fieldset>
				<legend>Nastavení pozdravu</legend>
					<form method=\"POST\" onAction=\"dva.php\">
						<label for=\"pozd\">Tvoje jméno jméno:</label>
						<input type=\"text\" id=\"pozd\" name=\"pozdrav\" value=\"Vítej, èlovìèe!\">
						<input type=\"submit\" value=\"Nastavit\"	\">
						
						
					</form>
				</fieldset>
";
require "dva.php";

?>