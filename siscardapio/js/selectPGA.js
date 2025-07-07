const selectPG = document.getElementById('selectPGAgenteFiscal');
const selectC = document.getElementById('selectCAgenteFiscal');
const selectQC = document.getElementById('selectQCAgenteFiscal');
const labelEsp = document.getElementById('labelEspAgenteFiscal');
const inputEspAgenteFiscal = document.getElementById('inputEspAgenteFiscal');

selectPG.addEventListener('change', () => {
    const value = selectPG.value;

    // Lista dos Postos/Graduações de oficiais
    const oficiais = ['AE', 'VA', 'CA', 'CMG', 'CF', 'CC', 'CT', '1T', '2T', 'GM'];

    if (oficiais.includes(value)) {
        // Exibe o Select com os Quadros de Oficiais
        selectQC.hidden = false;
        selectQC.disabled = false;

        // Oculta o Select de Quadros de Praças
        selectC.hidden = true;
        selectC.disabled = true;
        selectC.selectedIndex = 0;

        // Oculta o campo de especialidade
        labelEsp.hidden = true;
        inputEspAgenteFiscal.hidden = true;
        inputEspAgenteFiscal.disabled = true;
        inputEspAgenteFiscal.value = '';

    } else {
        // Oculta o Select com os Quadros de Oficiais
        selectQC.hidden = true;
        selectQC.disabled = true;
        selectQC.selectedIndex = 0;

        // Exibe o Select de Quadros de Praças
        selectC.hidden = false;
        selectC.disabled = false;

        // Exibe o campo de especialidade
        labelEsp.hidden = false;
        inputEspAgenteFiscal.hidden = false;
        inputEspAgenteFiscal.disabled = false;
    };
});
