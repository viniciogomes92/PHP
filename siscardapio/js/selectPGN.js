const selectPGN = document.getElementById('selectPGNutri');
const selectCN = document.getElementById('selectCNutri');
const selectQCN = document.getElementById('selectQCNutri');
const labelEspN = document.getElementById('labelEspNutri');
const inputEspN = document.getElementById('inputEspNutri');

selectPGN.addEventListener('change', () => {
    const value = selectPGN.value;

    // Lista dos Postos/Graduações de oficiais
    const oficiais = ['AE', 'VA', 'CA', 'CMG', 'CF', 'CC', 'CT', '1T', '2T', 'GM'];

    if (oficiais.includes(value)) {
        // Exibe o Select com os Quadros de Oficiais
        selectQCN.hidden = false;
        selectQCN.disabled = false;

        // Oculta o Select de Quadros de Praças
        selectCN.hidden = true;
        selectCN.disabled = true;
        selectCN.selectedIndex = 0;

        // Oculta o campo de especialidade
        labelEspN.hidden = true;
        inputEspN.hidden = true;
        inputEspN.disabled = true;
        inputEspN.value = '';

    } else {
        // Oculta o Select com os Quadros de Oficiais
        selectQCN.hidden = true;
        selectQCN.disabled = true;
        selectQCN.selectedIndex = 0;

        // Exibe o Select de Quadros de Praças
        selectCN.hidden = false;
        selectCN.disabled = false;

        // Exibe o campo de especialidade
        labelEspN.hidden = false;
        inputEspN.hidden = false;
        inputEspN.disabled = false;
    };
});
