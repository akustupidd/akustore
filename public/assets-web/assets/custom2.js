
function submitProductType(value) {
     // product type 
     document.getElementById('productTypeForm').addEventListener('change', function() {
        // let value = this.value;
        let url = new URL(window.location.href);
        url.searchParams.set('product_type_name', value);
        window.location.href = url.toString();
    });
}


function submitCategory(value) {

    // product type 
    document.getElementById('categoryForm').addEventListener('change', function() {
        // let value = this.value;
        let url = new URL(window.location.href);
        url.searchParams.set('category_name', value);
        window.location.href = url.toString();
    });
}

$(document).ready(function() {
    $('#productModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var productId = button.data('id'); // Extract info from data-* attributes
        console.log('id', productId)
        var modal = $(this);
        $.ajax({
            url: '/detail-prouct-quick-view/' + productId,
            method: 'GET',
            success: function(data) {
                var detailsHtml = '<p>Name: ' + data.name + '</p>' +
                                  '<p>Description: ' + data.description + '</p>' +
                                  '<p>Price: $' + data.price + '</p>';

                modal.find('#productDetails').html(detailsHtml);
            },
            error: function() {
                modal.find('#productDetails').html('<p>Error loading details.</p>');
            }
        });
    });
});