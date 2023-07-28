@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop

if exist C:\NewerXampp\hypersonic\scripts\ctl.bat (start /MIN /B C:\NewerXampp\server\hsql-sample-database\scripts\ctl.bat START)
if exist C:\NewerXampp\ingres\scripts\ctl.bat (start /MIN /B C:\NewerXampp\ingres\scripts\ctl.bat START)
if exist C:\NewerXampp\mysql\scripts\ctl.bat (start /MIN /B C:\NewerXampp\mysql\scripts\ctl.bat START)
if exist C:\NewerXampp\postgresql\scripts\ctl.bat (start /MIN /B C:\NewerXampp\postgresql\scripts\ctl.bat START)
if exist C:\NewerXampp\apache\scripts\ctl.bat (start /MIN /B C:\NewerXampp\apache\scripts\ctl.bat START)
if exist C:\NewerXampp\openoffice\scripts\ctl.bat (start /MIN /B C:\NewerXampp\openoffice\scripts\ctl.bat START)
if exist C:\NewerXampp\apache-tomcat\scripts\ctl.bat (start /MIN /B C:\NewerXampp\apache-tomcat\scripts\ctl.bat START)
if exist C:\NewerXampp\resin\scripts\ctl.bat (start /MIN /B C:\NewerXampp\resin\scripts\ctl.bat START)
if exist C:\NewerXampp\jetty\scripts\ctl.bat (start /MIN /B C:\NewerXampp\jetty\scripts\ctl.bat START)
if exist C:\NewerXampp\subversion\scripts\ctl.bat (start /MIN /B C:\NewerXampp\subversion\scripts\ctl.bat START)
rem RUBY_APPLICATION_START
if exist C:\NewerXampp\lucene\scripts\ctl.bat (start /MIN /B C:\NewerXampp\lucene\scripts\ctl.bat START)
if exist C:\NewerXampp\third_application\scripts\ctl.bat (start /MIN /B C:\NewerXampp\third_application\scripts\ctl.bat START)
goto end

:stop
echo "Stopping services ..."
if exist C:\NewerXampp\third_application\scripts\ctl.bat (start /MIN /B C:\NewerXampp\third_application\scripts\ctl.bat STOP)
if exist C:\NewerXampp\lucene\scripts\ctl.bat (start /MIN /B C:\NewerXampp\lucene\scripts\ctl.bat STOP)
rem RUBY_APPLICATION_STOP
if exist C:\NewerXampp\subversion\scripts\ctl.bat (start /MIN /B C:\NewerXampp\subversion\scripts\ctl.bat STOP)
if exist C:\NewerXampp\jetty\scripts\ctl.bat (start /MIN /B C:\NewerXampp\jetty\scripts\ctl.bat STOP)
if exist C:\NewerXampp\hypersonic\scripts\ctl.bat (start /MIN /B C:\NewerXampp\server\hsql-sample-database\scripts\ctl.bat STOP)
if exist C:\NewerXampp\resin\scripts\ctl.bat (start /MIN /B C:\NewerXampp\resin\scripts\ctl.bat STOP)
if exist C:\NewerXampp\apache-tomcat\scripts\ctl.bat (start /MIN /B /WAIT C:\NewerXampp\apache-tomcat\scripts\ctl.bat STOP)
if exist C:\NewerXampp\openoffice\scripts\ctl.bat (start /MIN /B C:\NewerXampp\openoffice\scripts\ctl.bat STOP)
if exist C:\NewerXampp\apache\scripts\ctl.bat (start /MIN /B C:\NewerXampp\apache\scripts\ctl.bat STOP)
if exist C:\NewerXampp\ingres\scripts\ctl.bat (start /MIN /B C:\NewerXampp\ingres\scripts\ctl.bat STOP)
if exist C:\NewerXampp\mysql\scripts\ctl.bat (start /MIN /B C:\NewerXampp\mysql\scripts\ctl.bat STOP)
if exist C:\NewerXampp\postgresql\scripts\ctl.bat (start /MIN /B C:\NewerXampp\postgresql\scripts\ctl.bat STOP)

:end

