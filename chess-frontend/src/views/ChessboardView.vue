<script setup>
import { TheChessboard } from 'vue3-chessboard'
import 'vue3-chessboard/style.css'
import { ref } from 'vue'
import axios from 'axios'

let boardAPI

const boardConfig = {
  coordinates: true,
  autoCastle: false,
  orientation: 'white'
}

const pgnData = ref('')

function handleMove() {
  const pgn = boardAPI.getPgn()
  pgnData.value = pgn

  axios
    .post('http://127.0.0.1:81/api/chess', { pgn })
    .then((response) => {
      console.log('PGN successfully sent to the API:', response.data)
      // Handle the API response as needed
    })
    .catch((error) => {
      console.error('Error sending PGN to the API:', error)
      // Handle the error as needed
    })
}
</script>

<template class="test">
  <TheChessboard
    :board-config="boardConfig"
    @move="handleMove"
    @board-created="(api) => (boardAPI = api)"
  />
</template>
