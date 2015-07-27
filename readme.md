# Rudiments-Stack

A framework for deploying WordPress projects with Capistrano.

This framework is intended for WordPress projects where you(the developer/designer/agency) need to control the production environment and lock it down. After all, your production site is not just a website, it's an application. 

- Automates WordPress deployments via git/github/bitbucket on any number of environments
- Allows for deployments and automation from within Vagrant while outside the virtual box
- Automates database migrations between environments and removes all references to development URLs in production environments (and vice versa)
- Automatically disables WordPress updates, plugin updates, theme updates, and editing WordPress files on remote servers using WP CONSTANTS.
- Synchronizes your WordPress `uploads/` directories between environments
- Automatically prevents non-production environments from being crawled by search engines

## Requirements

For Rudiments Stack (or Capistrano in general) to work you need SSH access both between your local machine and your remote server, and between your local machine and your GitHub account.

Capistrano deploys your application into a symlinked `current/` directory on your server, so you'll need to set your document root to that folder.

- **[Ruby Gems](https://rubygems.org/pages/download)**: Rudiments Stack uses multiple gems so you should make sure this is installed or updated to the latest version first.
- **[Bundler](http://bundler.io/)**: Rudiments Stack uses Bundler as a Ruby Dependency manager. 
- **[WP-CLI](http://wp-cli.org/)**: Rudiments Stack also requires the automation of WordPress functions directly in the Command Line. These commands are required on all stages (local, staging, production, etc.) so be sure to install this toll on all stages. 
- **[Node.js and npm](https://docs.npmjs.com/getting-started/installing-node)**: Node.js and npm are required to manage theme development dependancies.
- **[Bower](http://bower.io/)**: Rudiments Stack uses bower as a theme development package manager for your frameworks, libraries, and utilities. 
- **[Grunt](http://gruntjs.com/getting-started)**: Rudiments stack uses Grunt as a theme development task and build manager.

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

That will clone the repository into a folder name of your choosing and it will also download the WordPress submodule.

Next, we need to reinitialize the project as its own repository rather than having it connected to the current origin. We're using a simple bash script that does most of the leg work for you, so once you've cloned the repo, just run:

```sh
$ bash config/prepare.sh
```
Now add your own remote origin repository:

```sh
$ git remote add origin <repo_url>
```

Finally, install the Ruby dependencies for the framework via Bundler:

```sh
$ bundle install
```

### Configuration

Set your global WP settings under the "WordPress" heading in `config/deploy.rb`:

```ruby
set :wp_user, "3five" # The admin username
set :wp_email, "3five@example.com" # The admin email address
set :wp_sitename, "Rudiments Stack" # The site title
set :wp_localurl, "http://localhost.dev" # Your local environment URL
```

These are the settings used for your initial installation of WordPress. You also need to define your git repository in the same file:

```ruby
set :application, "rudiments-stack"
set :repo_url, "git@github.com:3five/rudiments-stack.git"
```

Rudiments Stack starts you with 3 environments: vagrant, staging and production. You need to set up your individual environment settings in `config/deploy/vagrant.rb`, `config/deploy/staging.rb` and `config/deploy/production.rb`:

```ruby
set :stage_url, "http://www.example.com"
server "XXX.XXX.XX.XXX", user: "SSHUSER", roles: %w{web app db}
set :deploy_to, "/deploy/to/path"
set :branch, "master"
```
This is where you define your SSH access to the remote server, and the full path which you plan to deploy to. The `stage_url` is used when generating your `wp-config.php` file during installation.

`server` can be an IP address or domain; prefixing with `http://` is not needed either way. 

`SSHUSER` should be whichever user owns the directory you've set in  `:deploy_to`. Additional options are found in the stage config files for SSH passwords and other access related options.

You also need to duplicate `database.example.yml` rename it `database.yml` and fill it with the database details for each environment, including your local one. This file should stay ignored in git.

#### .wpignore

By default, Capistrano deploys every file within in your repository. To bypass this, Rudiments Stack uses a `.wpignore` file which lists all files and directories you don't want to be deployed, in a similar way to how `.gitginore` prevents files from being checked into your repository.

### Usage

#### Setting up environments

**Vagrant or localhost**

To set up WordPress on your local server, run the following command:

```sh
$ bundle exec cap production wp:setup:local
```
**Some notes for Vagrant users.**
- You **must** uncomment the `vagrant_local` variable at the top of deploy.rb which sets the vagrant_local variable to true. This will allow all your local Capistrano functions to occur within the vagrant virtual box (where applicable).
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

This will install WordPress using the details in your configuration files, and make your first deployment on your production server. Rudiments Stack will generate a random password and give it to you at the end of the task.

You can also save time and set up both your remote and local environments with `bundle exec cap production wp:setup:both` if they're both ready.

#### Deploying

__ATTENTION__: You **must** add->commit->push your code-base to your remote git repo before proceeding.

To deploy your code-base to the remote server:
**Production**:
```sh
$ bundle exec cap production deploy
```
or **Staging**:
```sh
$ bundle exec cap staging deploy
```

That will deploy everything in your repository and submodules, excluding any files and directories in your `.wpignore` file.

#### Database migrations

__WARNING__: Always use caution when migrating databases on live production environments – This cannot be undone and can cause some pretty serious issues if you're not fully aware of what you're doing.

Migrating databases will also automatically replace development URLs from production databases and vice versa.

To push your local database to the remote environment:

```sh
$ bundle exec cap production db:push
```

To pull the remote database into your local environment:

```sh
$ bundle exec cap production db:pull
```

To take a backup of the remote database (without importing to your local env database.):

```sh
$ bundle exec cap production db:backup
```

That will save an `.sql` file into a local `db_backups/` directory within your project. All `.sql` files are – and should stay – git ignored.

#### Syncing uploads

You can pull and push the WordPress uploads directory in the same way as you can with a database. Pushing from local to an environment or pulling from an environment to local:

```sh
$ bundle exec cap production uploads:pull
$ bundle exec cap production uploads:push
```

#### Updating WordPress core

To update the WordPress submodule to the latest version, run:

```sh
$ bundle exec cap production wp:core:update
```
__CREDITS:__ 
- Based on a fork of https://github.com/Mixd/wp-deploy from Mixd.
- Theory based on https://github.com/markjaquith/WP-Stack and https://github.com/markjaquith/WordPress-Skeleton