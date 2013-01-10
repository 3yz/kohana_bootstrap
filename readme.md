Kohana bootstrap
================

Instalação 
----------

Primeiro, clone o bootstrap:

    git clone https://github.com/3yz/kohana_bootstrap.git nome_do_projeto

Depois de clonar, você deve iniciar os módulos:

    git submodule update --init

Ele irá instalar os módulos necessários para o funcionamento.

Deployment
----------

**1º passo**

Colocar o arquivo install.php (em anexo) dentro do servidor e acessá-lo para ver se o mesmo tem todos os requisitos necessários para rodar o sistema.

**2º passo**

No fim do arquivo .htaccess (que se encontra na raiz do pacote), deve ser alterado as seguintes variáveis:

- SetEnv KOHANA_ENV PRODUCTION 
- RewriteBase / 

o KOHANA_ENV deve estar em configurado para PRODUCTION e o RewriteBase deve ser configurado com o caminho do site no server. Se por exemplo o site for www.sitedeexemplo.com.br, o Rewrit
eBase deve ser /. Caso for www.sitedeexemplo.com.br/homologacao o RewriteBase deve ser /homologacao/.

**3º passo**

Alterar o arquivo application/bootstrap.php, linha 92, colocar na variável $base_url o mesmo caminho colocado no RewriteBase

**4º passo**

Configurar o banco de dados, colocar os dados para acessar a base no arquivo application/config/activerecord.php

