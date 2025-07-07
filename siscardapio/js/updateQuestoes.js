function updateQuestoes (id) {
    let checkAtiva = document.querySelector(`.idQuestao-${id}`);

    checkAtiva.addEventListener('change', () => {
        if (checkAtiva.checked) {
            location.href = `acoes_questoes.php?update_questoes=${id}&ativa=A`;
        } else {
            location.href = `acoes_questoes.php?update_questoes=${id}&ativa=I`;
        }
    });
}