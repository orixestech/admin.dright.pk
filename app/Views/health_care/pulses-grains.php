<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<br>
<div class="card">
    <div class="card-body">
        <h4 >Pluses and Grains
        <span style="float: right;">
            <button type="button" onclick="AddItem('pulses-grains')" class="btn btn-primary mr-2 mb-2" data-toggle="modal" data-target="#exampleModal">
                Add Item
            </button>
        </span>
        </h4>
    </div>
    <div class="table-responsive">
        <table id="pulses" class="table table-striped table-bordered">
            <thead>            <tr>
                <th>Sr No</th>
                <th>Image</th>
                <th>Name</th>
                <th>Urdu Name</th>
                <th>Nutritional Items</th>
                <th>Actions</th>
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

                <th>Actions</th>
                <div class="mt-5" id="Response"></div>

            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('health_care/modal/add_item'); ?>
    <?php echo view('health_care/modal/update_item'); ?>

<script>
    $(document).ready(function (){
        $('#pulses').DataTable({
            "scrollY": "800px",
            "scrollCollapse": true,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "lengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, 'All']],
            "pageLength": 100,
            "autoWidth": true,
            "ajax": {
                "url": "<?= $path ?>diet/pulses-grains-data",
                "type": "POST"
            }
        });});

</script>
    <script>
        function AddItem(item) {
            $('#AddItemModal form#AddItemForm input#Category').val(item);
            $('#AddItemModal').modal('show');

        }
        function DeleteItem(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response =   AjaxResponse("diet/delete", "id=" + id);
                if (response.status == 'success') {
                    $("#Response").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Deleted Successfully!</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
                else {
                    $("#Response").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error! Not Deleted</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

            }
        }
        function ItemDetail(id) {
            location.href = "<?=$path?>diet/pulses-grains-detail/" + id;
        }
        function UpdateItem(id, item) {
            var Items = AjaxResponse("diet/get-record", "id=" + id);

            // Set form fields
            $('#UpdateItemModal form#UpdateItemForm input#Category').val(item);
            $('#UpdateItemModal form#UpdateItemForm input#UID').val(Items.record.UID);
            $('#UpdateItemModal form#UpdateItemForm input#Name').val(Items.record.Name);
            $('#UpdateItemModal form#UpdateItemForm input#UrduName').val(Items.record.UrduName);
            $('#UpdateItemModal form#UpdateItemForm textarea#Description').val(Items.record.Description);

            // Define the image path
            var path = '<?=$path?>'; // assuming `path` is available from the backend
            var imageHTML;

            // Check if an image exists, otherwise show a default image
            if (Items.record.Image) {
                imageHTML = '<img src="' + path + 'upload/diet/' + Items.record.Image + '" style="height:100px;">';
            } else {
                imageHTML = '<img src="' + path + 'upload/diet/images.png" style="height:100px;">';
            }

            // Set the image HTML in the modal
            $('#UpdateItemModal form#UpdateItemForm #ImageHTML').html(imageHTML);

            // Show the modal
            $('#UpdateItemModal').modal('show');
        }

    </script>

    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
