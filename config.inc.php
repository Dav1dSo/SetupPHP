<?php
  // 1ª Etapa - Conexão ao Servidor
  $conexao = mysqli_connect("127.0.0.1","daniel","654321");
  // 2ª Etapa - Selecionar banco de dados
  $bd = mysqli_select_db($conexao, "bd_01");