rm -rf .git
git init
rm -rf wp
git submodule add -b 4.2-branch https://github.com/WordPress/WordPress.git wp
git remote rm origin
git add -A
git commit -m "Inital commit"
