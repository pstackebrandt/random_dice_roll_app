
@echo off
setlocal

set URL=http://localhost:8000

tasklist /fi "imagename eq msedge.exe" 2>NUL | find /i "msedge.exe" >NUL
if %errorlevel%==0 (
    start "" %URL%
) else (
    start msedge.exe %URL%
)

endlocal
