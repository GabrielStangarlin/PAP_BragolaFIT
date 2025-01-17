


//Script JavaScript para os details
document.addEventListener('DOMContentLoaded', function () {
    const detailsElements = document.querySelectorAll('details');

    detailsElements.forEach((detail) => {
        detail.addEventListener('toggle', function () {
            if (this.open) {
                detailsElements.forEach((otherDetail) => {
                    if (otherDetail !== this) {
                        otherDetail.removeAttribute('open');
                    }
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // Verifica se a mensagem de sucesso está presente
    
    if (successMessage) {
        // Define a mensagem no modal
        document.getElementById('successMessage').textContent = successMessage;
        // Mostra o modal
        const successModal = document.getElementById('successModal');
        successModal.style.display = 'block';
        // Esconde o modal após 2 segundos
        setTimeout(function () {
            successModal.style.display = 'none';
        }, 2000);
    }
});


//script para alternar conteudo perfil
function showContent(section) {
    // Esconde todas as seções de conteúdo
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(function(section) {
        section.style.display = 'none';
    });

    // Mostra a seção selecionada
    document.getElementById(section).style.display = 'block';

    // Remove a classe 'active-link' de todos os links
    const links = document.querySelectorAll('.left-column ul li a');
    links.forEach(function(link) {
        link.classList.remove('active-link');
    });

    // Adiciona a classe 'active-link' ao link clicado
    const currentLink = document.querySelector(`a[data-section="${section}"]`);
    currentLink.classList.add('active-link');
}




