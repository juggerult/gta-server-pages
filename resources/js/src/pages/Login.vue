<template>
    <div class="registration-page">
      <h1>Вход</h1>
      <span v-if="divError" class="error-div">{{ divError }}</span><br><br>
      <form @submit.prevent="submitForm" method="post">
        <div class="form-group">
          <input type="text" placeholder = 'Логин' v-model="username" required>
        </div>
        <div class="form-group">
          <input type="password" placeholder = 'Пароль' v-model="password" required>
        </div>
        <button type="submit">Войти</button><br>
        <a> <router-link to="/registration">Нет аккаунта ? Регистрируй </router-link></a>
      </form>
    </div>
  </template>



<script lang="ts">

import { defineComponent, ref, onMounted } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

interface UserData {
  username: string;
  password: string;
}

export default defineComponent({
  setup() {
    let username = ref('');
    let password = ref('');
    const divError = ref('');
    const router = useRouter();

    const checkAuth = async () => {
      try {
        const response = await axios.post('/check-login');

        if (response.status === 201) {
          router.push('/private');
        }
      } catch (error) {
        console.error('Error during authentication check:', error);
      }
    };

    // Вызываем функцию checkAuth при монтировании компонента
    onMounted(() => {
      checkAuth();
    });

    const submitForm = async () => {
      try {
        const response = await axios.post('/confirm-login', {
          username: username.value,
          password: password.value,
        });

        if (response.status === 201) {
          router.push('/');
        } else {
          divError.value = response.data.error || 'Не верные данные';
          resetFormFields();
        }
      } catch (error) {
        console.log(error);
        divError.value =
          error.response.data.error ||
          'Произошла ошибка входа, попробуйте через некоторое время';
      }
    };

    const resetFormFields = () => {
      username.value = '';
      password.value = '';
    };

    return {
      username,
      password,
      divError,
      submitForm,
    };
  },
});

</script>


  <style scoped>
  .registration-page {
    width: 50%;
    background-color: rgb(220, 220, 220);
    box-shadow: 3px 5px 9px rgba(0, 0, 0, 0.4);
    border-radius: 45px;
    padding: 20px;
    margin: 50px auto;
    text-align: center;
  }

  form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  button {
    background-color: rgb(182, 32, 32);
    color: white;
    text-align: center;
    margin-left: 10px;
    border: none;
    box-shadow: 3px 5px 9px rgba(0, 0, 0, 0.4);
    padding: 15px;
    font-family: 'Courier New', Courier, monospace;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s;
  }
a{
    font-size: 19px;
    font-family: 'Courier New', Courier, monospace;
    text-decoration: none;
    color: rgb(76, 75, 75);
    font-weight: bold;
}
  .error-div {
    color: rgb(54, 0, 0);
    width: 40%;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 10px;
    margin-top: 10px;
    box-shadow: 3px 5px 9px rgba(0, 0, 0, 0.4);
    border-radius: 30px;
    background-color: rgb(255, 0, 0);
    font-size: 25px;
    font-family: 'Courier New', Courier, monospace;
    font-weight: bold;
  }

  .form-group {
    margin-bottom: 20px;
  }

  h1 {
    font-family: 'Courier New', Courier, monospace;
    color: grey;
    font-weight: bold;
    font-size: 2.2em;
  }

  input {
    padding: 8px;
    width: 100%;
    height: 50px;
    font-family: 'Courier New', Courier, monospace;
    font-size: 30px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 44px;
    box-shadow: 3px 5px 9px rgba(0, 0, 0, 0.4);
    outline: none;
  }

  button:hover {
    background-color: #0056b3;
  }
  </style>
