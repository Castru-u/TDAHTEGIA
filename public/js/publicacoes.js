document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os formulários e textareas
    const forms = document.querySelectorAll('.form-comentario form');
    
    forms.forEach(form => {
        const textarea = form.querySelector('textarea');

        // Adiciona um evento keydown ao textarea
        textarea.addEventListener('keydown', function(event) {
            // Verifica se a tecla pressionada é Enter e a tecla Shift não está pressionada
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault(); // Impede o comportamento padrão (nova linha)
                // Envia o formulário
                form.submit();
            }
        });

        // Adiciona um evento click ao botão de envio
        form.querySelector('.btn-enviar').addEventListener('click', function() {
            form.submit();
        });
    });
});
