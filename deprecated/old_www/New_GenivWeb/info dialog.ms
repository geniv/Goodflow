rollout dialog0 "Dialog 0." width:245 height:225
(
button button1 "Pochopil jsem" pos:[48,166] width:119 height:35
label labl "Postaví se box a pyramida Autor: by Geniv" pos:[9,10] width:207 height:134

on button1 pressed do
(
DestroyDialog dialog0
CreateDialog dialog1
)

)

rollout dialog1 "Dialog 1." width:245 height:225
(
button button1 "Pochopil jsem" pos:[48,166] width:119 height:35
label labl "Postaví se box" pos:[9,10] width:207 height:134

on button1 pressed do
(
za=box width:100 height:100 length:100 name:"zakl"
za.pos=[0,0,0]
DestroyDialog dialog1
CreateDialog dialog2
)

)

rollout dialog2 "Dialog 2." width:245 height:225
(
button button1 "Pochopil jsem" pos:[48,166] width:119 height:35
label labl "postaví se støecha" pos:[9,10] width:207 height:134

on button1 pressed do
(
st=pyramid width:150 height:50 depth:150 name:"stre"
st.pos=[0,0,100]
DestroyDialog dialog2
 --CreateDialog dialog3
)

)
CreateDialog dialog0