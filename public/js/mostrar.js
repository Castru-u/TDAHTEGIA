function redirectToEdit(comunidadeId) {
    window.location.href = 'crud.php?idcomunidade=' + comunidadeId;
}

document.querySelectorAll('.btn_entrar_cm').forEach(button => {
    button.addEventListener('click', function() {
        const comunidadeId = this.getAttribute('data-id');
        const acao = this.getAttribute('data-acao');

        if (acao) {
            fetch('../actions/comunidade/entrar_e_sair_comunidade.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'idcomunidade': comunidadeId,
                    'acao': acao
                })
            })
            .then(response => response.text())
            .then(result => {
                alert(result); // Exibe o resultado do PHP
                location.reload(); // Atualiza a página
            })
            .catch(error => console.error('Erro:', error));
        }
    });
});

function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
        return uri + separator + key + "=" + value;
    }
}

function handleInputChange(event) {
    if (event.key === 'Enter' || event.type === 'change') {
        event.preventDefault();
        const searchInput = document.getElementById('search').value.trim();
        const categorySelect = document.getElementById('category').value;
        let url = window.location.pathname;

        // Atualiza o parâmetro da pesquisa
        if (searchInput) {
            url = updateQueryStringParameter(url, 'pesquisa', searchInput);
        } else {
            url = updateQueryStringParameter(url, 'pesquisa', '');
        }

        // Atualiza o parâmetro da categoria
        if (categorySelect) {
            url = updateQueryStringParameter(url, 'categoria', categorySelect);
        } else {
            url = updateQueryStringParameter(url, 'categoria', '');
        }

        // Redireciona para a nova URL
        window.location.href = url;
    }
}

document.getElementById('search').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        handleInputChange(event);
    }
});

document.getElementById('category').addEventListener('change', handleInputChange);

 // JavaScript para redirecionamento
 document.querySelectorAll('[id^="redirectDiv_"]').forEach(element => {
element.addEventListener('click', function() {
    window.location.href = 'http://localhost/TDAHTEGIA/app/pages/comunidade.php';
});
});