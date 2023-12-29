<template>
    <div id="content">
      <h1>Привет, {{ auth.username }}! <a @click="logout">Выйти</a></h1>

      <div id="account-info">
      <label for="info">Для изменения данных, введите новые и нажмите на кнопку</label>
      <label for="info">{{ infoLabelText }}</label><br>
      <label>Email:</label>
      <input v-model="auth.email" id="email" type="email" name="email" form="email">
      <button class="delete-button" @click="editAccountInfoEmail">Изменить</button><br>

      <label>Новый Пароль:</label>
      <input v-model="auth.password" id="password" type="password">
      <button class="delete-button" @click="editAccountInfoPassword">Изменить</button>
    </div>

      <h2><span>Ваш баланс: {{ auth.balance }}</span><a @click="recharge">Пополнить</a></h2>

      <h1>Персонажи</h1>
      <div id="characters">
        <div v-if="characters.length > 0" v-for="character in characters" :key="character.id" class="character">
          <div class="character-info">
            <h3>{{ character.nickname }}</h3>
            <p>Сервер: {{ character.server }}</p>
            <p>Уровень: {{ character.level }}</p>
            <p>Баланс: {{ character.balance_money + character.balance_bank }}</p>
            <p>Вип: {{ character.active_vip }}</p>
            <button class="delete-button" @click="confirmDelete(character.id)">Удалить</button>
          </div>
        </div>
        <div v-for="index in 3 - characters.length" :key="index" class="no-characters">
          <span>+</span>
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
        auth: {},
        showDeleteModal: false,
        selectedCharacterId: null,
        confirmationInput: '',
        infoLabelText: '',
      };
    },

    mounted() {
      this.getPlayersData();
      this.getAuthUserData();
    },

    methods: {
      async getPlayersData() {
        try {
          const response = await axios.get('/players-data');
          this.characters = response.data;
        } catch (error) {
          console.error('Ошибка при получении данных', error);
        }
      },

      async getAuthUserData() {
        try {
          const response = await axios.get('/auth-data');
          this.auth = response.data;
        } catch (error) {
          console.error('Ошибка при получении данных', error);
        }
      },


      async editAccountInfoEmail() {
        try {
            const response = await axios.put('/update-info-email', { email: email.value });
            if (response.status == 201) {
                this.infoLabelText = "Изменения успешно сохранены";
            } else {
                this.infoLabelText = response.data.message;
            }
         } catch (error) {
            console.error("Ошибка", error);
            this.infoLabelText = "Ошибка при сохранении данных";
            location.reload();
         }
        },

      async editAccountInfoPassword() {
        try {
            const response = await axios.put('/update-info-password', { password: password.value });
            if (response.status == 201) {
                this.infoLabelText = "Изменения успешно сохранены";
            } else {
                this.infoLabelText = response.data.message;
            }
        } catch (error) {
            console.error("Ошибка", error);
        }
      },




      logout() {
        // Реализуйте логику выхода
      },

      recharge() {
        // Реализуйте логику пополнения баланса
      },

      confirmDelete(characterId) {
        this.selectedCharacterId = characterId;
        this.showDeleteModal = true;
      },

      closeDeleteModal() {
        this.selectedCharacterId = null;
        this.confirmationInput = '';
        this.showDeleteModal = false;
      },

      deleteCharacter() {
        if (this.confirmationInput.toUpperCase() === 'DELETE') {
          console.log('Удаление персонажа с ID:', this.selectedCharacterId);
          // Вместо console.log добавьте логику удаления через axios
          this.closeDeleteModal();
        } else {
          alert('Неверное подтверждение. Попробуйте еще раз.');
        }
      },
    },
  };
  </script>

  <style scoped>
#content {
  max-width: 1700px;
  margin: 20px auto;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

a {
  color: red;
  text-decoration: none;
  transition: color 0.3s ease-in-out;
}

a:hover {
  color: red;
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
  width: 100%;
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
    width: 100%;
    padding: 8px;
    margin: 10px 0;
  }
  </style>
