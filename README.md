# ![Logo](https://audio-to-text.ndolestudio.com/images/favicon.png) Speech to Text

**Sample PHP/Laravel web app that transcribes an audio file into text using the IBM Watson Speech to Text service.**

### Introduction

[![Maintainability](https://api.codeclimate.com/v1/badges/e553130d8d6ad20ee2fc/maintainability)](https://codeclimate.com/github/NdoleStudio/speech-to-text-php/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/e553130d8d6ad20ee2fc/test_coverage)](https://codeclimate.com/github/NdoleStudio/speech-to-text-php/test_coverage)
[![code style: prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg?style=flat-square)](https://github.com/prettier/prettier)
[![Build Status](https://travis-ci.org/NdoleStudio/speech-to-text-php.svg?branch=master)](https://travis-ci.org/NdoleStudio/speech-to-text-php)

This service service uses IBM's [speech recognition capabilities](https://www.ibm.com/watson/services/speech-to-text) to convert speech in multiple languages into text. The transcription of incoming audio is continuously sent back to the client upon completion. The service is accessed via a REST HTTP interface.

Demo URL: **[https://audio-to-text.ndolestudio.com](https://audio-to-text.ndolestudio.com/)**


### Tech Stack

- The Frontend of the comes with [tailwindcss](https://tailwindcss.com) and [Vue.js](https://vuejs.org/).
- The backend is done with PHP using the [Laravel Framework](https://laravel.com/)
- PHPUnit is used for both unit tests and integration tests. 
  
  *It's advisable to run the tests using docker*
  

## Prerequisites

1. Sign up for an [IBM Cloud account](https://console.bluemix.net/registration/).
1. Create an instance of the Speech to Text service and get your credentials:
    - Go to the [Speech to Text](https://console.bluemix.net/catalog/services/speech-to-text) page in the IBM Cloud Catalog.
    - Log in to your IBM Cloud account.
    - Click **Create**.
    - Click **Show** to view the service credentials.
    - Copy the `apikey` value, or copy the `username` and `password` values if your service instance doesn't provide an `apikey`.
    - Copy the `url` value.
1. Sign up for a [Pusher Aaccount](https://dashboard.pusher.com/accounts/sign_up)
1. Create a new app on pusher and get your credentials:
    - Log in to your Pusher account.
    - Click **Create new app**.
    - Set the name of your app and click on the **Create my app** button
    - Click **App Keys** to view the app credentials.
    - Copy the `app_id`, `key`, `secret` and `cluster` values.

## Configuring the application

1. In the application folder, copy the `.env.example` file and create a file called `.env`

    ```
    cp .env.example .env
    ```

2. Open the `.env` file and add the service credentials that you obtained in the previous step.

    Example `.env` file that configures the `apikey` and `url` for a Speech to Text service instance:

    ```
    SPEECH_TO_TEXT_USERNAME=
    SPEECH_TO_TEXT_PASSWORD=
    SPEECH_TO_TEXT_URL=https://stream.watsonplatform.net/speech-to-text/api/v1/recognize
    ```

3. Open the `.env` file and add the service credentials that you obtained in the previous step.   
   ```
   PUSHER_APP_ID=
   PUSHER_APP_KEY=
   PUSHER_APP_SECRET=
   PUSHER_APP_CLUSTER=
   ```

### Running Locally

Follow the steps below to run this application locally

1. Clone this git repository and `cd` into it

    ```bash
    git clone https://github.com/NdoleStudio/speech-to-text-php.git
    
    cd speech-to-text-php
    ```

2.  Run the docker container

    ```bash
    docker-compose up --build -d
    ```

3.  Open your browser and visit localhost: [http://0.0.0.0:8888](http://0.0.0.0:8888).

### Running Tests

To run tests, setup the application using the setup process shown above and run `phpunit` inside the workspace container


```bash
$ docker exec -it project-workspace /bin/bash
$ phpunit
```

## Built With

* [Guzzle](http://www.dropwizard.io/1.0.2/docs/) - The extensible PHP HTTP client
* [IBM Speech to Text](https://console.bluemix.net/catalog/services/speech-to-text) - IBM's Transcription service
* [Pusher](https://pusher.com) - Powers the real time events

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **[AchoArnold](https://github.com/AchoArnold)**

See also the list of [contributors](https://github.com/NdoleStudio/darksky-php/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details