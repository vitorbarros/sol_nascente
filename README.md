Sistema Sol Nascente
=======================

Instalação
------------

Requisitos para instalação
----------------------------

 - PHP 5.6 / 7.0.
 - Ter o composer instalado.
 - MySql
 - Git
 
Instalação
----------------------------

 clone o projeto para a sua máquina.

 `git clone https://github.com/vitorbarros/sol_nascente.git`
 
 Acesse a pasta do projeto e execute o seguinte comando
 
 `composer install`
 
  Após a instalação das dependências acesse a seguinte pasta
  
  `config/autoload`
  
  crie o seguinte arquivo
  
  `doctrine_orm.local.php`
  
  conteúdo do arquivo
  
```php
return array(
     'doctrine' => array(
         'connection' => array(
             'orm_default' => array(
                 'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                 'params' => array(
                     'host' => 'localhost',
                     'port' => '3306',
                     'user' => 'root', //modificar de acordo com sua config
                     'password' => 'root', //modificar de acordo com sua config
                     'dbname' => 'sol_nascente_db', //modificar de acordo com sua config
                 ),
             ),
         ),
     ),
 );
 ```
 
  Accesse seu banco de dados e crie o banco
  de acordo com o nome que colocou na configuração anterior.
  
  Execute o seguinte comando no terminal (tenha certeza que está na pasta do projeto)
  
  `php public/index.php orm:schema-tool:update --force`
  
  Após a execução desse comando execute o seguinte
  
  `php public/index.php data-fixture:import`
  
  Após isso o sistema está pronto para rodar.
  
  Para rodar existem 2 maneiras
  
  1 - Apache 
  
  Caso use o apache será necessário criar um VHost apontando o document root para a pasta public do projeto
   
  ### Apache Setup
  
      <VirtualHost *:80>
          ServerName zf2-tutorial.localhost
          DocumentRoot /path/to/your-application/public
          SetEnv APPLICATION_ENV "development"
          <Directory /path/to/your-application/public>
              DirectoryIndex index.php
              AllowOverride All
              Order allow,deny
              Allow from all
          </Directory>
      </VirtualHost>

  ###
  2 - Servidor do PHP
  
  Essa é a maneira mais simples. Acesse a pasta public do projeto através do seu terminal e execute o seguinte comando
  
  `php -S localhost:8000`


  Accesse o link no seu navegador e pronto.














