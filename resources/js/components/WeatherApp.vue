<template>
    <div id="weather">
        <div id="summary">
            <div>
            <h2>{{ name }}</h2>
            <p>{{ description }}</p>
            <p>humidity: {{ humidity }}</p>
            </div>
            <img :src="icon_url" />
        </div>

        <div id="location">
            <button v-on:click="locationFromBrowser">from browser</button>
            <button v-on:click="randomLocation">random</button>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            this.locationFromBrowser();
        },

        data: function () {
            return {
                lat: "",
                lon: "",
                name: "",
                temp: "",
                description: "",
                humidity: "",
                icon_url: ""
            }
        },

        methods: {
            
            locationFromBrowser: function () { 
                const vm = this;
                navigator.geolocation.getCurrentPosition(function (pos) {
                    vm.lat = pos.coords.latitude;
                    vm.lon = pos.coords.longitude;
                    vm.showWeather();
                });
                
            },

            randomLocation: function () {
                const vm = this;
                const rand = (min, max) => Math.random() * (max - min) + min;
                vm.lat = rand(-90, 90);
                vm.lon = rand(-180, 180);
                vm.showWeather();
            },

            showWeather: function () {
                const vm = this;
                fetch(`/api/weather?lat=${vm.lat}&lon=${vm.lon}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (!data.name) {
                        vm.name = `${data.coord.lat}, ${data.coord.lon}`;
                    } else {
                        vm.name = `${data.name} (${data.sys.country})`;
                    }
                    vm.description = data.weather[0].description;
                    vm.humidity = data.main.humidity;
                    vm.temp = data.main.temp;
                    vm.icon_url = `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;
                });
            }

        }
    }
</script>
