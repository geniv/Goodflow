--programming by Geniv
za=box width:100 height:100 length:100 name:"zakl"
za.pos=[0,0,0]


st=pyramid width:150 height:50 depth:150 name:"stre"
st.pos=[0,0,100]
ko=box width:20 height:50 length:20 name:"komi"
ko.pos=[25,25,100]
dv=Plane width:50 height:80 name:"dvere"
rotate dv (angleaxis 90 [0,1,0])
dv.pos=[55,0,28]
select #($zakl, $stre, $komi, $dvere)
macros.run "Modifier Stack" "Convert_to_Poly"
clearSelection()

select $zakl
subobjectLevel = 4
$.EditablePoly.SetSelection #Face #{1..2}
$.EditablePoly.delete 3 deleteIsoVerts:off
subobjectLevel = 0
clearSelection()

select $komi
subobjectLevel = 4
$.EditablePoly.SetSelection #Face #{1}
$.EditablePoly.delete 3 deleteIsoVerts:off
subobjectLevel = 0
clearSelection()
