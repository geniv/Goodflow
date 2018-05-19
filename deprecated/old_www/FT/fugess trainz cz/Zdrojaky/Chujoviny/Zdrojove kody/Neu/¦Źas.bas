screen 9
cls
14
cls
cas$ = TIME$
locate 1,1: PRINT LEFT$(cas$, 2); ":"; MID$(cas$, 4, 2); ":"; RIGHT$(cas$, 2);
for x = 1 to 60000
NEXT x
a$ = inkey$
if a$="q" then end
goto 14