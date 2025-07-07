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

Acessar no navegador:

	http://localhost/siscardapio

🗂️ Estrutura de Arquivos <br>
<br>
siscardapio/ <br>
├── assets/            &nbsp// Imagens e Ícones <br>
├── css/               &nbsp// Folhas de estilo <br>
├── dompdf/           &nbsp// Biblioteca para gerar PDFs <br>
├── fpdf/              &nbsp// Geração de relatórios em PDF <br>
├── js/                &nbsp// JavaScript <br>
├── password_compat/   &nbsp// Compatibilidade de senhas <br>
├── sweetalert2/       &nbsp// Alertas estilizados <br>
├── acoes_acompanhamentos.php		// Controllers para operações CRUD de acompanhamentos <br>
├── acoes_agentes_fiscais.php		// Controllers para operações CRUD de agentes fiscais <br>
├── acoes_avaliacoes.php		// Controllers para operações CRUD de avaliações <br>
├── acoes_cafes.php			// Controllers para operações CRUD de cafés <br>
├── acoes_cardapios_almoco.php		// Controllers para operações CRUD de Cardápios de Almoço <br>
├── acoes_cardapios_cafe.php		// Controllers para operações CRUD de Cardápios de Café <br>
├── acoes_cardapios_ceia.php		// Controllers para operações CRUD de Cardápios de Ceia <br>
├── acoes_cardapios_jantar.php 	// Controllers para operações CRUD de Cardápios de Jantar <br>
├── acoes_ceias.php			// Controllers para operações CRUD de Ceias <br>
├── acoes_complementos.php		// Controllers para operações CRUD de Complementos <br>
├── acoes_complementos_ceia.php	// Controllers para operações CRUD de Complementos de Ceia <br>
├── acoes_entradas.php			// Controllers para operações CRUD de Entradas <br>
├── acoes_gestores_munic.php		// Controllers para operações CRUD de Gestores de Municiamento <br>
├── acoes_guarnicoes.php		// Controllers para operações CRUD de Guarnições <br>
├── acoes_nutricionistas.php		// Controllers para operações CRUD de Nutricionistas <br>
├── acoes_pratosPrincipais.php		// Controllers para operações CRUD de Pratos Principais <br>
├── acoes_questoes.php			// Controllers para operações CRUD de Questões <br> 
├── acoes_sobremesas.php		// Controllers para operações CRUD de Sobremesas <br>
├── acoes_usuarios.php			// Controllers para operações CRUD de Usuários <br>
├── acompanhamento-create.php		// Formulário de criação de Acompanhamento
├── acompanhamento-edit.php		// Formulário de edição de Acompanhamento
├── acompanhamentos_ceia.php        	// Página principal de Acompanhamento de Ceia
├── avaliacao_rancho.php		// Página para votação dos cardápios
├── cafe-create.php			// Formulário de criação de Café
├── cafe-edit.php			// Formulário de edição de Café
├── cafes.php				// Página principal de Café
├── cardapios_almoco.php		// Página principal para Criação de Cardápios de Almoço
├── cardapios_almoco-edit.php		// Página principal para Edição de Cardápios de Almoço
├── cardapios_cafe.php			// Página principal para Criação de Cardápios de Café
├── cardapios_cafe-edit.php		// Página principal para Edição de Cardápios de Café
├── cardapios_ceia.php			// Página principal para Criação de Cardápios de Ceia
├── cardapios_ceia-edit.php		// Página principal para Edição de Cardápios de Ceia
├── cardapios_dashboard.php		// Página principal com os tipos de Cardápio
├── cardapios_jantar.php		// Página principal para Criação de Cardápios de Jantar
├── cardapios_jantar-edit.php		// Página principal para Edição de Cardápios de Jantar
├── ceia-create.php			// Formulário de criação de Ceia
├── ceia-edit.php			// Formulário de edição de Ceia
├── ceias.php				// Página principal de Ceia
├── complemento_ceia-create.php	// Formulário de criação de Complemento de Ceia
├── complemento_ceia-edit.php		// Formulário de edição de Complemento de Ceia
├── complemento-create.php		// Formulário de criação de Complemento de Café
├── complemento-edit.php		// Formulário de edição de Complemento de Café
├── complementos.php			// Página principal de Complemento de Café
├── complementos_ceia.php		// Página principal de Complemento de Ceia
├── config.php				// Formulário de criação de Agentes Fiscais, Nutricionistas e Gestores de Municiamento 
├── connect.php			// Arquivo de configuração do BD utilizando mysqli
├── connect_pdo.php			// Arquivo de configuração do BD utilizando PDO
├── dashboard.php			// Painel Administrativo do Sistema
├── entrada-create.php			// Formulário de criação de Entrada
├── entrada-edit.php			// Formulário de edição de Entrada
├── entradas.php			// Página principal das Entradas
├── exportar_cardapio_semanal.php
├── exportar_cardapios_pdf.php
├── exportar_relatorio_avaliacoes.php
├── exportar_relatorio_mensal.php
├── guarnicao-create.php
├── guarnicao-edit.php
├── guarnicoes.php
├── guarnicoes_dashboard.php
├── index.php
├── login.php
├── logout.php
├── mensagem.php
├── navbar.php
├── pratoPrincipal-create.php
├── pratoPrincipal-edit.php
├── pratosPrincipais.php
├── questao-create.php
├── questao-edit.php
├── questoes.php
├── README.md
├── settings.php
├── sobremesa-create.php
├── sobremesa-edit.php
├── sobremesas.php
├── usuario-create.php
├── usuario-edit.php
├── usuarios.php
├── usuario-view.php

🐛 Solução de Problemas
Erro de conexão com o banco: Verifique as credenciais em config/connect.php connect_pdo.

Página em branco: Habilite erros no PHP (display_errors = On no php.ini).

🤝 Como Contribuir <br>
	&nbspFaça um fork do projeto

	Crie uma branch (git checkout -b feature/nova-feature)

	Commit suas mudanças (git commit -m 'Adiciona nova feature')

	Push para a branch (git push origin feature/nova-feature)

	Abra um Pull Request

📜 Licença: <br>
	Este projeto está sob a licença MIT - veja o arquivo LICENSE para detalhes.

📞 Contato: <br>
	Vinício Gomes - @viniciogomes92 - viniciogomes@gmail.com