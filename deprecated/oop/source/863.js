/** Zjištění počtu variant hesla
* @param string
* @return int
*/
function passwordStrength(password) {
	var range = 0;
	if (/[a-z]/.test(password)) {
		range += 26;
	}
	if (/[A-Z]/.test(password)) {
		range += 26;
	}
	if (/[0-9]/.test(password)) {
		range += 10;
	}
	if (/[^a-z0-9]/i.test(password)) {
		range += 32;
	}
	return Math.pow(range, password.length);
}
