# Require any additional compass plugins? Uncomment the following line
# require "/Library/Ruby/Gems/1.8/gems/compass-X.XX.X/lib/compass-plugin-name.rb";

# Set this to the root of your project when deployed:
http_path        = "/"

# Set the images directory relative to your http_path or change
# the location of the images themselves using http_images_path:
# http_images_dir = "assets/images"

# Production Assets URL
# http_images_path = "http://your-url-goes-here/img"

# Project Assets Location
css_dir          = "css"
sass_dir         = "scss"
images_dir       = "images"
javascripts_dir  = "js"
fonts_dir 	     = "fonts"

# Output style. Envirionment is defined int he grunt task in Gruntfile.js
output_style = (environment == :production) ? :compressed : :expanded

# Development
#output_style     = :expanded
#environment      = :development

# Production
# output_style = :compressed
# environment = :production