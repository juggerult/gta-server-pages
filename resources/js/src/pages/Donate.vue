<template>
    <main>
      <section class="donate-packages">
        <div class="package">
          <h2>Стартовый пакет Bronze</h2>
          <p>25000 тугриков <br> VIP аккаунт на 14 дней</p>
          <button>Купить за 150</button>
        </div>

        <div class="package">
          <h2>Стартовый пакет Silver</h2>
          <p>55000 тугриков <br> VIP аккаунт на 30 дней</p>
          <button>Купить за 250</button>
        </div>

        <div class="package">
          <h2>Стартовый пакет Gold</h2>
          <p>100000 тугриков <br> VIP аккаунт навсегда</p>
          <button>Купить за 300</button>
        </div>

       </section>

       <div class="pricing-table">
          <h2>Расценки</h2>
          <table>
            <tr>
              <th>Услуга</th>
              <th>Цена в донате</th>
            </tr>
            <tr>
              <td>Смена ника</td>
              <td>50</td>
            </tr>
            <tr>
              <td>Снятие варна</td>
              <td>100</td>
            </tr>
            <tr>
              <td>Вип на неделю</td>
              <td>300</td>
            </tr>
            <tr>
              <td>Вип навсегда</td>
              <td>1000</td>
            </tr>
            <tr>
              <td>Выход из тюрмы</td>
              <td>50</td>
            </tr>
          </table>
          <h3>Донат-паки покупаются в игре</h3>
        </div>

      <div class="donation-form">
        <h2>Заполните форму для пополнения</h2>
        <label for="username">Логин аккаунта:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Почта:</label>
        <input type="email" id="email" name="email" required>

        <label for="amount">Сумма:</label>
        <input type="number" id="amount" name="amount" min="0" required>

        <button type="submit" @click="submitDonationForm">Пополнить</button>
      </div>
    </main>
  </template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  methods: {
    async submitDonationForm() {
      const username = (document.getElementById('username') as HTMLInputElement).value;
      const email = (document.getElementById('email') as HTMLInputElement).value;
      const amount = (document.getElementById('amount') as HTMLInputElement).value;

      const data = {
        username: username,
        email: email,
        sum: amount,
      };

      try {
        const donate = axios.post('/donate-form', {data});
        window.location.href = '/private';
      } catch (error) {
        console.error(error);
      }
    },


  },
});
</script>


<style scoped>
main {
    display: flex;
    width: 1350px;
    margin: 20px auto;
}

.donate-packages {
    flex: 1;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.package {
    margin: 10px;
    padding: 15px;
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    background-color: #f0f0f0;
    overflow: hidden;
    flex: 1 1 calc(33.33% - 20px);
    transition: transform 0.3s ease-in-out;
}

.package:hover {
    transform: scale(1.05);
}

.pricing-table {
    max-width: 300px;
    margin: 10px; /* Изменено с margin-left на margin */
    padding: 15px;
    height: 420px;
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    background-color: #f0f0f0;
    overflow: hidden;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
}

th {
    background-color: #4CAF50;
    color: white;
}

th, td {
    transition: background-color 0.3s ease-in-out;
}

tr:hover {
    background-color: #f5f5f5;
}

.donation-form {
    max-width: 300px;
    height: 410px;
    margin: 10px; /* Изменено с margin-left на margin */
    padding: 20px;
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    background-color: #f0f0f0;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow: hidden;
}

label {
    margin-top: 10px;
    font-weight: bold;
}

input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
</style>

