(function () {
    var rowIndex = document.querySelectorAll('.brighter-meta-row').length;

    var addBtn = document.getElementById('brighter-add-meta-row');
    if (addBtn) {
        addBtn.addEventListener('click', function () {
            var tbody = document.getElementById('brighter-meta-rows');
            var row   = document.createElement('tr');
            row.className = 'brighter-meta-row';
            row.innerHTML =
                '<td><input type="text" name="meta_map[' + rowIndex + '][form_field]" class="regular-text" placeholder="form_field_name"></td>' +
                '<td><input type="text" name="meta_map[' + rowIndex + '][meta_key]"   class="regular-text" placeholder="_meta_key or acf_field_name"></td>' +
                '<td style="text-align:center;vertical-align:middle;"><input type="checkbox" name="meta_map[' + rowIndex + '][is_acf]" value="1"></td>' +
                '<td><button type="button" class="button brighter-remove-row">Remove</button></td>';
            tbody.appendChild(row);
            rowIndex++;
            bindRemoveButtons();
        });
    }

    function bindRemoveButtons() {
        document.querySelectorAll('.brighter-remove-row').forEach(function (btn) {
            btn.onclick = function () {
                this.closest('tr').remove();
            };
        });
    }

    bindRemoveButtons();
}());
