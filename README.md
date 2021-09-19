## Introduction

A trivial CRUD application for Chefaa - Software Engineer Task.

## Installation

### Prerequisites

* You must have Docker installed.

### Step 1
```bash
git clone https://github.com/ahmedmamdouh886/chefaa.git
cd chefaa
cp .env.example .env
docker-compose up --build
docker-compose exec app composer install
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
``` 

### Step 2
## Endpoint

### Pharmacy Endpoints
* Visit: get http://localhost:8000/api/v1/pharmacies -> To list pharmacies.
* Visit: post http://localhost:8000/api/v1/pharmacies -> To create a new pharmacy.
* Visit: put http://localhost:8000/api/v1/pharmacies/{id} -> To update a pharmacy.
* Visit: delete http://localhost:8000/api/v1/pharmacies/{id} -> To delete a pharmacy.

### Product Endpoints
* Visit: GET http://localhost:8000/api/v1/products -> To list all products.
* Visit: post http://localhost:8000/api/v1/products -> To create a new products.
* Visit: put http://localhost:8000/api/v1/products/{id} -> To update a products.
* Visit: delete http://localhost:8000/api/v1/products/{id} -> To delete a products.

## Software metrics
### Maintability complexity metric
![Alt text](maintainability-complexity.png?raw=true "Maintability complexity metric")
### Maintability without comments complexity metric
![Alt text](maintainability-without-comments-complexity.png?raw=true "Maintability without comments complexity metric")
### Cyclomatic complexity metric (which is conditional statements legs count)
![Alt text](cyclomatic-complexity.png?raw=true "Cyclomatic complexity metric which is conditional statements legs.")
### Average bugs per class metrics
![Alt text](average-bugs.png?raw=true "Average bugs per class metric.")

## Files structure
* app/Http/API/*.php --> It contains the application layer services such as controllers, HTTP request validation layer to validate the request payload, resources layer to format the response.
* app/services/*.php --> It's a layer for handling and isolating the business/application logic.
* app/Models/*.php --> It's an ORM layer to interact with database.
* app/Repositories/*.php --> It's a layer for handling and isolating DB queries.
* app/Support/*.php --> It's for core utilities/third party services.
* app/Support/Payments.php --> it contains mimic payment gateways implementation.
* app/Console/Commands --> it contains Artisan commands implementations to interact with the terminal such as "Get cheapest pharmacies prices.".
* routes/api.php --> It contains the REST API endpoints.
* ./docker-compose.yml --> the docker compose file.
* ./dockerFile --> the docker file.
* ./docker-compose/* --> Contains the docker services configurations such as nginx and volumes implementation such as mysql.
* ./database/migrations --> Contains DB schema.
* ./database/factories --> Contains DB factories to help out loading up some data into DB.
* ./database/seeders --> Contains Seeders files to seed some data into DB.
* ./tests/Feature --> Contains HTTP requests tests to your application and examining the responses.
