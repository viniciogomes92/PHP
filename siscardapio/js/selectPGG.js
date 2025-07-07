const selectPGG = document.getElementById('selectPGGestorMunic');
const selectCG = document.getElementById('selectCGestorMunic');
const selectQCG = document.getElementById('selectQCGestorMunic');
const labelEspG = document.getElementById('labelEspGestorMunic');
const inputEspG = document.getElementById('inputEspGestorMunic');

selectPGG.addEventListener('change', () => {
    const value = selectPGG.value;

    // Lista dos Postos/Graduações de oficiais
    const oficiais = ['AE', 'VA', 'CA', 'CMG', 'CF', 'CC', 'CT', '1T', '2T', 'GM'];

    if (oficiais.includes(value)) {
        // Exibe o Select com os Quadros de Oficiais
        selectQCG.hidden = false;
        selectQCG.disabled = false;

        // Oculta o Select de Quadros de Praças
        selectCG.hidden = true;
        selectCG.disabled = true;
        selectCG.selectedIndex = 0;

        // Oculta o campo de especialidade
        labelEspG.hidden = true;
        inputEspG.hidden = true;
        inputEspG.disabled = true;
        inputEspG.value = '';

    } else {
        // Oculta o Select com os Quadros de Oficiais
        selectQCG.hidden = true;
        selectQCG.disabled = true;
        selectQCG.selectedIndex = 0;

        // Exibe o Select de Quadros de Praças
        selectCG.hidden = false;
        selectCG.disabled = false;

        // Exibe o campo de especialidade
        labelEspG.hidden = false;
        inputEspG.hidden = false;
        inputEspG.disabled = false;
    };
});
