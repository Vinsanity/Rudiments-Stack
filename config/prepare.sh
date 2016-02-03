rm -rf .git
git init
rm -rf wp
git submodule add -b 4.2-branch https://github.com/WordPress/WordPress.git wp
git clone https://bitbucket.org/3five/rudiments.git content/themes/threefive-rudiments
rm -rf content/themes/threefive-rudiments/.git
npm install
gulp
git add -A
git commit -m "Inital commit"
