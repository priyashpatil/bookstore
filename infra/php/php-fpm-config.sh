#!/bin/bash

# Enable stop on errors and treat unset variables as errors
set -eu

# Define the php.ini file path for FPM
php_ini_file="/etc/php/8.2/fpm/php.ini"

# Function to update or add a configuration value
update_or_add_config() {
    local config_key=$1
    local config_value=$2

    echo "Processing configuration key: $config_key"

    if grep -q "$config_key" $php_ini_file; then
        # If it exists, update the value
        echo "Key exists, updating value..."
        sudo sed -i "s/^$config_key.*/$config_key = $config_value/" $php_ini_file
    else
        # If it doesn't exist, add it to the file
        echo "Key does not exist, adding to file..."
        echo "$config_key = $config_value" | sudo tee -a $php_ini_file > /dev/null
    fi

    echo "Done processing $config_key."
}

# Declare an associative array for configuration values
declare -A configs
configs=(
    ["upload_max_filesize"]="10M"
    ["max_file_uploads"]="20"
    ["memory_limit"]="512M"
    ["post_max_size"]="20M"
)

# Loop over the array and update or add each configuration value
for config_key in "${!configs[@]}"; do
    update_or_add_config "$config_key" "${configs[$config_key]}"
done

echo "Restarting PHP FPM..."
sudo systemctl restart php8.2-fpm
echo "PHP FPM restarted successfully."
