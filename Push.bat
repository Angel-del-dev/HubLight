@echo off
set/p commit= Quins son els canvis?
git add .
git commit -m "%commit%"
git push origin master
pause
exit