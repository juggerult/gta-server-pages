<template>
    <div id="content" class="character">
      <h1>{{player.nickname}}</h1>
      <h2>Номер аккаунта: {{ $route.params.id }}</h2>
      <div id="character">
        <div class="character-info">
          <p>Сервер: {{ player.server || 'N/A' }}</p>
          <p>Уровень: {{ player && player.level !== undefined ? player.level : 'N/A' }}</p>
          <p>Опыт: {{ player && player.experience !== undefined ? player.experience : 'N/A' }} / {{ player && player.level !== undefined ? player.level * 4 : 'N/A' }}</p>
          <p>Стать: {{ player.gender || 'N/A' }}</p>
          <p>Деньги на руках: {{ player.balance_money || 'N/A' }}</p>
          <p>Деньги в банке: {{ player.balance_bank || 'N/A' }}</p>
          <p>Вип: {{ player?.active_vip !== undefined ? (player.active_vip ? 'Да' : 'Нет') : 'N/A' }}</p>
          <p>Время действия вип до: {{ formatDate(player.time_active_vip) || 'N/A' }}</p>
          <p>Варны: {{ player.active_warns || 'N/A' }}</p>
          <p>Блокировка: {{ player.active_bans || 'N/A' }}</p>
          <p>Дата регистрации аккаунта: {{ formatDate(player.created_at) || 'N/A' }}</p>
        </div>
      </div>
    </div>
  </template>

<script lang="ts">
import axios from 'axios';
import { defineComponent } from 'vue';
import moment from 'moment';

interface PlayerInfo {
  nickname?: string,
  server?: number;
  level?: number;
  experience?: number;
  gender?: string;
  balance_money?: number;
  balance_bank?: number;
  active_vip?: boolean;
  time_active_vip?: string;
  active_warns?: boolean;
  active_bans?: boolean;
  created_at?: string;
}

export default defineComponent({
  data() {
    return {
      player: {} as PlayerInfo,
    };
  },

  mounted() {
    this.fetchPlayerInfo(this.$route.params.id);
  },

  methods: {
    async fetchPlayerInfo(id: string) {
      try {
        const response = await axios.get<PlayerInfo>(`/get-player-info/${id}`);
        this.player = response.data;
      } catch (error) {
        console.error('Ошибка при получении информации об игроке:', error);
      }
    },
    formatDate(dateString) {
      return moment(dateString).format('MMMM D, YYYY');
    },
  },
});
</script>


<style scoped>

#content {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 2px solid #91c5e8;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .funcBtn {
    color: red;
    text-decoration: none;
    transition: color 0.3s ease-in-out;
  }

  .funcBtn:hover {
    color: black;
    cursor: pointer;
  }

  h1,
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

  .delete-button {
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

  input[type="radio"]:checked+label {
    font-weight: bold;
    color: #007BFF;
  }

  label {
    display: inline-block;
    padding: 5px;
  }

</style>

