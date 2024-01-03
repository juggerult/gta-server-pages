<template>

<main>
        <section class="donate-packages">
            <div class="package">
                <h2>Стартовый пакет 1</h2>
                <p>Описание пакета 1.</p>
                <button>Купить за $10</button>
            </div>

            <div class="package">
                <h2>Стартовый пакет 2</h2>
                <p>Описание пакета 2.</p>
                <button>Купить за $20</button>
            </div>

            <div class="package">
                <h2>Стартовый пакет 3</h2>
                <p>Описание пакета 3.</p>
                <button>Купить за $30</button>
            </div>

            <div class="package">
                <h2>Стартовый пакет 4</h2>
                <p>Описание пакета 3.</p>
                <button>Купить за $30</button>
            </div>

            <div class="package">
                <h2>Стартовый пакет 5</h2>
                <p>Описание пакета 3.</p>
                <button>Купить за $30</button>
            </div>

            <div class="package">
                <h2>Стартовый пакет 6</h2>
                <p>Описание пакета 3.</p>
                <button>Купить за $30</button>
            </div>

            <div class="package">
                <h2>Стартовый пакет 7</h2>
                <p>Описание пакета 3.</p>
                <button>Купить за $30</button>
            </div>

            <div class="package">
                <h2>Стартовый пакет 8</h2>
                <p>Описание пакета 3.</p>
                <button>Купить за $30</button>
            </div>

            <div class="package">
                <h2>Стартовый пакет 77777</h2>
                <p>Описание пакета 3.</p>
                <button>Купить за $30</button>
            </div>
        </section>

        <div class="donation-form">
            <h2>Заполните форму для пополнения</h2>
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Почта:</label>
                <input type="email" id="email" name="email" required>

                <label for="amount">Сумма:</label>
                <input type="number" id="amount" name="amount" required>

                <button type="submit">Пополнить</button>
        </div>
    </main>

</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({

});

</script>

<style scoped>
main {
    display: flex;
    justify-content: space-between;
    width: 1200px;
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

.donation-form {
    max-width: 300px;
    height: 410px;
    margin-left: 90px;
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
