function ControlSubmit(){
  if((document.OrderForm.FirstName.value == "" ||document.OrderForm.LastName.value == "")& document.OrderForm.Firm.value == ""){alert("Vypl�te n�zev firmy nebo jm�no a p��jmen�.");return false}
  if(document.OrderForm.Street.value == ""){alert("Vypl�te ulici.");return false}
  if(document.OrderForm.City.value == ""){alert("Vypl�te m�sto.");return false}
  if(document.OrderForm.ZipCode.value == ""){alert("Vypl�te PS�.");return false}
  if(document.OrderForm.Phone.value == "" & document.OrderForm.Email.value == ""){alert("Vypl�te telefon nebo email.");return false}
  return true
}
