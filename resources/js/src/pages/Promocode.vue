<template>
    <div class="content">
        <h1>Промокоды – это уникальные коды или комбинации символов, предоставляющие скидки, бонусы или другие преимущества при покупке товаров или услуг. Используя промокоды, игроки могут получить выгодные предложения и сэкономить деньги, делая свои покупки более выгодными и приятными.</h1>
        <div v-if="promocode == true" class="promocode-block">
      <div class="promocode-info">
        <p class="promocode-label">У вас уже есть собственный промокод.</p>
        <p>
          <span class="promocode-label">Промокод:</span>
          <span class="promocode-value">{{ promoData[0].promocode }}</span>
        </p>
        <p>
          <span class="promocode-label">Активен с:</span>
          <span class="promocode-value">{{ formatDate(promoData[0].created_at) }}</span>
        </p>
        <p>
          <span class="promocode-label">Бонусные деньги:</span>
          <span class="promocode-value">{{ promoData[0].money }} $</span>
        </p>
        <p>
          <span class="promocode-label">Количество активации промокода:</span>
          <span class="promocode-value">{{ promoData[0].count_entered_promo }}</span>
        </p><br><br><br>
        <button class="delete-button" @click="deletePromo">Удалить</button>
      </div>
        </div>


      <div v-else>
        <div>
            <h1>У вас нет вашего промокода. Но вы можете зарегистрировать его.</h1>
            <span>Бонусы которые будут наданы при введении: </span><br><span>10000$ на персонажа</span><br><span>VIP на 7 дней</span>
            <div class="registration-form">
                <label>Промокод:</label>
                <input type="text" id="promocode" name="promocode" v-model="promocode" required>

                <button type="submit" class="funcBtn" @click="createPromo">Создать Промокод</button>
            </div>

        </div>
      </div>
    </div>
  </template>

  <script lang="ts">
  import axios from 'axios';
  import moment from 'moment';

  export default {
    data() {
      return {
        promocode: false,
        promoData: {},
        authData: {},
      };
    },

    mounted() {
      this.getPromocodeAvailable();
      this.getAuthUserData();
    },

    methods: {

        formatDate(dateString) {
             return moment(dateString).format('MMMM D, YYYY');
        },

        async getPromocodeAvailable() {
            try {
            const response = await axios.get<boolean>('/promocode-available');
            this.promocode = response.data;

                if (response.data) {
                    await this.getPromocodeData();
                }
            } catch (error) {
                console.error('Ошибка при получении данных', error);
            }
        },

        async getPromocodeData() {
            try {
            const promoDataResponse = await axios.get('/promocode-data');
                this.promoData = promoDataResponse.data;
            } catch (error) {
            console.error('Ошибка при получении данных промокода', error);
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

      async createPromo() {
        try {
            const response = await axios.post('/create-promo', { promocode: this.promocode });
            location.reload();
        } catch (error) {
            console.error('Ошибка при получении данных', error);
        }
      },

      async deletePromo(){
        try{
            const response = await axios.post('/promocode-delete')
            location.reload();
        }catch(error){
            console.error('Ошибка при получении данных', error);
            location.reload();
        }
      },



    },
  };
  </script>


<style scoped>
  div {
    font-family: 'Arial', sans-serif;
    text-align: center;
    margin: 20px;
  }

  h1 {
    color: #1a0000;
    font-size: 24px;
    font-family: 'Courier New', Courier, monospace;
    margin-bottom: 20px;
  }

  .registration-form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 2px solid #91c5e8;
    border-radius: 10px;
  }

.content {
    max-width: 1700px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

  label {
    margin-bottom: 5px;
  }

  input {
    width: 70%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .funcBtn {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .funcBtn:hover {
    background-color: #45a049;
  }

  .no-promocode-block {
    color: #888;
    margin-top: 20px;
  }


  span {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 1px;
    margin-top: 10px;
    background-color: rgb(220, 220, 220);
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.5);
    color: grey;
    transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
    cursor: pointer;
  }

  span:hover {
    background-color: #a5c4d9;
    transform: scale(1.1);
  }

  .promocode-block {
    background-color: #f8f8f8;
    border: 2px solid #91c5e8;
    border-radius: 10px;
    padding: 15px;
    margin-top: 20px;
  }

  .promocode-info {
    font-size: 18px;
    margin-bottom: 10px;
  }

  .promocode-label {
    font-weight: bold;
  }

  .promocode-value {
    color: #241f1f;
    margin-left: 10px;
  }
  .delete-button{
  background-color: #e74c3c;
  color: #fff;
  border: none;
  padding: 8px 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}
.delete-button:hover {
  background-color: #c0392b;
}
.delete-button {
    color: #fff;
}

.delete-button:hover {
    color: #fff;
}
</style>

