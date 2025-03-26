# Módulo BookPublishers


### Descrição do Módulo  
O módulo BookPublishers foi desenvolvido para facilitar o gerenciamento de editoras no Magento 2. Ele permite que os administradores adicionem, editem e excluam editoras, incluindo informações como nome, endereço, CNPJ e logo. Além disso, o módulo oferece suporte à funcionalidade de upload de imagens para o logo da editora.

### Funcionalidades
#### - Gerenciamento de Editoras:

Adicione editoras com informações como nome, endereço, CNPJ e status.

Faça upload de logos diretamente pelo formulário de cadastro.

#### - Configuração Dinâmica:

O módulo possui uma configuração no painel administrativo para habilitar ou desabilitar sua funcionalidade.

#### - Instalação via Composer:

O módulo pode ser instalado diretamente via Composer a partir do Packagist, garantindo facilidade na integração com projetos Magento.

#### - Compatibilidade:

Compatível com Magento 2.4.x.

Suporte ao PHP >=8.1.

Passo a Passo da Instalação
1. Instalar o Módulo
Execute o comando abaixo para instalar o módulo via Composer:  
``` composer require bis2bis/module-book-publishers ```
2. Executar os seguintes commandos do Magento:  
``` php bin/magento module:enable Bis2Bis_BookPublishers ```  
``` php bin/magento setup:upgrade ```  
``` php bin/magento setup:di:compile ```  
``` php bin/magento cache:clean ```

4. Verificar Instalação
Caso o modulo esteja habilitado e configurado corretamente vocÊ podera cadastrar editoras e gerenciar suas informações.
Habilite o modulo no caminho:   
``` Stores > Configuração > Bis2Bis > Book Publishers ```
