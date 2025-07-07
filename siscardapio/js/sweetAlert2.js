
// Menu Usuários
function confirmaDeleteUsuario(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir ${id}?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Faz a requisição POST para o PHP
      fetch('acoes_usuarios.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_usuario=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir o usuário.', 'error');
      });
    }
  });
}

// Menu Questões
function confirmaDeleteQuestao(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Faz a requisição POST para o PHP
      fetch('acoes_questoes.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_questao=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir a questão.', 'error');
      });
    }
  });
}

// Menu Guarnições - Entrada (Almoço)
function confirmaDeleteEntrada(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Faz a requisição POST para o PHP
      fetch('acoes_entradas.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_entrada=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir a entrada.', 'error');
      });
    }
  });
}

// Menu Guarnições - Prato Principal (Almoço)
function confirmaDeletePratoPrincipal(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Faz a requisição POST para o PHP
      fetch('acoes_pratosPrincipais.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_pratoPrincipal=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir o Prato Principal.', 'error');
      });
    }
  });
}

// Menu Guarnições - Guarnição (Almoço)
function confirmaDeleteGuarnicao(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Faz a requisição POST para o PHP
      fetch('acoes_guarnicoes.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_guarnicao=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir a Guarnição.', 'error');
      });
    }
  });
}

// Menu Guarnições - Acompanhamento (Almoço)
function confirmaDeleteAcompanhamento(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Faz a requisição POST para o PHP
      fetch('acoes_acompanhamentos.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_acompanhamento=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir o Acompanhamento.', 'error');
      });
    }
  });
}

// Menu Guarnições - Sobremesa (Almoço)
function confirmaDeleteSobremesa(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      // Faz a requisição POST para o PHP
      fetch('acoes_sobremesas.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_sobremesa=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir a Sobremesa.', 'error');
      });
    }
  });
}

// Menu Guarnições - Café (Café da Manhã)
function confirmaDeleteCafe(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      
      // Faz a requisição POST para o PHP
      fetch('acoes_cafes.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_cafe=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir a Café da Manhã.', 'error');
      });
    }
  });
}

// Menu Guarnições - Complemento (Café da Manhã)
function confirmaDeleteComplemento(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      
      // Faz a requisição POST para o PHP
      fetch('acoes_complementos.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_complemento=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir a Café da Manhã.', 'error');
      });
    }
  });
}

// Menu Guarnições - Ceia (Ceia)
function confirmaDeleteCeia(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      
      // Faz a requisição POST para o PHP
      fetch('acoes_ceias.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_ceia=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir a Complemento da Ceia.', 'error');
      });
    }
  });
}

// Menu Guarnições - Complemento (Ceia)
function confirmaDeleteComplementoCeia(id) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      
      // Faz a requisição POST para o PHP
      fetch('acoes_complementos_ceia.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_complementoCeia=${id}`
      })
      .then(response => {
        if (response.redirected) {
          // Se o PHP redirecionar, siga o redirecionamento
          window.location.href = response.url;
        } else {
          return response.text();
        }
      })
      .then(data => {
        // Se necessário, mostrar algo na interface
        console.log(data);
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir a Complemento da Ceia.', 'error');
      });
    }
  });
}


function confirmaDeleteCardapioCafe(id, dataCardapio) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      
      // Faz a requisição POST para o PHP
      fetch('acoes_cardapios_cafe.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          delete_cardapioCafe_id: id,
          delete_cardapioCafe_data: dataCardapio
        })
      })
      .then(response => response.json())
      .then(data => {
        Swal.fire({
          icon: data.status === 'success' ? 'success' : 'error',
          title: data.message,
          confirmButtonText: 'OK'
        }).then(() => {
          if (data.redirect) {
            window.location.href = data.redirect;
          }
        });
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir o Cardápio.', 'error');
      });
    }
  });
}

function confirmaDeleteCardapioJantar(id, dataCardapio) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      
      // Faz a requisição POST para o PHP
      fetch('acoes_cardapios_almoco.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          delete_cardapioJantar_id: id,
          delete_cardapioJantar_data: dataCardapio
        })
      })
      .then(response => response.json())
      .then(data => {
        Swal.fire({
          icon: data.status === 'success' ? 'success' : 'error',
          title: data.message,
          confirmButtonText: 'OK'
        }).then(() => {
          if (data.redirect) {
            window.location.href = data.redirect;
          }
        });
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir o Cardápio.', 'error');
      });
    }
  });
}

function confirmaDeleteCardapioJantar(id, dataCardapio) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      
      // Faz a requisição POST para o PHP
      fetch('acoes_cardapios_jantar.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          delete_cardapioJantar_id: id,
          delete_cardapioJantar_data: dataCardapio
        })
      })
      .then(response => response.json())
      .then(data => {
        Swal.fire({
          icon: data.status === 'success' ? 'success' : 'error',
          title: data.message,
          confirmButtonText: 'OK'
        }).then(() => {
          if (data.redirect) {
            window.location.href = data.redirect;
          }
        });
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir o Cardápio.', 'error');
      });
    }
  });
}

function confirmaDeleteCardapioCeia(id, dataCardapio) {
  Swal.fire({
    title: `Tem certeza que deseja excluir?`,
    text: "Essa operação não pode ser revertida.",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, quero deletar"
  }).then((result) => {
    if (result.isConfirmed) {
      
      // Faz a requisição POST para o PHP
      fetch('acoes_cardapios_ceia.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
          delete_cardapioCeia_id: id,
          delete_cardapioCeia_data: dataCardapio
        })
      })
      .then(response => response.json())
      .then(data => {
        Swal.fire({
          icon: data.status === 'success' ? 'success' : 'error',
          title: data.message,
          confirmButtonText: 'OK'
        }).then(() => {
          if (data.redirect) {
            window.location.href = data.redirect;
          }
        });
      })
      .catch(error => {
        console.error('Erro ao excluir:', error);
        Swal.fire('Erro', 'Não foi possível excluir o Cardápio.', 'error');
      });
    }
  });
}