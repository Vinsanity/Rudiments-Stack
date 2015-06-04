############################################
# Setup Server
############################################

# In order for Capistrano to run this properly you'll need to set up a blank wp site on vagrant using vvv or vv(bradparbs)
# You can also do this manually by ssh-ing into vagrant `vagrant ssh` and creating your directory, host config file, and MySQL database, user and password.
# Once you have completed your WordPress setup on vagrant, uncomment the lines below and enter your credentials.

# set :stage, :vagrant
# set :stage_url, "http://example.dev" # URL to your local dev site. This will most likely be the same as wp_localurl in config/deploy.rb
# server "example.dev", user: "vagrant", roles: %w{web localhost vbdb} # server is the url to your site without the http://. User should always be vagrant since you connect to vagrant via ssh as: ssh vagrant@example.dev enter the vagrant password when prompted unless you've set up a password-less user.
# set :deploy_to, "/srv/www/example/htdocs" # This should be set the vagrant server path for your site (not the local path)

############################################
# Extra Settings
############################################

#specify extra ssh options:

# set :ssh_options, {
#    auth_methods: %w(password),
#    password: 'password', # Uncomment and set this to your vagrant box rot user ssh password. ([default] User: vagrant P: vagrant)
#    user: 'username',
# }

#specify a specific temp dir if user is jailed to home
#set :tmp_dir, "/path/to/custom/tmp"
