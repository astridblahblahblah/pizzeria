## About

This app allows a pizzaiolo to update the status of the pizza and then notifying the website of this update.

## How it works

Pizzaiolo goes on to the list of pizzas and picks the pizza they want to start making.

Pizzas can be in 3 states at any given time: Prepping, Baking, and Done.
Transition is limited depending on the state:
    Prepping => Baking
    Baking => Done

Once a pizza status is updated, a job is then dispatched to send the updated event to the website
via a webhook. The webhook will have in its payload:
- event e.g. pizza.updated
- pizza ID
- status
- update timestamp

## Assumptions

- For the purpose of this demo, going into the pizza list already assumes the pizzaiolo has already logged in successfully and is authorised to view and update pizzas.
- Pizza model is very simple and only the status can be updated. It can be an abbreviated copy of the original POS that the app maintains locally or the actual pizzas table belonging to the original POS.
- Customer-facing website accepts webhooks and can verify the signatures to facilitate processing of these hooks.
- Job dispatch just logs the details of the hook sent, Horizon was not configured in this demo 

## Installation

```bash
docker-compose up -d
```

### From the app container

```bash
composer install
php artisan key:generate
php artisan migrate //(select yes to production)
npm install
npm run build
```

Create test pizzas:
```bash
php artisan tinker
App\Models\Pizza::factory()->count(20)->create()
```

Head onto http://localhost:8080/pizzas to see the pizza list
