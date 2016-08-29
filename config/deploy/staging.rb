############################################
# Setup Server
############################################

set :stage, :staging
set :stage_url, "http://www.example.com"
server "XXX.XXX.XX.XXX", user: "SSHUSER", roles: %w{web app db}
set :deploy_to, "/deploy/to/path"

############################################
# Setup WPCLI
# https://github.com/lavmeiker/capistrano-wpcli
############################################

set :wpcli_remote_url, fetch(:stage_url)
set :wpcli_remote_uploads_dir, "#{shared_path.to_s}/content/uploads/"
set :wpcli_backup_db, true

############################################
# Setup Git
############################################

set :branch, "development"

############################################
# Extra Settings
############################################

#specify extra ssh options:

#set :ssh_options, {
#    auth_methods: %w(password),
#    password: 'password',
#    user: 'username',
#}

#specify a specific temp dir if user is jailed to home
#set :tmp_dir, "/path/to/custom/tmp"
