function addToCart(productId) {
    $.ajax({
        type: 'POST',
        url: '/add-to-cart',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId
        },
        success: function (response) {
            //updateCartContent(); // Atualizar o conteúdo do carrinho
            Swal.fire({
                icon: "success",
                title: "Adicionado ao carrinho!",
                showConfirmButton: false,
                timer: 1500
            });
        },
        error: function (xhr) {
            alert('Error: ' + xhr.responseJSON.error); // Exibir mensagem de erro
        }
    });
}
