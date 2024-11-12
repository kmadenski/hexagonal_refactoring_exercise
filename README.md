# PHP CLI Application with Docker

## Introduction

This project is a **PHP 8.1 CLI application** designed to process input files and perform commission calculations. Docker is used to ensure a consistent environment.

## Prerequisites

- **[Git](https://git-scm.com/downloads)**: For cloning the repository.
- **[Docker](https://www.docker.com/get-started)**: To run the application.
- **[Docker Compose](https://docs.docker.com/compose/install/)**: For managing Docker services.

## Clone the Repository

```bash
git clone git@github.com:kmadenski/hexagonal_refactoring_exercise.git
cd hexagonal_refactoring_exercise
```
# PHP CLI Application with Docker

## Setup Environment Variables

Create a `.env` file in the project root and add your Exchange Rates API token:

```env
EXCHANGERATESAPI_TOKEN=your_api_token_here
```
##Build and Run the Docker Container
###Ensure entrypoint.sh is executable:
```bash
chmod +x entrypoint.sh
```
### Build and run:
```bash
docker-compose up -d --build
```
## Run the Application
Execute the main PHP script with an input file:
```bash
docker-compose exec app php app.php input.txt
```

## Provider Rate Limits
Binlist Provider: Limited to 5 requests per hour. Plan your requests accordingly to avoid exceeding this limit.
## Run Tests
### Execute PHPUnit tests using the following command:
```bash
docker-compose exec app vendor/bin/phpunit tests/CommissionCalculatorSelectorTest.php
```