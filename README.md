# BookStore App - Development Case Study

The BookStore App is a simple application developed with Laravel.

Architecture: https://drive.google.com/file/d/1MF9hVbmX7j1iBes2lJbMIY_MWPaNE2yT/view?usp=sharing

## Requirements

- PHP 8.2
- Composer 2.6
- Docker

## Getting Started

1. Clone the repository.
2. Rename or copy the `bookstore-app/.env-example` to `bookstore-app/.env`.
3. Update the `.env` with the database credentials.
4. Run `php artisan migrate` to run the database migrations.
5. Start the server with `php artisan serve`.
6. Storage link `./vendor/bin/sail artisan storage:link`.

> Seed the fake data by running `php artisan migrate:fresh --seed`.

## Infrastructure

Deployments are configured with a combination of tools and currently only supports adding application server setup. The
current deployment for development only for production the scripts and services deployments need to be refactored.

TODO:

- [ ] Supervisor
- [ ] Meilisearch
- [ ] Horizon

> Terraform provider will ask for the token while performing the operation.

- Terraform - Refer docs: https://developer.hashicorp.com/terraform/docs
- DigitalOcean Access Key. Refer docs: https://registry.terraform.io/providers/digitalocean/digitalocean/latest/docs

Running terraform plan.

```shell
terraform -chdir=./infra/terraform  plan -var-file=terraform.tfvars
```

Running terraform validate.

```shell
terraform -chdir=./infra/terraform validate
```

Running terraform apply.

```shell
terraform -chdir=./infra/terraform apply -auto-approve -var-file=terraform.tfvars
```

Running terraform destroy.

```shell
terraform -chdir=./infra/terraform destroy -auto-approve -var-file=terraform.tfvars
```