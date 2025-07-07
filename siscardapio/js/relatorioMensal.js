document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#mes_ano", {
        locale: "pt",
        dateFormat: "Y-m",
        defaultDate: "today",
        // Mostrar apenas seleção de mês/ano
        plugins: [
            new monthSelectPlugin({
                shorthand: true,
                dateFormat: "Y-m",
                altFormat: "F Y",
                theme: "light"
            })
        ]
    });
});