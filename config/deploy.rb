# config valid only for Capistrano 3.6.1
lock '3.6.1'

############################################
# Setup WordPress
############################################

set :wp_user, "yourname" # The admin username
set :wp_email, "yourname@example.com" # The admin email address
set :wp_sitename, "Rudiments Stack" # The site title
set :wp_localurl, "http://example.dev" # Your local environment URL
set :wp_localserver, "example.dev" # Your local environment server without the http(s)://

############################################
# Setup project
############################################

set :application, "wp-deploy"
set :repo_url, "git@github.com:3five/Rudiments-Stack.git"
set :scm, :git ### This will be depricated in Capistrano v3.7

############################################
# WPCLI Local Settings
############################################

set :wpcli_local_url, fetch(:wp_localurl)
set :wpcli_local_uploads_dir, "content/uploads/"
set :wpcli_backup_db, true
set :wpcli_local_db_backup_dir, 'db_backups/'

## Vagrant WPCLI Settings
# THIS MUST BE SET FOR WPCLI TO WORK.
server fetch(:wp_localserver), user: 'vagrant', password: 'vagrant', roles: %w{dev}, no_release: true # Change this only if it differs from :wp_localserver
set :dev_path, "/srv/www/example/htdocs" # Vagrant dev path for WPCLI usage.

############################################
# Setup Capistrano
############################################

set :log_level, :info
set :use_sudo, false

set :ssh_options, {
  forward_agent: true
}

set :keep_releases, 5

############################################
# Linked files and directories (symlinks)
############################################

set :linked_files, %w{wp-config.php .htaccess}
set :linked_dirs, %w{content/uploads}

namespace :deploy do

  desc "create WordPress files for symlinking"
  task :create_wp_files do
    on roles(:app) do
      execute :touch, "#{shared_path}/wp-config.php"
      execute :touch, "#{shared_path}/.htaccess"
    end
  end

  after 'check:make_linked_dirs', :create_wp_files

  desc "Creates robots.txt for non-production envs"
  task :create_robots do
  	on roles(:app) do
  		if fetch(:stage) != :production then

		    io = StringIO.new('User-agent: *
Disallow: /')
		    upload! io, File.join(release_path, "robots.txt")
        execute :chmod, "644 #{release_path}/robots.txt"
      end
  	end
  end

  after :finished, :create_robots
  after :finishing, "deploy:cleanup"

end
