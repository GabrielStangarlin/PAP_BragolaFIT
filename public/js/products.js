$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

document.getElementById('photo1Add', 'photo1Edit').addEventListener('input', function () {
    const imageUrl = this.value;
    const imagePreview = document.getElementById('imagePreview');

    if (imageUrl) {
        imagePreview.src = imageUrl;
        imagePreview.style.display = 'block'; // Show image
    } else {
        imagePreview.style.display = 'none'; // Hide image if input is empty
    }
});

document.getElementById('photo2Add', 'photo2Edit').addEventListener('input', function () {
    const imageUrl = this.value;
    const imagePreview = document.getElementById('imagePreview2');

    if (imageUrl) {
        imagePreview.src = imageUrl;
        imagePreview.style.display = 'block'; // Show image
    } else {
        imagePreview.style.display = 'none'; // Hide image if input is empty
    }
});

let table = $('#product-datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "/db/list/product",
    columns: [{
        data: 'photo_1',
        name: 'photo_1',
        orderable: false,
        render: function (data, type, row) {
            return '<img src="' + data + '" alt="Photo" style="max-width:60px;height:auto;"/>';
        }
    },
    {
        data: 'name',
        name: 'name'
    },
    {
        data: 'quantity',
        name: 'quantity'
    },
    {
        data: 'price',
        name: 'price'
    },
    {
        data: 'subcategories',
        name: 'subcategories'
    },
    {
        data: 'action',
        name: 'action',
        orderable: false
    }
    ],
    order: [
        [0, 'desc']
    ],
    onClick: editFunc()
});

$(document).on('click', '.openAddModal', function () {
    $('#nameAdd').val('');
    $('#descriptionAdd').val('');
    $('#priceAdd').val('');
    $('#quantityAdd').val('');
    $('#photo1Add').val('');
    $('#photo2Add').val('');
    $('#imagePreview').hide();
    $('#imagePreview2').hide();

    $('#addModal').modal('show');
});

//list subcategories
$(document).ready(function () {
    // Function to load categories into a select element
    function loadCategories(selectElementId) {
        $.ajax({
            url: '/subcategories/all/select',
            method: 'GET',
            success: function (response) {
                var scategorySelect = $(selectElementId);
                scategorySelect.empty(); // Clear any existing options
                scategorySelect.append(
                    '<option value="" style="color: lightgray;" selected disabled>Selecione uma subcategoria</option>'
                ); // Add default option
                response.forEach(function (scategory) {
                    scategorySelect.append(new Option(scategory.name, scategory.id));
                });
            },
            error: function (xhr, status, error) {
                console.error('An error occurred:', error);
            }
        });
    }

    // Trigger when the add product modal is shown
    $('#addModal').on('shown.bs.modal', function () {
        loadCategories('#addModal #subcategorySelectAdd');
    });

    // Trigger when the edit product modal is shown
    $('#editModal').on('shown.bs.modal', function () {
        loadCategories('#editModal #subcategorySelectEdit');
    });
});

//add Product
$(document).on('click', '#btn-save', function () {
    var name = $('#addModal').find('#nameAdd').val();
    var description = $('#addModal').find('#descriptionAdd').val();
    var price = $('#addModal').find('#priceAdd').val();
    var quantity = $('#addModal').find('#quantityAdd').val();
    var subcategory_id = $('#addModal').find('#subcategorySelectAdd').val();
    var photo_1 = $('#addModal').find('#photo1Add').val();
    var photo_2 = $('#addModal').find('#photo2Add').val();

    $.ajax({
        type: 'POST',
        url: "/product/add",
        data: {
            name: name,
            description: description,
            price: price,
            quantity: quantity,
            subcategory_id: subcategory_id,
            photo_1: photo_1,
            photo_2: photo_2
        },
        dataType: 'json',
        success: (data) => {
            $('#addModal').hide();
            $("#btn-save").html('Submit');
            $("#btn-save").attr("disabled", false);
            table.ajax.reload();
        }
    });
});

function editFunc(id) {
    $.ajax({
        type: 'POST',
        url: "/product/informations/edit",
        data: {
            id: id
        },
        dataType: 'json',
        success: function (res) {
            const product = res.product;
            const subcategories = res.subcategories;
            const selectedSubcategory = res.selected_subcategory[0]; // Supondo que apenas uma subcategoria será selecionada

            $('#editModal').find('#id').val(product.id);
            $('#editModal').find('#nameEdit').val(product.name);
            $('#editModal').find('#descriptionEdit').val(product.description);
            $('#editModal').find('#priceEdit').val(product.price);
            $('#editModal').find('#quantityEdit').val(product.quantity);
            $('#editModal').find('#photo1Edit').val(product.photo_1);
            $('#editModal').find('#photo2Edit').val(product.photo_2);

            // Preencher o select de subcategorias
            const $subcategoryEdit = $('#editModal').find('#subcategoryEdit');
            $subcategoryEdit.empty(); // Limpar as opções atuais
            $.each(subcategories, function (index, subcategory) {
                $subcategoryEdit.append(
                    $('<option>', {
                        value: subcategory.id,
                        text: subcategory.name,
                        selected: subcategory.id == selectedSubcategory // Selecionar se for a subcategoria correta
                    })
                );
            });

            $('#editModal').modal('show');
        }
    });
}

$(document).on('click', '#btn-update', function () {
    var id = $('#editModal').find('#id').val();
    var nameEdit = $('#editModal').find('#nameEdit').val();
    var descriptionEdit = $('#editModal').find('#descriptionEdit').val();
    var priceEdit = $('#editModal').find('#priceEdit').val();
    var quantityEdit = $('#editModal').find('#quantityEdit').val();
    var subcategory_idEdit = $('#editModal').find('#subcategorySelectEdit').val();
    var photo_1Edit = $('#editModal').find('#photo1Edit').val();
    var photo_2Edit = $('#editModal').find('#photo2Edit').val();

    $.ajax({
        type: 'POST',
        url: "/product/edit",
        data: {
            id: id,
            name: nameEdit,
            description: descriptionEdit,
            price: priceEdit,
            quantity: quantityEdit,
            subcategory_id: subcategory_idEdit,
            photo_1: photo_1Edit,
            photo_2: photo_2Edit
        },
        dataType: 'json',
        success: (data) => {
            $('#editModal').hide();
            $("#btn-update").html('Submit');
            $("#btn-update").attr("disabled", false);
            table.ajax.reload();
        }
    });
});