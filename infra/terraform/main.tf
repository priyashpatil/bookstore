terraform {
  required_providers {
    digitalocean = {
      source  = "digitalocean/digitalocean"
      version = "~> 2.0"
    }
  }
}

variable "do_token" {}
variable "deploy_key" {}

provider "digitalocean" {
  token = var.do_token
}

data "digitalocean_ssh_key" "bookstore_ssh_signature" {
  name = "bookstore-ssh-signature"
}

resource "digitalocean_droplet" "bookstore" {
  image    = "ubuntu-22-04-x64"
  name     = "bookstore"
  region   = "blr1"
  size     = "s-1vcpu-1gb"
  ssh_keys = [data.digitalocean_ssh_key.bookstore_ssh_signature.id]

  connection {
    type        = "ssh"
    user        = "root"
    host        = self.ipv4_address
    private_key = file("~/.ssh/bookstore_id_rsa")
  }

  provisioner "file" {
    source      = "./provision.sh"
    destination = "/tmp/provision.sh"
  }

  provisioner "file" {
    source      = "../nginx/default.conf"
    destination = "/tmp/nginx-default.conf"
  }

  provisioner "file" {
    source      = "../nginx/nginx.conf"
    destination = "/tmp/nginx.conf"
  }

  provisioner "file" {
    source      = "../../deploy.sh"
    destination = "/tmp/deploy.sh"
  }

  provisioner "file" {
    source      = "./.env"
    destination = "/tmp/app-env"
  }

  provisioner "remote-exec" {
    inline = [
      "chmod +x /tmp/provision.sh",
      "/tmp/provision.sh ${var.deploy_key}",
      "chmod +x /tmp/deploy.sh",
      "/tmp/deploy.sh"
    ]
  }
}

output "bookstore_ip" {
  value = digitalocean_droplet.bookstore.ipv4_address
}