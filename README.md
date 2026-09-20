# 🏥 Clínica Médica — Agendamento de Consultas

Sistema web para **gerenciar o agendamento de consultas** de uma clínica médica. Permite cadastrar, listar, editar e excluir consultas (CRUD), associando cada paciente a um médico, uma especialidade e uma data.


> ▶️ Assistir à demonstração em vídeo

https://github.com/user-attachments/assets/1bd2bd75-dd41-400a-8d08-5cdf968577e4

) (39 segundos)

## ✨ Funcionalidades

- **Listar** todas as consultas agendadas em uma tabela (ID, paciente, médico, especialidade e data), ordenadas da data mais recente para a mais antiga.
- **Criar** um novo agendamento a partir do botão **Novo Agendamento**.
- **Editar** um agendamento existente pelo botão **Editar** de cada linha.
- **Excluir** um agendamento com **confirmação** antes da remoção (a ação não pode ser desfeita).
- **Especialidade preenchida automaticamente** ao escolher o médico.
- Seletor de data nativo do navegador no campo *Data da Consulta*.
- Interface responsiva com visual de "cartão" translúcido sobre a imagem da recepção da clínica.

## 👩‍⚕️ Médicos e especialidades

| Médico(a) | Especialidade |
|---|---|
| Dr. Carlos Almeida | Dermatologia |
| Dra. Fernanda Lima | Cardiologia |
| Dr. Rafael Costa | Ortopedia |
| Dra. Renata Oliveira | Pediatria |
| Dr. Bruno Martins | Neurologia |
| Dra. Juliana Rocha | Ginecologia |
| Dr. André Pereira | Clínico Geral |

## 🔄 Fluxo de uso

1. **Início (`index.php`)** — a tela principal lista as consultas já agendadas.
2. **Novo agendamento (`criar.php`)** — informe o nome do paciente, selecione o médico (a especialidade é preenchida sozinha), escolha a data e clique em **Salvar Agendamento**. O registro aparece na lista.
3. **Edição (`editar.php`)** — clique em **Editar** na linha desejada; o formulário abre com os dados atuais (ex.: *Editar Agendamento #3*). Altere médico, especialidade ou data e clique em **Atualizar Agendamento**.
4. **Exclusão** — clique em **Excluir**; o navegador pede confirmação (*"Tem certeza que deseja excluir este agendamento? Esta ação não pode ser desfeita."*). Ao confirmar, o registro some da lista.

Em qualquer formulário, o botão **Cancelar** volta para a lista sem salvar.

## 🛠️ Tecnologias

- **PHP** — páginas e lógica do servidor
- **HTML5 + CSS3** — estrutura e estilo da interface
- **JavaScript** — diálogo de confirmação na exclusão
- Servidor local (**localhost**), como XAMPP, WAMP ou similar

## 🚀 Como executar

1. Instale um servidor local com PHP e banco de dados (ex.: [XAMPP](https://www.apachefriends.org/)).
2. Copie a pasta do projeto para o diretório público do servidor, com o nome `Clinica_site`:
   - XAMPP: `C:\xampp\htdocs\Clinica_site`
   - WAMP: `C:\wamp64\www\Clinica_site`
3. Inicie o **Apache** (e o **MySQL**, se o projeto usar banco de dados).
4. Configure a conexão com o banco de dados conforme o seu ambiente.
5. Acesse no navegador: **http://localhost/Clinica_site/**

## 🗃️ Dados de cada agendamento

| Campo | Descrição |
|---|---|
| `ID` | Identificador único da consulta |
| `Paciente` | Nome completo do paciente |
| `Médico` | Profissional responsável |
| `Especialidade` | Especialidade do médico selecionado |
| `Data da Consulta` | Data no formato `dd/mm/aaaa` |

## 👤 Autor

Desenvolvido por **Diego Rodrigues**.
