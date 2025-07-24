@echo off
:loop

echo Retrying all failed jobs...
php artisan queue:retry all

echo Starting Laravel queue worker...
php artisan queue:work
echo Queue worker crashed or stopped. Restarting in 1 seconds...

goto loop