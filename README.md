# Laravel Starter Project

### Introduction

[![Maintainability](https://api.codeclimate.com/v1/badges/3d71c99c4fd08c124e9e/maintainability)](https://codeclimate.com/github/AchoArnold/laravel-starter-project/maintainability)
<a href="https://codeclimate.com/github/AchoArnold/laravel-starter-project/test_coverage"><img src="https://api.codeclimate.com/v1/badges/3d71c99c4fd08c124e9e/test_coverage" /></a>
[![code style: prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg?style=flat-square)](https://github.com/prettier/prettier)
[![Build Status](https://travis-ci.org/AchoArnold/laravel-starter-project.svg?branch=master)](https://travis-ci.org/AchoArnold/laravel-starter-project)

### Tech Stack

- The Frontend of the comes with tailwindcss, and Vue.js
- PHPUnit is used for both unit tests and integration tests. (PS: It's advisable to run the tests using docker) 


### Local Setup

Follow the steps below to run this application locally

1 - Clone this git repository and `cd` into it

```bash
$ git clone git@bitbucket.org:bePolite/technical-assignment.git
$ cd technical-assignment
```

2 - Copy the `.env.example` file into `.env`

```bash
$ cp .env.example .env
```

3 - Run the docker container

```bash
$ docker-compose up -d
```

4 - Run the bash shell of the workspace docker container

```bash
$ docker exec -it dark-sky-workspace /bin/bash
```

5 - Install `composer` dependencies and `npm` dependencies with `yarn` inside the docker container

```bash
$ composer install
$ yarn
```

6 - Generate the laravel application key

```bash
$ php artisan key:generate
```

8 - Open your browser and visit localhost: [http://localhost:8080](http://localhost:8080).

### Running Tests

To run tests, setup the application using the setup process shown above and run `phpunit` inside the workspace container


```bash
$ docker exec -it dark-sky-workspace /bin/bash
$ phpunit
```