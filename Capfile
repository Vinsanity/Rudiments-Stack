# Load DSL and Setup Up Stages
require 'capistrano/setup'

# Includes default deployment tasks
require 'capistrano/deploy'

# Use Git as SCM
require 'capistrano/scm/git'
install_plugin Capistrano::SCM::Git

# Include custom strategy for deploying git submodules
require_relative './lib/capistrano/submodule_strategy.rb'
install_plugin GitSubModule

# Includes everything else
require 'yaml'

# Loads custom tasks from `lib/capistrano/tasks' if you have any defined.
Dir.glob('lib/capistrano/tasks/*.cap').each { |r| import r }
