@echo off
echo Starting XAMPP services...
net start MySQL
net start Apache

echo Opening application...
start http://localhost/mvcpinjambuku/index.php

echo.
echo If the page doesn't open automatically, please ensure:
echo 1. XAMPP is installed correctly
echo 2. MySQL and Apache services are running
echo 3. The project is in the correct directory (c:\xampp\htdocs\mvcpinjambuku)