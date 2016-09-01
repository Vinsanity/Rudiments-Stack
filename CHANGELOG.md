# Rudiments Stack Changelog

### 2.3 (8.31.2016)
- Features:
    + Composer replaces git submodule as core WP package manager. 
    + Added capistrano-wpcli and capistrano-composer gems.
    + Updated Capistrano to 3.6.1
    + Updated prepare script to handle more tasks and give better output.
    + Added ESLint support for WP JS code standards.

- Fixes:
    + Fixed wp-config.php.erb template issue with `realpath()` on remote servers when using WP-CLI. Changed to `dirname(__FILE__)`.
    + No more git submodule.