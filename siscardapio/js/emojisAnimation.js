document.addEventListener('DOMContentLoaded', () => {
    const allRadioInputs = document.querySelectorAll('input[type="radio"]');

    allRadioInputs.forEach(input => {
        input.addEventListener('click', () => {
            const name = input.name;

            // Remove classe 'selected' de todos os labels relacionados a esse grupo
            document.querySelectorAll(`input[name="${name}"]`).forEach(radio => {
                const label = document.querySelector(`label[for="${radio.id}"]`);
                label.classList.remove('selected');
            });

            // Adiciona classe 'selected' ao label clicado
            const selectedLabel = document.querySelector(`label[for="${input.id}"]`);
            selectedLabel.classList.add('selected');

            // Remove o destaque após 2 segundos
            setTimeout(() => {
                selectedLabel.classList.remove('selected');
            }, 1000);
        });
    });
});