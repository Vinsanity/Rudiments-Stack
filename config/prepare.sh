rm -rf .git
git init
composer install
git clone https://bitbucket.org/3five/rudiments.git content/themes/threefive-rudiments
rm -rf content/themes/threefive-rudiments/.git
npm install
gulp
git add -A
git commit -m "Inital commit"
