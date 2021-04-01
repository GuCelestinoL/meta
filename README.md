# META
META - Fórum de jogos

# Requisitos
MySQL 5.5 ou 5.7
PHP 5.6
Apache 2.4 com os módulos deflate, expires, headers e rewrite

# Instalação
Para instalar o site é bem simples:

1) clone o repositório na sua máquina;
2) dentro da pasta do site, existe uma pasta chamada SQL, dentro dela existe um arquivo chamado meta.sql, suba este arquivo no MySQL;
3) coloque o site dentro da pasta www ou htdocs do apache;
4) pronto.

# Observações
Se usar PHP 7, o site não irá funcionar, pois foi usado mysql e não mysqli e no PHP 7 não existe mais o mysql
