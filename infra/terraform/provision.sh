#!/bin/bash

# Enable stop on errors and treat unset variables as errors
set -eu
DEPLOY_KEY=$1

echo "Running apt-get update..."
sudo apt-get update

# Add Swap
sudo swapon --show
free -h
df -h
sudo fallocate -l 1G /swapfile
sudo chmod 600 /swapfile
ls -lh /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
sudo swapon --show
free -h

echo "Backing up fstab..."
sudo cp /etc/fstab /etc/fstab.bak

echo "Updating fstab and sysctl.conf..."
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
cat /proc/sys/vm/swappiness
sudo sysctl vm.swappiness=10
echo 'vm.swappiness=10' | sudo tee -a /etc/sysctl.conf
cat /proc/sys/vm/vfs_cache_pressure
sudo sysctl vm.vfs_cache_pressure=50
echo 'vm.vfs_cache_pressure=50' | sudo tee -a /etc/sysctl.conf

# Setup PHP
echo "Adding PHP repository..."
sudo DEBIAN_FRONTEND=noninteractive add-apt-repository -y ppa:ondrej/php
sleep 5
sudo apt-get update
sudo apt-get autoremove -y

# PHP 8.2 install
echo "Installing PHP 8.2..."
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y zip unzip php8.2-fpm \
    php8.2-bcmath \
    php8.2-curl \
    php8.2-gd \
    php8.2-gmp \
    php8.2-intl \
    php8.2-mbstring \
    php8.2-mysql \
    php8.2-xml \
    php8.2-zip

echo "Installing Composer..."
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y composer

# Setup Node
echo "Setting up Node..."
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y ca-certificates curl gnupg
sudo mkdir -p /etc/apt/keyrings
curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | sudo gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg

NODE_MAJOR=21
echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" | sudo tee /etc/apt/sources.list.d/nodesource.list

sudo apt-get update

echo "Installing nodejs..."
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y nodejs -y

# Setup MYSQL
echo "Installing MySQL..."
sudo apt-get update
sudo DEBIAN_FRONTEND=noninteractive apt-get install mysql-server -y

echo "Creating database.."
DB_NAME='bookstore'
SQL_QUERY="CREATE DATABASE ${DB_NAME}"
mysql -uroot -e "${SQL_QUERY}"

# User account setup
new_user="bookstore"
ssh_dir="/home/${new_user}/.ssh"
authorized_keys_file="${ssh_dir}/authorized_keys"
known_hosts_file="${ssh_dir}/known_hosts"
id_rsa_file="${ssh_dir}/id_rsa"

echo "Creating new user - ${new_user}..."
sudo useradd -m -s /bin/bash "${new_user}"
echo "$new_user ALL=(ALL) NOPASSWD: ALL" | sudo EDITOR='tee -a' visudo

echo "Setting up SSH for new user..."
sudo mkdir -p "${ssh_dir}"
sudo chown "${new_user}:${new_user}" "${ssh_dir}"
sudo chmod 700 "${ssh_dir}"

sudo cp /root/.ssh/authorized_keys "${authorized_keys_file}"
sudo chown "${new_user}:${new_user}" "${authorized_keys_file}"
sudo chmod 600 "${authorized_keys_file}"

echo "${DEPLOY_KEY}" | base64 --decode > "${id_rsa_file}"
sudo chown "${new_user}:${new_user}" "${id_rsa_file}"
sudo chmod 600 "${id_rsa_file}"

cat <<EOF > "${known_hosts_file}"
github.com ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIOMqqnkVzrm0SdG6UOoqKLsabgH5C9okWi0dh2l9GKJl
github.com ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBEmKSENjQEezOmxkZMy7opKgwFB9nkt5YRrYMjNuG5N87uRgg6CLrbo5wAdT/y6v0mKV0U2w0WZ2YB/++Tpockg=
github.com ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQCj7ndNxQowgcQnjshcLrqPEiiphnt+VTTvDP6mHBL9j1aNUkY4Ue1gvwnGLVlOhGeYrnZaMgRK6+PKCUXaDbC7qtbW8gIkhL7aGCsOr/C56SJMy/BCZfxd1nWzAOxSDPgVsmerOBYfNqltV9/hWCqBywINIR+5dIg6JTJ72pcEpEjcYgXkE2YEFXV1JHnsKgbLWNlhScqb2UmyRkQyytRLtL+38TGxkxCflmO+5Z8CSSNY7GidjMIZ7Q4zMjA2n1nGrlTDkzwDCsw+wqFPGQA179cnfGWOWRVruj16z6XyvxvjJwbz0wQZ75XK5tKSb7FNyeIEs4TT4jk+S4dhPeAUC5y+bDYirYgM4GC7uEnztnZyaVWQ7B381AK4Qdrwt51ZqExKbQpTUNn+EjqoTwvqNj4kqx5QUCI0ThS/YkOxJCXmPUWZbhjpCg56i+2aB6CmK2JGhn57K5mj0MNdBXA4/WnwH6XoPWJzK5Nyu2zB3nAZp+S5hpQs+p1vN1/wsjk=
EOF

sudo chown "${new_user}:${new_user}" "${known_hosts_file}"
sudo chmod 644 "${known_hosts_file}"

# Setup project
echo "Cloning project repository..."
cd "/home/${new_user}"
sudo -u "${new_user}" git clone git@github.com:priyashpatil/bookstore.git
sudo -u "${new_user}" git config --global --add safe.directory /home/bookstore/bookstore
sudo cp /tmp/app-env /home/bookstore/bookstore/bookstore-app/.env
sudo chown "${new_user}:${new_user}" /home/bookstore/bookstore/bookstore-app/.env

# Setup Nginx
echo "Setting up Nginx..."
sudo add-apt-repository -y ppa:ondrej/nginx
sudo apt-get update
sudo apt-get autoremove -y

echo "Installing Nginx..."
sudo DEBIAN_FRONTEND=noninteractive apt-get install -y nginx
sudo cp /tmp/nginx-default.conf /etc/nginx/sites-available/default
sudo cp /tmp/nginx.conf /etc/nginx/nginx.conf
sudo nginx -t

echo "Restart Services"
sudo systemctl restart php8.2-fpm
sudo systemctl restart nginx

# Configure firewall
echo "Configuring firewall"
sudo ufw allow OpenSSH
sudo ufw allow 'Nginx HTTP'
echo y | sudo ufw enable