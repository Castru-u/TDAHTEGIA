document.addEventListener('DOMContentLoaded', function() {
    // Selecione todos os formulários de comentário
    document.querySelectorAll('.form-comentario').forEach(function(formContainer) {
        const form = formContainer.querySelector('form');
        const textarea = formContainer.querySelector('textarea');
        const submitButton = formContainer.querySelector('.btn-enviar');

        textarea.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault(); // Impede o comportamento padrão (nova linha)
                form.submit();
            }
        });

        submitButton.addEventListener('click', function() {
            form.submit();
        });
    });
});
