# Sample API Backend using Laravel

<p align="center">
  <img src="https://laravel.com/assets/img/components/logo-laravel.svg" width="300" alt="Laravel Logo">
</p>

## About the Project

This project is a sample API backend built using Laravel, a PHP framework for web development. It provides a simple and elegant way to create API endpoints.

## Getting Started

To get started with the project, follow these steps:

1.  Clone the repository to your local machine.
2.  Install the dependencies using `composer install`.
3.  Run the migrations using `php artisan migrate`.
4.  Start the development server using `php artisan serve`.
5.  Use a tool such as Postman to test the API endpoints.

## API Endpoints

The API endpoints are as follows:

*   `GET /product?fields=<field1>,<field2>,...`:
    Returns a single random product. The `fields` parameter defines what fields will be returned in the response.
    For example, if you want to get the `name` and `price` fields of a product, you can use the following query:
    `GET /product?fields=name,price`

*   `GET /product?limit=<limit>&search_query=<search_query>&pagination=<page>,<per_page>`:
    Returns a record product depending on the parameter query.
    The `limit` parameter defines the maximum number of records to return.
    The `search_query` parameter defines the search query to use when searching for products.
    The `pagination` parameter defines the page number and the number of records per page.
    For example, if you want to get the records of products on page 1 with 10 records per page, you can use the following query:
    `GET /product?limit=10&search_query=apple&pagination=1,10`

*   `GET /manufacturer?fields=<field1>,<field2>,...`:
    Returns a single random manufacturer. The `fields` parameter defines what fields will be returned in the response.
    For example, if you want to get the `name` and `price` fields of a manufacturer, you can use the following query:
    `GET /manufacturer?fields=name,price`

*   `GET /manufacturer?limit=<limit>&search_query=<search_query>&pagination=<page>,<per_page>`:
    Returns a record manufacturer depending on the parameter query.
    The `limit` parameter defines the maximum number of records to return.
    The `search_query` parameter defines the search query to use when searching for manufacturers.
    The `pagination` parameter defines the page number and the number of records per page.
    For example, if you want to get the records of manufacturers on page 1 with 10 records per page, you can use the following query:
    `GET /manufacturer?limit=10&search_query=apple&pagination=1,10`

*   `GET /fruit?fields=<field1>,<field2>,...`:
    Returns a single random fruit. The `fields` parameter defines what fields will be returned in the response.
    For example, if you want to get the `name` and `price` fields of a fruit, you can use the following query:
    `GET /fruit?fields=name,price`

*   `GET /fruit?limit=<limit>&search_query=<search_query>&pagination=<page>,<per_page>`:
    Returns a record fruit depending on the parameter query.
    The `limit` parameter defines the maximum number of records to return.
    The `search_query` parameter defines the search query to use when searching for fruits.
    The `pagination` parameter defines the page number and the number of records per page.
    For example, if you want to get the records of fruits on page 1 with 10 records per page, you can use the following query:
    `GET /fruit?limit=10&search_query=apple&pagination=1,10`

*   `GET /people?fields=<field1>,<field2>,...`:
    Returns a single random people. The `fields` parameter defines what fields will be returned in the response.
    For example, if you want to get the `name` and `price` fields of a people, you can use the following query:
    `GET /people?fields=name,price`

*   `GET /people?limit=<limit>&search_query=<search_query>&pagination=<page>,<per_page>`:
    Returns a record people depending on the parameter query.
    The `limit` parameter defines the maximum number of records to return.
    The `search_query` parameter defines the search query to use when searching for people.
    The `pagination` parameter defines the page number and the number of records per page.
    For example, if you want to get the records of people on page 1 with 10 records per page, you can use the following query:
    `GET /people?limit=10&search_query=apple&pagination=1,10`

*   `GET /book?fields=<field1>,<field2>,...`:
    Returns a single random book. The `fields` parameter defines what fields will be returned in the response.
    For example, if you want to get the `name` and `price` fields of a book, you can use the following query:
    `GET /book?fields=name,price`

*   `GET /book?limit=<limit>&search_query=<search_query>&pagination=<page>,<per_page>`:
    Returns a record book depending on the parameter query.
    The `limit` parameter defines the maximum number of records to return.
    The `search_query` parameter defines the search query to use when searching for books.
    The `pagination` parameter defines the page number and the number of records per page.
    For example, if you want to get the records of books on page 1 with 10 records per page, you can use the following query:
    `GET /book?limit=10&search_query=apple&pagination=1,10`

