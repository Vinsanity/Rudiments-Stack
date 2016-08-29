############################################
# Setup Server
############################################

# In order for Capistrano to run this properly you'll need to set up a blank wp site on vagrant using vvv or vv(bradparbs)
# You can also do this manually by ssh-ing into vagrant `vagrant ssh` and creating your directory, host config file, and MySQL database, user and password.
# To turn this stage off, comment out the lines below or delete this file.

set :vagrant_local, true

set :stage, :development
set :stage_url, fetch(:wp_localurl) # URL to your local dev site. This will most likely be the same as wp_localurl in config/deploy.rb
server fetch(:wp_localserver), user: 'vagrant', password: 'vagrant', roles: %w{dev}
set :deploy_to, fetch(:dev_path) # This should be set the vagrant server path for your site (not the local path)
