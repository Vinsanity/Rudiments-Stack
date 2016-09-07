#!/usr/bin/env bash
echo -e "\033[34m
================================
Creating your new Git repository
================================\033[0m"
rm -rf .git
git init
echo -e "\033[34m
================================
Installing Ruby Dependencies
================================\033[0m"
bundle install
echo -e "\033[34m
================================
Installing Composer Dependencies
================================\033[0m"
composer install
echo -e "\033[34m
=========================================================
Getting you a fresh copy of the Rudiments WordPress theme
=========================================================\033[0m"
git clone https://bitbucket.org/3five/rudiments.git content/themes/threefive-rudiments
rm -rf content/themes/threefive-rudiments/.git
echo -e "\033[34m
====================
Installing NPM Tools
====================\033[0m"
npm install
echo -e "\033[34m
======================================================
Running a Gulp build to start you off on the good foot
======================================================\033[0m"
gulp
echo -e "\033[34m
====================
Tidying up the place
====================\033[0m"
git add -A
git commit -m "Inital commit"
echo -e "\033[34m
========================= \n
Rudiments Setup Complete! \n
=========================\033[0m"
