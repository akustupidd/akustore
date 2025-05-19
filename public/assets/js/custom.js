// add row length table 
document.getElementById('add_row_length').addEventListener('change', function() {
    let value = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('row_length', value);
    window.location.href = url.toString();
});

// filter category 
document.getElementById('category').addEventListener('change', function() {
    let value = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('category', value);
    window.location.href = url.toString();
});

// filter brand 
document.getElementById('brand').addEventListener('change', function() {
    let value = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('brand', value);
    window.location.href = url.toString();
});

// product type 
document.getElementById('product_type').addEventListener('change', function() {
    let value = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('product_type', value);
    window.location.href = url.toString();
});

// filter type 
document.getElementById('type').addEventListener('change', function() {
    let value = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('type', value);
    window.location.href = url.toString();
});

// filter products 
document.getElementById('product_name').addEventListener('change', function() {
    let value = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('product_name', value);
    window.location.href = url.toString();
});

// filter accessary_type 
document.getElementById('accessary_name').addEventListener('change', function() {
    let value = this.value;
    let url = new URL(window.location.href);
    url.searchParams.set('accessary_name', value);
    window.location.href = url.toString();
});

// search select 
$(document).ready(function() {
    $('#product_id').select2({
        placeholder: 'Choose Product',
        allowClear: true
    });
});

$(document).ready(function() {
    $('#stock_id').select2({
        placeholder: 'Choose Stock',
        allowClear: true
    });
});