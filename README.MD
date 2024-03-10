# Desafio vaga Dev PHP :: 2024.
Aplicação de cadastro de associados e de anuidades.
# Instalação
 * Clone o projeto com:
```
$ git clone https://github.com/JudsonAlex/Gerenciador-de-Associados.git
```
#### Para este projeto está sendo utilizado o banco relacional SQlite, será necessario instalar uma dependencia do PHP para se conectar.
```
$ sudo apt-get install php-sqlite
```
#### para uma instalação mais precisa, pode instalar a dependencia ndencia específica para a versão de PHP instalada na sua máquina.


- por exemplo:

    para PHP5.x, use: 
    
    ```
    $ sudo apt-get install php5-sqlite
    ```

    Para outras versões do PHP, use o ```sudo apt-get install phpX.Y-sqlite``` depois de **substituir o X.Y** pelo número da sua versão do PHP.


# Executar a aplicação
existe um arquivo dentro de `banco/create_table.php` para criar o banco de dados, suas tabelas e triggers, execute com o comando:

```
$ php banco/create_table.php
```
e dentro da raiz do projeto inicie a aplicação com:
```
$ php -S localhost:3000
```
