<template>


</template>


<script lang="ts">
  import axios from 'axios';

export default {
    data() {
      return {
        promocode: [],
        authData: {},
      };
    },

    mounted() {
      this.getPromocodeData();
      this.getAuthUserData();
    },

    methods: {
      async getPromocodeData() {
        try {
          const response = await axios.get('/promocode-data');
          this.promocode = response.data;
        } catch (error) {
          console.error('Ошибка при получении данных', error);
        }
      },

      async getAuthUserData() {
        try {
          const response = await axios.get('/auth-data');
          this.authData = response.data;
        } catch (error) {
          console.error('Ошибка при получении данных', error);
        }
      },

    },
  };
  </script>
