<template>
    <div class="tourism-info-container">
        <h1 class="title">Tourism Info</h1>
        <div class="input-group">
            <input
                type="text"
                v-model="city"
                class="input-city"
                placeholder="Enter city"
            />
            <button
                class="btn-fetch"
                @click="fetchData">
                Get Info
            </button>
        </div>

        <div v-if="errorMessage" class="error-message">
            {{ errorMessage }}
        </div>

        <div v-if="weather" class="weather-info">
            <h2 class="section-title">Weather in {{ city }}</h2>
            <ul class="weather-list">
                <li
                    v-for="item in weather.list"
                    :key="item.dt"
                    class="weather-item">
                    {{ item.dt_txt }}: {{ (item.main.temp - 273.15).toFixed(2) }}°C
                </li>
            </ul>
        </div>

        <div v-if="places" class="places-info">
            <h2 class="section-title">Places to Visit in {{ city }}</h2>
            <ul class="places-list">
                <li
                    v-for="place in places"
                    :key="place.fsq_id"
                    class="place-item">
                    {{ place.name }}
                </li>
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
            errorMessage: '',
        };
    },
    methods: {
        async fetchData() {
            try {
                this.errorMessage = '';
                this.weather = null;
                this.places = null;

                // Fetch weather data
                const weatherResponse = await axios.get(`/weather/${this.city}`);
                this.weather = weatherResponse.data;

                // Fetch places data
                const placesResponse = await axios.get(`/places/${this.city}`);
                this.places = placesResponse.data;
            } catch (error) {
                if (error.response && error.response.status === 500) {
                    this.errorMessage = 'City not found. Please enter a valid city name';
                } else if (error.response && error.response.status === 404) {
                    this.errorMessage = 'City not found. Please enter a valid city name.';
                } else {
                    this.errorMessage = 'An error occurred. Please check your input and try again.';
                }

                console.error("Error fetching data", error);
            }
        },
    },
};
</script>


<style scoped>
.tourism-info-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.title {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.input-group {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.input-city {
    width: 70%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 4px 0 0 4px;
    outline: none;
}

.input-city:focus {
    border-color: #007bff;
}

.btn-fetch {
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
}

.btn-fetch:hover {
    background-color: #0056b3;
}

.section-title {
    color: #555;
    margin-bottom: 10px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 5px;
}

.weather-list, .places-list {
    list-style-type: none;
    padding-left: 0;
}

.weather-item, .place-item {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.weather-item:last-child, .place-item:last-child {
    border-bottom: none;
}

.error-message {
    color: red;
    text-align: center;
    margin-bottom: 20px;
}

/* Responsive Design for Mobile Devices */
@media (max-width: 768px) {
    .tourism-info-container {
        padding: 15px;
    }

    .input-group {
        flex-direction: column;
        align-items: stretch;
    }

    .input-city, .btn-fetch {
        width: 100%;
        border-radius: 4px;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .btn-fetch {
        padding: 12px;
        font-size: 14px;
    }

    .section-title {
        font-size: 18px;
        text-align: center;
    }

    .weather-item, .place-item {
        padding: 8px;
        font-size: 14px;
    }
}
</style>
