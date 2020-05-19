# Laravel/Vue Weather App

> A quick demonstration of a simple weather app built with Laravel/Vue.

![app screenshot](/screenshot.png?raw=true)

This is a barebones weather app that uses Laravel as the backend to interface with OpenWeatherMap's api and then serves that to a (currently rather hideous) Vue frontend.

The app will attempt to get the browser's location and display the current weather. Clicking 'random' will get the current weather at a random latitude/longitude, which may or may not be sufficiently close to a city with a name.


## Setup

Before trying to run this app on localhost, get an api key from [OpenWeatherMap](https://openweathermap.org).

    git clone https://github.com/matthewdcooper/laravel-vue-weather-app.git
    cd laravel-vue-weather-app
    cp .env-example .env
    echo "OWM_KEY={your api key}" >> .env # don't include the braces, just your key
    php artisan serve

The app will be served on localhost:8000.


## API

The api is extremely simple. It fetches current weather data based on latitude and longitude and returns json.

e.g.

    http://localhost:8000/api/weather?lat=51.509865&lon=-0.118092

yields:

    {
        "coord": {
            "lon": -0.12,
            "lat": 51.51
        },
        "weather": [
            {
                "id": 802,
                "main": "Clouds",
                "description": "scattered clouds",
                "icon": "03d"
            }
        ],
        "base": "stations",
        "main": {
            "temp": 295.73,
            "feels_like": 292.83,
            "temp_min": 294.26,
            "temp_max": 297.15,
            "pressure": 1021,
            "humidity": 44
        },
        "visibility": 10000,
        "wind": {
            "speed": 4.1,
            "deg": 280
        },
        "clouds": {
            "all": 50
        },
        "dt": 1589917875,
        "sys": {
            "type": 1,
            "id": 1414,
            "country": "GB",
            "sunrise": 1589860955,
            "sunset": 1589917898
        },
        "timezone": 3600,
        "id": 2643743,
        "name": "London",
        "cod": 200
    }

(Exactly as it would if you made an equivalent api call to OpenWeatherMap)


## Why have an intemediary?

As the app currently functions there isn't really much need for one. A simple Vue client would, in fact, suffice.

However, having a laravel backend provides one current advantage and several potential advatages if this app were to built upon.

1) The api key is hidden from the client.
2) The api could be sealed off using middleware to prevent api calls coming form anything other than the Vue client.
3) Data could be gathered about how the app is used.
4) Weather data could be saved to a database and a history built up.

And so on.


## Further developemt

If I take this app any further beyond mere demonstration purposes, I'd first like to make the ui a lot less ugly. I'd also like to look into providing weather data for multiple locations / days simultaneously.

Although mostly I'd like to replace the call to the OpenWeatherMap api with an api to a procedurally generated climate of a fictional planet.
