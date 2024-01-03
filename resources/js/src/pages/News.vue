<template>
    <div class="news-container">
      <div v-for="item in items" :key="item.id" class="news-item">
        <div class="news-header">
          <div class="news-title">{{ item.title }}</div>
          <div class="news-date">{{ formatDate(item.created_at) }}</div>
        </div>
        <div class="news-content">{{ item.news }}</div>
      </div>
    </div>
  </template>

<script>
import axios from 'axios';
import moment from 'moment';

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
      axios
        .get('/news-data')
        .then((response) => {
          this.items = response.data;
        })
        .catch((error) => {
          console.error('Ошибка при получении данных', error);
        });
    },
    formatDate(dateString) {
      return moment(dateString).format('MMMM D, YYYY');
    },
  },
};
</script>


<style>
  .news-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }

  .news-item {
    margin: 10px;
    padding: 15px;
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    background-color: rgb(220, 220, 220);
    overflow: hidden;
    flex: 1 1 300px;
    transition: transform 0.3s ease-in-out;
  }

  .news-item:hover {
    transform: scale(1.05);
  }

  .news-header {
    margin-bottom: 10px;
  }

  .news-title {
    font-size: 1.8em;
    font-weight: bold;
    font-family: 'Courier New', Courier, monospace;
  }

  .news-date {
    color: #888;
  }

  .news-content {
    line-height: 1.6;
    max-width: 300px;
  }
  </style>
