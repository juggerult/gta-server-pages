<template>
    <div class="main">
      <div class="main-content">
        <div class="left-content">
          <h1>Добро пожаловать в мир nameRP!</h1>
          <p>Отправляйтесь в эпическое приключение в мире nameRP. Готовы ли вы испытать волнение и приключения, как никогда раньше?</p>
          <button @click="startPlaying" class="start-play">Начать игру</button>
        </div>
        <div class="right-content">
          <p>Выбери, кем ты хочешь стать:</p>
          <img class="game-icon" :src="currentImage" alt="Иконка игры">
          <p>{{ currentGamer }}</p>
          <p>
            <button @click="prevImage" class="swap-button">←</button>
            <button @click="nextImage" class="swap-button">→</button>
          </p>
        </div>
      </div>
      <div class="how-start">
      <h1>Как начать игру:</h1>
      <ol>
        <li>
          <span class="step">Шаг 1.</span>
          <span class="main-span">Скачайте лаунчер официального сайта </span><br>
          <button class="download-btn">Скачать</button>
        </li>
        <li>
          <span class="step">Шаг 2.</span>
          <span class="main-span">Установите лаунчер на ваш компьютер.</span><br>
          <span class="info-span">Он установит все компоненты которые нужны для комфортной и безопасной игры на сервере</span>
        </li>
        <li>
          <span class="step">Шаг 3.</span>
          <span class="main-span">Откройте лаунчер и выберите сервер.</span>
        </li>
        <li>
          <span class="step">Шаг 4.</span>
          <span class="main-span">Впишите никнейм и нажмите на кнопку "Войти в игру".</span>
        </li>
      </ol>
    </div>
    </div>
  </template>


  <style scoped>
  .main {
    width: 90%;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    background: none;
    border-radius: 45px;
    padding: 20px;
  }

  .main-content {
    display: flex;
    background-color: rgb(220, 220, 220);
    width: 97%;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.1);
    border-radius: 45px;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 60px;
    padding-bottom: 50px;
    justify-content: space-between;
  }

  .left-content {
    width: 60%;
    margin-top: auto;
    margin-bottom: auto;
  }

  .right-content {
    width: 35%;
    text-align: center;
    font-weight: bolder;
  }

  .game-icon {
    width: 500px;
    height: 300px;
    margin-bottom: 20px;
    border-radius: 25%;
    box-shadow: 0 15px 17px rgba(0, 0, 0, 0.1);
  }

  h1 {
    font-family: 'Courier New', Courier, monospace;
    color:rgb(255, 101, 101);
    font-weight:1000;
    font-size: 2.2em;
  }

  p {
    font-family: 'Arial', sans-serif;
    color:grey;
    font-size: 1.2em;
    margin-bottom: 20px;
  }

.swap-button {
    background-color: silver;
    color: white;
    text-align: center;
    margin-left: 10px;
    border: none;
    padding: 5px 10px;
    font-size: 1.2em;
    cursor: pointer;
    border-radius: 45%;
    transition: background-color 0.3s;
  }

.start-play{
    background-color: rgb(255, 101, 101);
    color: white;
    text-align: center;
    font-weight: bolder;
    font-size: 18px;
    border: none;
    padding: 15px 25px;
    width: 175px;
    cursor: pointer;
}

.download-btn{
    border: none;
    padding: 7px;
    background-color: rgb(179, 179, 167);
    font-weight: bold;
    color: white;
    cursor: pointer;
    font-size: 16px;
    width: 350px;
    height: 30px;
    text-align: center;
}

  button:hover {
    background-color: #45a049;
  }

  .how-start {
    margin-top: 20px;
    text-align:center;
    background-color: rgb(220, 220, 220);
    color: #ecf0f1; /* Цвет текста в блоке */
    padding: 20px;
    border-radius: 45px;
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.1);
  }
.how-start h2 {
  font-size: 1.8em;
  color: #333;
  margin-bottom: 15px;
}

.main-span{
    font-weight: bold;
}
.info-span{
    font-size: 18px;
}

.how-start ol {
  font-size: 1.2em;
  color: #555;
  list-style-type: none;
  margin-left: 20px;
}

.how-start li {
  margin-bottom: 15px;
  list-style-type: none;
  line-height: 1.5;
}

.how-start a {
  color: #007bff;
  text-decoration: none;
}

.how-start a:hover {
  text-decoration: underline;
}

.step {
  font-weight: bold;
  margin-right: 10px;
  color: #aca9a9; /* Цвет шага */
  font-size: 1.2em;
}
  </style>



<script lang="ts">
import { defineComponent, ref } from 'vue';

export default defineComponent({
  setup() {
    const startPlaying = () => {
      window.scroll(0, 500);
    };

    const images = [
      'https://files.libertycity.net/download/gta5_scripts/fulls/2019-01/policemenu-v-2-1-policejjskoe-menju_1686000696_6688.jpg',
      'https://kartinki.pics/uploads/posts/2022-12/thumbs/1670336142_9-kartinkin-net-p-kartinki-gta-oboi-9.jpg',
      'https://3dnews.ru/assets/external/illustrations/2022/03/25/1062787/00.jpg',
      // Добавьте другие ссылки на фотографии по мере необходимости
    ];
    const gamers = [
        'Полицейский',
        'Бандит',
        'Бизнесмен'
    ]
    const currentImageIndex = ref(0);
    const currentGamerIndex = ref(0);

    const currentImage = ref(images[currentImageIndex.value]);
    const currentGamer = ref(gamers[currentGamerIndex.value]);

    const prevImage = () => {
      currentImageIndex.value = (currentImageIndex.value - 1 + images.length) % images.length;
      currentGamerIndex.value = (currentGamerIndex.value - 1 + gamers.length) % gamers.length;

      currentImage.value = images[currentImageIndex.value];
      currentGamer.value = gamers[currentGamerIndex.value];
    };

    const nextImage = () => {
        currentImageIndex.value = (currentImageIndex.value + 1 + images.length) % images.length;
      currentGamerIndex.value = (currentGamerIndex.value + 1 + gamers.length) % gamers.length;

      currentImage.value = images[currentImageIndex.value];
      currentGamer.value = gamers[currentGamerIndex.value];
    };

    return {
      startPlaying,
      currentImage,
      prevImage,
      nextImage,
      currentGamer,
    };
  },
});
</script>
