<template>
    <div class="container">
        <li v-for="item in items" :key="item.id">{{ item.title }}</li>
    </div>
  </template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get('/news-data')
        .then(response => {
          this.items = response.data;
          console.log(this.items);
        })
        .catch(error => {
          console.error('Ошибка при получении данных', error);
        });
    },
  },
};
</script>

  <style>
  .container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: rgb(220, 220, 220);
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.5);
    border-radius: 35px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .news-block {
    margin: 10px;
    padding: 15px;
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.5);
    border-radius: 35px;
    background-color: rgb(224, 218, 218);
    overflow: hidden;
    flex: 1 1 300px;
  }

  .news-title {
    font-size: 1.8em;
    font-weight: bold;
    font-family: 'Courier New', Courier, monospace;
    margin-bottom: 10px;
  }

  .news-date {
    color: #888;
    margin-bottom: 10px;
  }

  .news-content {
    line-height: 1.6;
  }
  </style>
