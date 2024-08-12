<template>
    <div>
        <h1>Tourism Info</h1>
        <input type="text" v-model="city" placeholder="Enter city" />
        <button @click="fetchData">Get Info</button>

        <div v-if="weather">
            <h2>Weather in {{ city }}</h2>
            <ul>
                <li v-for="item in weather.list" :key="item.dt">{{ item.dt_txt }}: {{ item.main.temp }}°C</li>
            </ul>
        </div>

        <div v-if="places">
            <h2>Places to Visit in {{ city }}</h2>
            <ul>
                <li v-for="place in places" :key="place.id">{{ place.name }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            city: '',
            weather: null,
            places: null,
        };
    },
    methods: {
        async fetchData() {
            try {
                const weatherResponse = await axios.get(`/weather/${this.city}`);
                this.weather = weatherResponse.data;

                const placesResponse = await axios.get(`/places/${this.city}`);
                this.places = placesResponse.data;
            } catch (error) {
                console.error("Error fetching data", error);
            }
        },
    },
};
</script>
