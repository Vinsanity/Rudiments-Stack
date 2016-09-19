# Load DSL and Setup Up Stages
require 'capistrano/setup'

# Includes default deployment tasks
require 'capistrano/deploy'

# Include custom strategy for deploying git submodules
require 'capistrano/git'

# Include Capistrano's Composer plugin
require 'capistrano/composer'

# Include Capistrano's WP-CLI plugin
require 'capistrano/wpcli'

# Includes everything else
require 'yaml'

# Loads custom tasks from `lib/capistrano/tasks' if you have any defined.
Dir.glob('lib/capistrano/tasks/*.cap').each { |r| import r }
