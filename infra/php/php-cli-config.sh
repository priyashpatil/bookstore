#!/bin/bash

# Enable stop on errors and treat unset variables as errors
set -eu

# Define the php.ini file path for FPM
php_ini_file="/etc/php/8.2/cli/php.ini"

# Function to update or add a configuration value
update_or_add_config() {
    local config_key=$1
    local config_value=$2

    if grep -q "$config_key" $php_ini_file; then
        echo "Updating existing configuration: $config_key"
        # If it exists, update the value
        sudo sed -i "s/^$config_key.*/$config_key = $config_value/" $php_ini_file
    else
        echo "Adding new configuration: $config_key"
        # If it doesn't exist, add it to the file
        echo "$config_key = $config_value" | sudo tee -a $php_ini_file > /dev/null
    fi
}

# Declare an associative array for configuration values
declare -A configs
configs=(
    ["memory_limit"]="-1"
)

# Loop over the array and update or add each configuration value
for config_key in "${!configs[@]}"; do
    echo "Processing configuration: $config_key"
    update_or_add_config "$config_key" "${configs[$config_key]}"
done

echo "All configurations processed."
