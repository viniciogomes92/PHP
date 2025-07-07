# 🚀 SisCardapio

[![Licença MIT](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Versão PHP](https://img.shields.io/badge/PHP-%3E%3D8.0-777BB4?logo=php)](https://php.net/)
[![Status do Projeto](https://img.shields.io/badge/status-Em%20Desenvolvimento-yellow)](https://github.com/seu-usuario/seu-repositorio)

📝 Com a necessidade de modernizar a cozinha do meu trabalho, criei esse Sistema que cria cardápios e permite avaliá-los.

---

## 🔧 Recursos Principais
- ✅ Cadastro de usuários
- 🔒 Autenticação de usuário
- 📊 Painel administrativo
-  Inclusão de Guarnições
- Criação de cardápios
- Avaliação dos cardápios
- Relatórios de avaliação mensal, que permitem melhorar ou alterar cardápios mal avaliados.

## 🛠️ Tecnologias Utilizadas
- PHP >= 8.2
- MySQL >= 10.11
- Bootstrap 5
- SweetAlert2
- FPDF
- DOMPDF
---

## 📥 Instalação

### Pré-requisitos
- PHP 8.0 ou superior
- Servidor web (Apache/Nginx ou PHP built-in server)
- MySQL/MariaDB
- Git

### Passo a Passo

1. **Clonar o repositório**:
   ```bash
   git clone https://github.com/viniciogomes92/PHP.git
   cd PHP
Configurar ambiente:

Copie o arquivo de configuração:

bash

Edite as credenciais do banco em connect.php e connect_pdo.php.

Importar banco de dados:

bash
mysql -u root -p siscardapio < Dump20250630/siscardapio_tabela.sql

Iniciar servidor:

bash
php -S localhost:8000 -t public/

Acessar no navegador:

text
http://localhost:8000/siscardapio
🗂️ Estrutura de Arquivos
text
siscardapio/
├── public/            # Arquivos acessíveis publicamente
│   ├── index.php      # Ponto de entrada
│   └── assets/        # CSS, JS, imagens
├── src/               # Código fonte
│   ├── Core/          # Classes base
│   ├── Models/        # Modelos de dados
│   └── Controllers/   # Lógica da aplicação
├── config/            # Arquivos de configuração
├── vendor/            # Dependências do Composer
├── .htaccess          # Configurações do Apache
├── composer.json      # Dependências
└── README.md          # Este arquivo
🐛 Solução de Problemas
Erro de conexão com o banco: Verifique as credenciais em config/database.php.

Página em branco: Habilite erros no PHP (display_errors = On no php.ini).

🤝 Como Contribuir
Faça um fork do projeto

Crie uma branch (git checkout -b feature/nova-feature)

Commit suas mudanças (git commit -m 'Adiciona nova feature')

Push para a branch (git push origin feature/nova-feature)

Abra um Pull Request

📜 Licença
Este projeto está sob a licença MIT - veja o arquivo LICENSE para detalhes.

📞 Contato
Seu Nome - @seu_usuario - seu-email@exemplo.com
🔗 Link do Projeto