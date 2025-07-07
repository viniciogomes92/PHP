function sendAvaliacao (id, nota, emojiCheck) {
    let checkNota = document.querySelector(`#questao_${id}_nota_${nota}`);

    checkNota.addEventListener('click', () => {
        // responder(emojiCheck);
        if (checkNota.checked) {
            location.href = `acoes_avaliacoes.php?create_avaliacao=${id}&nota=${nota}`;
        } else {
            Swal.fire({
                title: `Erro ao enviar Avalição!`,
                text: "Algo deu errado ao gravar sua avaliação, tente novamente.",
                icon: "warning",
            });
        }
    });
}

function responder(emoji) {
    const el = document.createElement("div");
    el.className = "emoji-check";
    el.textContent = emoji;
    
    // posição aleatória no eixo X dentro da janela
    el.style.left = Math.random() * (window.innerWidth - 50) + "px";
    el.style.top = "300px";

    document.body.appendChild(el);

    // remover após a animação
    setTimeout(() => el.remove(), 1500);
}