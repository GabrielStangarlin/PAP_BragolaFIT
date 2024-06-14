$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

document.getElementById('photo1Add').addEventListener('input', function () {
    const imageUrl = this.value;
    const imagePreview = document.getElementById('imagePreview');

    if (imageUrl) {
        imagePreview.src = imageUrl;
        imagePreview.style.display = 'block'; // Show image
    } else {
        imagePreview.style.display = 'none'; // Hide image if input is empty
    }
});

document.getElementById('photo2Add').addEventListener('input', function () {
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
        data: 'action',
        name: 'action',
        orderable: false
    }
    ],
    order: [
        [0, 'desc']
    ]
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
            $('#editModal').find('#id').val(res.id);
            $('#editModal').find('#nameEdit').val(res.name);
            $('#editModal').find('#descriptionEdit').val(res.description);
            $('#editModal').find('#priceEdit').val(res.price);
            $('#editModal').find('#quantityEdit').val(res.quantity);
            $('#editModal').find('#subcategoryEdit').val(res.subcategory_id);
            $('#editModal').find('#photo1Edit').val(res.photo_1);
            $('#editModal').find('#photo2Edit').val(res.photo_2);

            $('#editModal').modal('show');
        }
    });
}
