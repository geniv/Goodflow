function ControlSubmit(){
  if((document.OrderForm.FirstName.value == "" ||document.OrderForm.LastName.value == "")& document.OrderForm.Firm.value == ""){alert("Vyplòte název firmy nebo jméno a pøíjmení.");return false}
  if(document.OrderForm.Street.value == ""){alert("Vyplòte ulici.");return false}
  if(document.OrderForm.City.value == ""){alert("Vyplòte mìsto.");return false}
  if(document.OrderForm.ZipCode.value == ""){alert("Vyplòte PSÈ.");return false}
  if(document.OrderForm.Phone.value == "" & document.OrderForm.Email.value == ""){alert("Vyplòte telefon nebo email.");return false}
  return true
}
