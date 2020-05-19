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
            <input type="text" placeholder="longitude"></input>
            <input type="text" placeholder="lattitude"></input>
            <button>from browser</button>
            <button>random</button>
            <button>show weather</button>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
