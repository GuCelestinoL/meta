# meta
META - Fórum de jogos

Para instalar o site é bem simples:

1) clone o repositório na sua máquina;
2) dentro da pasta do site, existe uma pasta chamada SQL, dentro dela existe um arquivo chamado meta.sql, suba este arquivo no MySQL 5;
3) coloque o site dentro de um servidor apache com php 5 (se colocar php 7 ou mais recente, não vai rodar, por conta da conexão com o banco de dados que usa mysql e não mysqli);
4) talvez seja necessário habilitar os módulos deflate, expires, headers e rewrite do seu apache;
5) pronto.
