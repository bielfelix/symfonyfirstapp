# SymfonyFirstApp

Esse projeto tem o objetivo de explorar as ferramentas que o framework tem a oferecer. Com proposta para fins educativos e de aprendizagem e utilizando as boas práticas e padronizações de desenvolvimento de códigos e diretórios recomendados pela documentação do framework Symfony 5.

## Requisitos
- PHP 7.4.x
- Symfony 5.4.x
- MySQL

## Páginas
- Categoria (Listagem/Cadastrar/Editar/Excluir)
- Produto (Listagem/Cadastrar/Editar/Excluir)
- Usuário (Cadastrar/Login) com nível de acesso

## Módulos Utilizados
- Doctrine
- QueryBuilder
- Annotations
- Security Bundle
- Validator
- IsGranted

## Recursos Utilizados
- FormType
- Bootstrap
- Validação de dados utilizando o Annotations
- Rotas pelo Annotations e também pelo arquivo routes.yaml
- Autenticação/Autorização/Controle de Acesso por Roles

## API
- Exemplo de consumo de API que retorna uma listagem completa dos Produtos cadastrados (Juntamente com os dados do relacionamento entre Produto e Categoria) em formato de Json
- Rota para consumir a API: /api/produtos


## Autor
- **Gabriel Felix**
- LinkedIn: https://www.linkedin.com/in/biel-felix/