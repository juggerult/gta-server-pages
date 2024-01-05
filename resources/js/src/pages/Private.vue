<template>
    <div id="content">
      <label for="info">{{ infoLabelText }}</label><br>
      <h1>Привет, {{ authData.username }}!<a @click="logout" class="funcBtn">Выйти</a></h1>
      У нас появилась новика - <span><router-link to="/promocode" style="text-decoration: none;">Промокоды</router-link></span>

      <div id="account-info">
        <label for="info">Для изменения данных, введите новые и нажмите на кнопку</label>
        <label>Email:</label>
        <input v-model="authData.email" id="email" type="email" name="email" form="email">
        <button class="delete-button" @click="editAccountInfoEmail">Изменить</button><br>

        <label>Новый Пароль:</label>
        <input v-model="authData.password" id="password" type="password">
        <button class="delete-button" @click="editAccountInfoPassword">Изменить</button>
      </div>

      <h2><span>Ваш баланс: {{ authData.balance }}</span><a @click="recharge" class="funcBtn">Пополнить</a></h2>

      <h1>Персонажи</h1>
      <div id="characters">
        <div v-if="characters.length > 0" v-for="character in characters" :key="character.id" class="character" @click="playerPage(character.id)">
          <div class="character-info">
            <h3>{{ character.nickname }}</h3>
            <p>Сервер: {{ character.server }}</p>
            <p>Уровень: {{ character.level }}</p>
            <p>Баланс: {{ character.balance_money + character.balance_bank }}</p>
            <p>Гендер: {{ character.gender }}</p>
            <button class="delete-button" @click="confirmDelete(character.id)">Удалить</button>
          </div>
        </div>
        <div v-for="index in 3 - characters.length" :key="index" class="no-characters" @click="showRegistrationForm = true">
          <span>+</span>
        </div>
      </div>

      <div v-if="showRegistrationForm" class="delete-modal">
        <div class="delete-modal-content">
            <span @click="closeRegisterForm" class="close">&times;</span>
        <h2>Форма регистрации</h2>
        <label for="info">{{ infoLabelText }}</label>
        <input id="nickname" name="nickname" type="text" placeholder="Никнейм" required>
        <input id="promocode" name="promocode" type="text" nullable placeholder="Промокод (не обязательно)">
        <label>Выберите серверер</label>
        <select id="server" name="server">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br><br>
        <div style="display: inline-flex;">
            <input type="radio" name="gender" value="Мужчина">
            <label>Мужчина</label>
            <input type="radio" name="gender" value="Женщина">
            <label>Женщина</label>
        </div><br>
        <button class="delete-button" @click="register">Зарегистрироваться</button>
        </div>
      </div>

      <div v-if="showDeleteModal" class="delete-modal">
        <div class="delete-modal-content">
          <span @click="closeDeleteModal" class="close">&times;</span>
          <label for="confirmationInput">Введите "DELETE" для подтверждения:</label>
          <input v-model="confirmationInput" id="confirmationInput" type="text">
          <button class="delete-button" @click="deleteCharacter">Удалить персонажа</button>
        </div>
      </div>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        characters: [],
        authData: {},
        showDeleteModal: false,
        selectedCharacterId: null,
        confirmationInput: '',
        infoLabelText: '',
        showRegistrationForm: false,
      };
    },

    mounted() {
      this.getPlayersData();
      this.getAuthUserData();
    },

    methods: {
      async getPlayersData() {              // Информация о персонажах пользователя
        try {
          const response = await axios.get('/players-data');
          this.characters = response.data;
        } catch (error) {
          console.error('Ошибка при получении данных', error);
        }
      },

      async getAuthUserData() {           // Информация о пользователе
        try {
          const response = await axios.get('/auth-data');
          this.authData = response.data;
        } catch (error) {
          console.error('Ошибка при получении данных', error);
        }
      },

      async editAccountInfoEmail() {            // Обновление данных пользователя
        try {
          const response = await axios.put('/update-info-email', { email: email.value });
          if (response.status === 201) {
            this.infoLabelText = "Изменения успешно сохранены";
          } else {
            this.infoLabelText = response.data.message;
          }
        } catch (error) {
          console.error("Ошибка", error);
          this.infoLabelText = "Ошибка при сохранении данных";
        }
      },

      async editAccountInfoPassword() {           // Обновление данных пользователя
        try {
          const response = await axios.put('/update-info-password', { password: password.value });
          if (response.status === 201) {
            this.infoLabelText = "Изменения успешно сохранены";
          } else {
            this.infoLabelText = response.data.message;
          }
        } catch (error) {
          console.error("Ошибка", error);
        }
      },

      logout() {
        window.location.href = '/logout';
      },

      recharge() {
        window.location.href = '/donate';
      },

      confirmDelete(characterId) {
        this.selectedCharacterId = characterId;
        this.showDeleteModal = true;
      },

      closeDeleteModal() {
        this.confirmationInput = '';
        this.showDeleteModal = false;
      },

      closeRegisterForm(){
        this.showRegistrationForm = false;
      },


      deleteCharacter() {
        if (this.confirmationInput.toUpperCase() === 'DELETE') {
          const deletePlayer = axios.post('/player-delete', {accountId: this.selectedCharacterId});
          this.closeDeleteModal();
          location.reload();
        } else {
          alert('Неверное подтверждение. Попробуйте еще раз.');
        }
      },

      async register() {
            var nickname = document.getElementById('nickname').value;
            var promocode = document.getElementById('promocode').value || "serverPromo";
            var server = document.getElementById('server').value;
            var genderInput = document.querySelector('input[name="gender"]:checked');

        if (!genderInput) {
            this.infoLabelText = "Выберите пол";
            return;
        }

        var gender = genderInput.value;

        try {
            // Проверка доступности никнейма
            const checkNickname = await axios.post('/check-nickname', { nickname: nickname });

            if (!checkNickname.data.available) {
                this.infoLabelText = "Такой никнейм уже занят";
                return;
            }

            // Проверка доступности промокода
            if (promocode !== null) {
                const checkPromo = await axios.post('/check-promo', { promocode: promocode });

                if (!checkPromo.data.available) {
                    this.infoLabelText = "Нет такого промокода";
                    return;
                }
            }

            // Регистрация игрока
            const register = await axios.post('/players-registration', {
                nickname: nickname,
                promocode: promocode,
                server: server,
                gender: gender
            });

            // Обновление страницы после успешной регистрации
            location.reload();
        } catch (error) {
            console.error('Ошибка', error);
            this.infoLabelText = "Ошибка, попробуйте через некоторое время";

        }
       },



        async playerPage(characterId){
            this.$router.push({ path: `/player/${characterId}` });
        }
    },
  };
  </script>



  <style scoped>

.registration-form {
  max-width: 400px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  border: 2px solid #91c5e8;
  border-radius: 10px
}

#content {
  max-width: 1700px;
  margin: 20px auto;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.funcBtn{
  color: red;
  text-decoration: none;
  transition: color 0.3s ease-in-out;
}

a:hover {
  color: red;
}

a:hover {
  color: black;
  cursor: pointer;
}

h1 {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

h2 {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
}


#characters {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  margin-top: 20px;
  cursor: pointer;
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

#account-info {
  margin-top: 20px;
  width: 50%;
  background-color: #fff;
  padding: 20px;
  border: 2px solid #91c5e8;
  border-radius: 10px;
  box-shadow: 0 6px 9px rgba(0, 0, 0, 0.2);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

#account-info label {
  margin-bottom: 5px;
}

#account-info input {
  width: 30%;
  padding: 8px;
  margin-bottom: 10px;
}
.character {
  width: 90%;
  padding: 20px;
  background-color: #fff;
  border: 2px solid #91c5e8;
  border-radius: 10px;
  box-shadow: 0 6px 9px rgba(0, 0, 0, 0.2);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.character-info {
  margin-top: 10px;
}

.no-characters {
  margin: auto;
  align-items: center;
  padding: 50px;
  background-color: #fff;
  border: 2px solid #91c5e8;
  border-radius: 50%;
  width: 250px;
  height: 250px;
  cursor: pointer;
  box-shadow: 0 6px 9px rgba(0, 0, 0, 0.2);
  display: flex;
  justify-content: center;
  font-size: 100px;
  animation: pulse 1s infinite alternate;
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.1);
  }
}

  .delete-modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
  }

  .delete-modal-content {
    background-color: #fefefe;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: center;
  }

  .delete-modal-content .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
  }

  .delete-modal-content label {
    display: block;
    margin: 10px 0;
  }

  .delete-modal-content input {
    width: 90%;
    padding: 8px;
    margin: 10px 0;
  }

  select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #fff;
  cursor: pointer;
}

select:hover {
  border-color: #999;
}

select:focus {
  outline: none;
  border-color: #555;
}


select option:checked {
  background-color: #e0e0e0;
}

input[type="radio"] {
  margin-right: 5px;
  padding: 10px;
}

input[type="radio"]:hover {
  cursor: pointer;
}

input[type="radio"]:checked + label {
  font-weight: bold;
  color: #007BFF;
}

label {
  display: inline-block;
  padding: 5px;
}
  </style>
