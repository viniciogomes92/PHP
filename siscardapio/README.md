# 🚀 SisCardapio

[![Licença MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Versão PHP](https://img.shields.io/badge/PHP-%3E%3D8.0-777BB4?logo=php)](https://php.net/)
[![Status do Projeto](https://img.shields.io/badge/status-Em%20Desenvolvimento-yellow)](https://github.com/seu-usuario/seu-repositorio)

📝 Com a necessidade de modernizar a cozinha do meu trabalho, criei esse Sistema que cria cardápios e permite avaliá-los.

---

## 🌟 Funcionalidades Principais
- **Gestão de Cardápios** por tipo de refeição (café, almoço, jantar, ceia)
- **Cadastro de Componentes** (pratos principais, guarnições, sobremesas, complementos)
- **Avaliação de Refeições**
- **Relatórios em PDF** (com dompdf e FPDF)
- **Gestão de Usuários** (nutricionistas, agentes fiscais, gestores de municiamento)

## 🛠️ Tecnologias Utilizadas
- PHP >= 8.2
- MySQL >= 10.11
- Bootstrap 5
- SweetAlert2
- FPDF
- DOMPDF
---

## 📥 Instalação

###### Pré-requisitos
- PHP 8.0 ou superior
- Servidor web (Apache/Nginx ou PHP built-in server)
- MySQL/MariaDB
- Composer (para dependências)
- Git

### Passo a Passo

**Clonar o repositório**:
   
   git clone https://github.com/viniciogomes92/PHP.git
   cd PHP


Iniciar servidor:

	Utilizando o XAMPP ou LAMPP, basta iniciar os serviços Apache e MySQL.

Configurar ambiente:

	Edite as credenciais do banco em siscardapio/connect.php e siscardapio/connect_pdo.php.

Importar banco de dados:

	mysql -u root -p siscardapio < Dump20250630/siscardapio_tabela.sql

	Ou utilizar o MySQL Workbench, criar um DB com nome siscardapio e utilizar o Import Wizard para importar as tabelas.

Acessar o sistema:

	http://localhost/siscardapio/index.php  
 	Login: 12345678
  	Senha: 123456789

Acessar no navegador:

	http://localhost/siscardapio

🐛 Solução de Problemas  
	Erro de conexão com o banco: Verifique as credenciais em config/connect.php connect_pdo.

	Página em branco: Habilite erros no PHP (display_errors = On no php.ini).

🤝 Como Contribuir <br>
	Faça um fork do projeto  

	Crie uma branch (git checkout -b feature/nova-feature)

	Commit suas mudanças (git commit -m 'Adiciona nova feature')

	Push para a branch (git push origin feature/nova-feature)

	Abra um Pull Request

📜 Licença: <br>
	Este projeto está sob a licença MIT - veja o arquivo LICENSE para detalhes.
