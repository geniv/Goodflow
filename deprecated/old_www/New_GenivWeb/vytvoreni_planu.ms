macros.run "Objects" "plane"
Plane length:20 width:20 pos:[0,0,0] isSelected:on lengthsegs:10 widthsegs:10 mapCoords:on
macros.run "Modifiers" "Wave"
$.modifiers[#Wave].amplitude1 = 2
$.modifiers[#Wave].amplitude2 = 2
$.modifiers[#Wave].wavelength = 25
$.modifiers[#Wave].phase = 0
set animate on
for i=1 to 2 do
(
 sliderTime +=50
 $.modifiers[#Wave].phase = i
)
set animate off