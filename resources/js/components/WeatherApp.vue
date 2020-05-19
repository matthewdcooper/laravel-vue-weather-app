<template>
    <div id="weather">
        <div id="summary">
            <div>
            <h2>London, 26°C</h2>
            <p>broken clouds</p>
            <p>humidity: 62</p>
            </div>
            <img src="http://openweathermap.org/img/wn/04d@2x.png" />
        </div>

        <div id="location">
            <input id="inp_lat" type="text" placeholder="latitude"></input>
            <input id="inp_lon" type="text" placeholder="longitude"></input>
            <button v-on:click="locationFromBrowser">from browser</button>
            <button v-on:click="randomLocation">random</button>
            <button v-on:click="showWeather" id="btn_show">show weather</button>
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
                lon: ""
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
                fetch(`/api/weather?lat=${this.lat}&lon=${this.lon}`).then(r => console.log(r));
            }

        }
    }
</script>
