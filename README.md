# Librarian
Um importador de bibliotecas PHP no estilo [Python Import System](https://docs.python.org/3/reference/import.html).
---

# O que librarian faz?
**librarian** provê uma forma de "inclusão automática" de arquivos PHP com funções (ou qualquer outro código PHP, inclusive classes) de forma seletiva, a exemplo do [Python system import](https://docs.python.org/3/reference/import.html).

Ele aprimora o sistema de *include/require* do PHP possibilitando ao desenvolvedor economia de código evitando uma longa série de *include/require*.

# librariam é igual ao Composer?
Não! Inclusive é recomendado que se utilize **librarian** através do [Composer](https://getcomposer.org/).

# Por que não utilizar o Composer então?
Porque o *Composer* foi construído para fazer o *autoloading* de classes PHP, entre outras coisas. Porém ele não fornece nesse ponto (*autoloading*) uma facilidade maior para quem precisa lidar com muitos *include/require*.

Embora o *Composer* disponibilize a diretiva [files](https://getcomposer.org/doc/04-schema.md#files), para utilizá-la, é preciso configurar manualmente todos os arquivos desejados e esses serão sempre carregados.

Com **librarian** você pode, em cada parte do código ou script, carregar apenas os que será utilizado.

# Requisitos
Os requisitos do **librarian** são:
- PHP 7.1 ou superior
- Composer (se for instalar e utilizar conforme o tópico **Instalação**

# Instalação
O método de instalação recomendado é via *Composer*:

```shell
composer require everton3x/librarian
```

No arquivo *composer.json* coloque a seguinte diretiva de configuração:

```json
{
    "autoload": {
        "files": ["vendor/librarian/src/librarian.php"]
    }
}
```

Depois, atualize o *Composer* com ```composer update```.

Pronto, agora você já tem o **librarian** habilitado nos arquivos PHP que você utiliza ```vendor/autoload.php```.

# Uso:
**librarian** trabalha com dois conceitos básicos: *módulo* e *pacote*.

Um *módulo* corresponde a um arquivo PHP com definições de funções (embora você possa ter qualquer coisa dentro do arquivo, já que **librarian** apensa importa o seu conteúdo através de ```require_once()```).

*pacote* representa um caminho de diretório onde os arquivos *módulos* estão armazenados. É possível utilizar qualquer estrutura de diretório, porém, recomenda-se que se utilize o padrão [PSR-4](https://www.php-fig.org/psr/psr-4/) replicando a estrutura de *namespace* utilizado para as funções em cada módulo.

Tendo em vista que **librarian** é inspirado o *import* do *Python*, ele segue uma lógica semelhante.

Para importar um pacote inteiro, faríamos assim (é claro que existem outras sintaxes possíves):

```python
from mypackage.subpackage import *
```

Com **librarian** fazemos desta forma:

```php
librarian\import()->from('mypackage.subpackage');
```

Onde *mypackage.subpackage* representa uma estrutura de diretório *./mypackage/subpackage/*

Para importar apenas alguns módulos, fazemos assim:

```php
librarian\import('module1', 'module2')->from('mypackage.subpackage');
```

Onde *module1* e *module2* correspondem aos arquivos *./mypackage/subpackage/module1.php* e *./mypackage/subpackage/module2.php*.

Também é possível buscar todos os módulos recursivamente:

```php
librarian\import()->from('mypackage.subpackage.*');
```

Ou todos os módulos *module1* e *module2* recursivamente:

```php
librarian\import('module1', 'module2')->from('mypackage.subpackage.*');
```

# Licença
**librarian** é distribuído sob a licença [MIT](LICENCE.md)

# Como contribuir
Para contribuir com o projeto, siga os seguintes passos:

1. Faça um fork;
2. Crie um branch específico para a sua contribuição;
3. Envie um pull request.

# Changelog
Utilizamos para as releases o [Versionamento Semântico](https://semver.org/lang/pt-BR/) conforme [Tom Preston-Werner](http://tom.preston-werner.com/).

## Versão 0.1.0RC
Versão inicial com a implementação básica.

Nessa versão, os testes foram feitos de forma primitiva e ainda não houve uso em produção, ou seja, tudo pode mudar no futuro.

# Roadmap

## Versão 0.2.0
1. Incluir suporte a caminho base para os pacotes.