


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
    const successMessage = '{{ session('success') }}';
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
