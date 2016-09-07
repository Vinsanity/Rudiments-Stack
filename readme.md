# Rudiments-Stack

A framework for deploying WordPress projects with Capistrano.

This framework is intended for WordPress projects where you(the developer/designer/agency) need to control the production environment and lock it down. After all, your production site is not just a website, it's an application.

- Automates WordPress deployments via git/github/bitbucket on any number of environments
- Allows for deployments and automation from within Vagrant while outside the virtual box
- Automates database migrations between environments and removes all references to development URLs in production environments (and vice versa)
- Automatically disables WordPress updates, plugin updates, theme updates, and editing WordPress files on remote servers using WP CONSTANTS.
- Synchronizes your WordPress `uploads/` directories between environments
- Automatically prevents non-production environments from being crawled by search engines

## Assumptions
- You are using Vagrant as your local dev environment.
- You have experience using the command line. (Terminal, iTerm, PowerShell, etc) 
- You have experience installing and managing packages with package managers.

## Requirements

For Rudiments Stack (or Capistrano in general) to work you need SSH access both between your local machine and your remote server, and between your local machine and your GitHub or BitBucket account.

Capistrano deploys your application into a symlinked `current/` directory on your server, so you'll need to set your document root to that folder in your nginx or apache .conf file.

- **[Ruby Gems](https://rubygems.org/pages/download)**: Rudiments Stack uses multiple gems so you should make sure this is installed or updated to the latest version first.
- **[Bundler](http://bundler.io/)**: Rudiments Stack uses Bundler to manage capistrano's dependencies.
- **[Composer](https://getcomposer.org/download/)**: Rudiments Stack uses Composer to manage WordPress Core. Required on all stages (local/development, staging, production, etc.) to install WordPress.
- **[WP-CLI](http://wp-cli.org/)**: Rudiments Stack also requires the automation of WordPress management directly in the Command Line. These commands are required on all stages so be sure to install this tool on all stages.
- **[Node.js and npm](https://docs.npmjs.com/getting-started/installing-node)**: Node.js and npm are required to manage theme development dependencies.
- **[Gulp](http://gulpjs.com/)**: Rudiments stack uses Gulp as a theme development task and build manager.
- **[Browsersync](https://www.browsersync.io/)**: Rudiments stack uses Browsersync for asynchronous asset loading (scripts, stylesheets, etc.) during development.

*Why am I installing all this stuff?*

Because it is a "Stack". Also, you're a professional. Your application should be treated the same way.
- - -

## Installation
Here's a step by step guide for setting up a **Rudiments Stack** project.

### Getting started

First, clone the repository. This stack uses command line quite a bit so let's start there.

```sh
cd my/desired/directory
git clone --recursive https://github.com/3five/rudiments-stack.git folder-name
```

That will clone the repository into a folder name of your choosing.

Next, we need to setup the Rudiments Stack project locally. We're using a simple bash script that does most of the leg work for you, so once you've cloned the repo, just run:

```sh
$ bash config/prepare.sh
```
You can trust us or read this list to see what happens when you run that script.
1. We remove the git repo you just cloned and reinitialize it to make it your own. 
2. `bundle install` to install the Ruby gem dependencies.
3. `composer install` to get you WordPress.
4. Grab you a fresh copy of the Rudiments WordPress theme. 
5. `npm install` to install all the build tools for the stack like Gulp and Browsersync.
6. `gulp` to run a quick build of the theme so you have something "nice" to look at.
7. `git commit` to commit your changes to the new git repo. 

Now add your own remote origin repository:

```sh
$ git remote add origin <repo_url>
```

### Configuration

Set your global WP settings under the "WordPress" heading in `config/deploy.rb`. These are the settings used for your initial installation of WordPress.

```ruby
set :wp_user, "3five" # The admin username
set :wp_email, "3five@example.com" # The admin email address
set :wp_sitename, "Rudiments Stack" # The site title
set :wp_localurl, "http://localhost.dev" # Your local environment URL
set :wp_localserver, "localhost.dev" # Your local environment server without the http(s)://
``` 

You also need to define a connection to your new remote git repository in the same file.

```ruby
set :application, "rudiments-stack"
set :repo_url, "git@github.com:3five/rudiments-stack.git"
```

WP-CLI is fully integrated as of v2.3 of Rudiments Stack thanks to the [capistrano-wpcli](https://github.com/lavmeiker/capistrano-wpcli) gem. There are two places to edit settings for the pre-configured tasks. These settings should not need to change from their defaults however, you can change them if for some reason they differ in your environments.

In deploy.rb 
```ruby
set :wpcli_local_url, fetch(:wp_localurl)
set :wpcli_local_uploads_dir, "content/uploads/"
set :wpcli_backup_db, true
set :wpcli_local_db_backup_dir, 'db_backups/'

## Vagrant WPCLI Settings
# THIS MUST BE SET FOR WPCLI TO WORK.
server fetch(:wp_localserver), user: 'vagrant', password: 'vagrant', roles: %w{dev}, no_release: true # Change this only if it differs from :wp_localserver
set :dev_path, "/srv/www/example/htdocs" # Vagrant dev path for WPCLI usage.
```

In deploy/stagename.rb.
```ruby
set :wpcli_remote_url, fetch(:stage_url)
set :wpcli_remote_uploads_dir, "#{shared_path.to_s}/content/uploads/"
set :wpcli_backup_db, true
```

Rudiments Stack starts you with 3 environments: development, staging and production. You need to set up your individual environment settings in `config/deploy/development.rb`, `config/deploy/staging.rb` and `config/deploy/production.rb`:

```ruby
set :stage_url, "http://www.example.com"
server "XXX.XXX.XX.XXX", user: "SSHUSER", roles: %w{web app}
set :deploy_to, "/deploy/to/path"
set :branch, "master"
```
This is where you define your SSH access to the remote server, and the full path which you plan to deploy to. The `stage_url` is used when generating your `wp-config.php` file during installation.

`server` can be an IP address or domain; prefixing with `http://` is not needed either way.

`SSHUSER` should be whichever user owns the directory you've set in  `:deploy_to`. Additional options are found in the stage config files for SSH passwords and other access related options.

You also need to duplicate `database.example.yml` rename it `database.yml` and fill it with the database details for each environment, including your local one. This file should stay ignored in git. The reason you want to duplicate it is so the next person has a starting point for adding DB credentials.

### Usage

#### Setting up environments

**Vagrant or localhost**

To set up WordPress on your local server, run the following command:

```sh
$ bundle exec cap development wp:setup:local
```
**Some notes for Vagrant users.**
- You **must** uncomment the `vagrant_local` variable at the top of deploy/development.rb which sets the vagrant_local variable to true. This will allow all your `cap development` and `wpcli:XXX` commands to occur within the vagrant virtual box (where applicable).
- Please read the instructions in the vagrant.rb file and set your config according to your Vagrant SSH settings

**Remote environments**

To set up WordPress on your remote production server, run the following command:

```sh
$ bundle exec cap production wp:setup:remote
```
or
```sh
$ bundle exec cap staging wp:setup:remote
```

This will install WordPress using the details in your configuration files, and make your first deployment on your production server. Rudiments Stack will generate a random password and give it to you at the end of the task. It is highly recommended that you run `bundle exec cap <stage> wpcli:db:push` to push the local DB to the remote stage.

You can also save time and set up both your remote and local environments with `bundle exec cap production wp:setup:both` if they're both ready. Note that this assigns the same password for both local and the remote environment.

#### Deploying

__ATTENTION__: You **must** add->commit->push your code-base to your remote git repo before proceeding.

You can test this first by using:
```sh
$ bundle exec cap <stage> deploy:check
```

To deploy your code-base to the remote server use:
```sh
$ bundle exec cap <stage> deploy
```
Replace \<stage\> with either `staging` or `production`.


###Capistrano::WPCLI
The capistrano-wpcli gem provides the same commands that Rudiments Stack use to have with the added bonus of using `wpcli:run["command here"]` to run any WP-CLI command on any remote environment.
*Note: This does not work on the development stage at the time of this writing.*


#### Database migrations

__WARNING__: Always use caution when migrating databases on live production environments – This cannot be undone and can cause some pretty serious issues if you're not fully aware of what you're doing.

Migrating databases will also automatically replace development URLs from production databases and vice versa.

To push your local database to the remote environment:

```sh
$ bundle exec cap production wpcli:db:push
```

To pull the remote database into your local environment:

```sh
$ bundle exec cap production wpcli:db:pull
```

To take a backup of the remote database (without importing to your local env database.):

```sh
$ bundle exec cap production wpcli:db:backup
```

That will save an `.sql` file into a local `db_backups/` directory within your project. All `.sql` files are – and should stay – git ignored.

#### Syncing uploads

You can pull and push the WordPress uploads directory in the same way as you can with a database. Pushing from local to an environment or pulling from an environment to local:

```sh
$ bundle exec cap production wpcli:uploads:rsync:pull
$ bundle exec cap production wpcli:uploads:rsync:push
```

### Updating WordPress core

To update WordPress to the latest version you will need to open composer.json and edit the value on the line show below.

```json
"johnpbloch/wordpress": "4.6"
```
Save and then run `composer install` from the root directory. Test your update to see if everything works. 

Commit, Push and Deploy your code.

__CREDITS:__
- Based on a fork of https://github.com/Mixd/wp-deploy from Mixd.
- Theory based on https://github.com/markjaquith/WP-Stack and https://github.com/markjaquith/WordPress-Skeleton