# veículos api 🚗

api desenvolvida em c# com .net + sqlite para cadastro e gerenciamento de veículos.  
permite operações completas via http: criar, listar, editar e excluir.

---

### ❍ funcionalidades

⤷ cadastro de veículos com modelo, marca, preço, cor, placa, chassi e status  
⤷ edição e exclusão de registros  
⤷ listagem de todos os veículos  
⤷ interface web simples com formulário e tabela

---

### ❍ tecnologias usadas

- c# (.net 8)
- sqlite + entity framework core
- minimal apis
- javascript (consumindo a api)
- html + css (interface simples)

---

### ❍ rotas da api

| Método | Rota                 | Ação                       |
|--------|----------------------|----------------------------|
| GET    | `/api/veiculos`      | Listar todos os veículos   |
| GET    | `/api/veiculos/{id}` | Buscar veículo por id      |
| POST   | `/api/veiculos`      | Cadastrar um novo veículo  |
| PUT    | `/api/veiculos/{id}` | Atualizar dados do veículo |
| DELETE | `/api/veiculos/{id}` | Remover veículo por id     |

---

### ❍ observações

🔒 api configurada com cors liberado (`PermitirTudo`)  
📦 persistência local com `veiculos.db` via EF Core  
🖥 contém frontend simples em `/wwwroot`

---

feito como parte da disciplina de back-end, com foco em aprendizado prático.  
refatorado com intenção e atenção aos detalhes 🔭
