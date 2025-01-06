# Clean Architecture PHP Project

Este repositório tem como objetivo o estudo das bases de **Clean Architecture** utilizando **PHP**, **Composer** e **PHPUnit** para o desenvolvimento e teste de aplicações.

## Objetivo do Projeto

Explorar e praticar os princípios da **Clean Architecture**, incluindo:

- Separar as responsabilidades da aplicação em camadas bem definidas.
- Garantir que regras de negócio sejam independentes de frameworks e da interface do usuário.
- Facilitar a manutenção e expansão do projeto.

Além disso, este projeto também inclui o uso de **Composer** para gestão de dependências e **PHPUnit** para criar e executar testes automatizados.

---

## Estrutura do Projeto

A estrutura do projeto segue os princípios da Clean Architecture:

```
src/
 |-- Domain/         # Regras de negócio e entidades
 |-- Application/    # Casos de uso
 |-- Infrastructure/ # Interação com banco de dados, frameworks, etc.
 |-- Interfaces/     # Camada de interface (Controllers, APIs, etc.)

tests/               # Testes automatizados com PHPUnit
composer.json         # Arquivo de dependências do Composer
```

---

## Requisitos

Antes de iniciar, certifique-se de que você tenha os seguintes softwares instalados:

- **PHP** (versão 8.0 ou superior)
- **Composer** (gestor de dependências do PHP)

### Instalação do Composer

Caso ainda não tenha o Composer instalado, siga as instruções no site oficial: [https://getcomposer.org/](https://getcomposer.org/)

---

## Configuração do Projeto

### Clonando o Repositório

Clone este repositório para sua máquina local:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### Instalando Dependências

Execute o seguinte comando para instalar as dependências:

```bash
composer install
```

---

## Testes

O projeto utiliza o **PHPUnit** para criar e rodar testes automatizados. Para executar os testes, use o comando:

```bash
vendor/bin/phpunit
```

Os arquivos de teste estão localizados na pasta `tests/`. Certifique-se de que todos os novos recursos desenvolvidos estejam devidamente cobertos por testes.

### Configuração do PHPUnit

O arquivo `phpunit.xml` contém as configurações para o PHPUnit. Caso necessário, edite-o para ajustar às necessidades do seu projeto.

---

## Conceitos Estudados

### Clean Architecture
- Camadas de responsabilidade
- Independência de frameworks
- Regras de negócio desacopladas

### Composer
- Gestão de dependências
- Autoloading com PSR-4

### PHPUnit
- Criação de testes unitários e de integração
- Execução de testes e relatórios de cobertura

---