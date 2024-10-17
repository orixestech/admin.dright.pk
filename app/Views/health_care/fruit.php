
<br>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-2">Fruit</h4>
            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
            <button type="button" onclick="AddItem('fruits')" class="btn btn-primary mr-2 mb-2" data-toggle="modal" data-target="#exampleModal">
              Add Item
            </button>
            </div>

    </div>
    <div class="table-responsive">
        <table id="fruits" class="table table-striped table-bordered">
            <thead>            <tr>
                <th>Sr No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Urdu Name</th>
                <th>Nutritional Items</th>
<!--                <th>Actions</th>-->
            </tr>
            </thead>
           <tbody>
           </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Urdu Name</th>
                <th>Nutritional Items</th>
<!--                <th>Actions</th>-->
            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('health_care/modal/add_item'); ?>
    <?php echo view('health_care/modal/update_item'); ?>

<script>
    $(document).ready(function (){
        $('#fruits').DataTable({
            "scrollY": "800px",
            "scrollCollapse": true,
            "searching": false,
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, 'All']],
            "pageLength": 100,
            "autoWidth": true,
            "ajax": {
                "url": "<?= $path ?>fruit-data",
                "type": "POST"
            }
        });});

</script>
<script>
    function AddItem(item) {
        $('#AddItemModal form#AddItemForm input#Category').val(item);
        $('#AddItemModal').modal('show');

    }
    function UpdateItem(id, item) {
        var Items = AjaxResponse("categories/get-record", "id=" + id);
        $('#UpdateItemModal form#UpdateItemForm input#Category').val(item);
        $('#UpdateItemModal').modal('show');


    }
</script>
    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
