@echo off
title Pearsoft - Sistema de Backup

:inicio
cls
echo Bem vindo ao sistema de backup Pearsoft.
GOTO menu

:menu
echo O que deseja fazer?
echo.
echo 1 - Backup;
echo 2 - Restore;
echo 3 - Sair;
set/p "opcao=>"
IF %opcao% EQU 1 ( GOTO iniciarBkp ) ELSE ( IF %opcao% EQU 2 ( GOTO restore ) ELSE ( IF %opcao% EQU 3 ( GOTO end )))

:iniciarBkp
cls
echo Informe a unidade de disco para o backup:
set/p "un=>"
echo Informe o nome para o backup - (apenas letras e numeros):
set/p "nome=>"
echo Backup Iniciado;
cd D:\xampp\mysql\bin
mysqldump -h localhost -u root --databases sistema > %un%:\%nome%.sql
cls
echo Backup Finalizado - %un%:\%nome%.sql;
echo.
GOTO menu

:restore
cls
echo Informe a unidade de disco onde se encontra o backup:
set/p "un=>"
echo Informe o nome do backup - (apenas letras e numeros):
set/p "nome=>"
echo Restore Iniciado;
IF NOT EXIST %un%:\%nome%.sql ( GOTO erro ) ELSE ( GOTO iniciarRtr)


:iniciarRtr
cd D:\xampp\mysql\bin
mysql mysql -u root --database sistema < %un%:\%nome%.sql
cls
echo Restore Finalizado;
echo.
GOTO menu

:erro
cls
echo Arquivo desconhecido.
GOTO menu

:end
